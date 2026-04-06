<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    /**
     * Get the session ID for WRITE operations (creates one if not set).
     */
    private function getSessionId()
    {
        if (Auth::check()) {
            return null;
        }

        if (!Session::has('wishlist_session_id')) {
            Session::put('wishlist_session_id', uniqid('wish_', true));
        }

        return Session::get('wishlist_session_id');
    }

    /**
     * Get the session ID for READ-ONLY operations (does NOT create a new one).
     */
    private function getReadSessionId()
    {
        if (Auth::check()) {
            return null;
        }
        return Session::get('wishlist_session_id'); // returns null if not set
    }

    private function getWishlistQuery(bool $readOnly = false)
    {
        if (Auth::check()) {
            return Wishlist::where('user_id', Auth::id());
        }
        $sessionId = $readOnly ? $this->getReadSessionId() : $this->getSessionId();
        if (!$sessionId) {
            // Return a query that always yields empty results
            return Wishlist::where('session_id', 'NO_SESSION__EMPTY');
        }
        return Wishlist::where('session_id', $sessionId);
    }

    private function getWishlistItems()
    {
        return $this->getWishlistQuery(true)->with('product.gallery')->get();
    }

    private function getWishlistCount()
    {
        return $this->getWishlistQuery(true)->count();
    }

    /**
     * Display the wishlist page.
     */
    public function index()
    {
        $wishlistItems = $this->getWishlistItems();
        $subtotal = $wishlistItems->sum(fn($item) => $item->product ? $item->product->effectivePrice() : 0);
        return view('frontend.wishlist', compact('wishlistItems', 'subtotal'));
    }

    /**
     * Toggle (add/remove) a product in the wishlist.
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->product_id;
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $this->getSessionId();

        $query = Wishlist::where('product_id', $productId);
        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $sessionId);
        }

        $existing = $query->first();

        if ($existing) {
            $existing->delete();
            $inWishlist = false;
            $message = 'Removed from wishlist.';
        } else {
            Wishlist::create([
                'user_id'    => $userId,
                'session_id' => $sessionId,
                'product_id' => $productId,
            ]);
            $inWishlist = true;
            $message = 'Added to wishlist!';
        }

        return response()->json([
            'success'        => true,
            'in_wishlist'    => $inWishlist,
            'message'        => $message,
            'wishlist_count' => $this->getWishlistCount(),
        ]);
    }

    /**
     * Remove a specific item from the wishlist.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'wishlist_id' => 'required|exists:wishlists,id',
        ]);

        $item = Wishlist::findOrFail($request->wishlist_id);

        // Security: only let owner remove
        if (Auth::check() && $item->user_id != Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        if (!Auth::check() && $item->session_id != $this->getSessionId()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $item->delete();

        return response()->json([
            'success'        => true,
            'wishlist_count' => $this->getWishlistCount(),
        ]);
    }

    /**
     * Clear all wishlist items.
     */
    public function clear()
    {
        $this->getWishlistQuery()->delete();
        return response()->json(['success' => true, 'wishlist_count' => 0]);
    }

    /**
     * Get wishlist count (for AJAX header update).
     */
    public function getCount()
    {
        return response()->json([
            'success'        => true,
            'wishlist_count' => $this->getWishlistCount(),
        ]);
    }

    /**
     * Get IDs of products in wishlist (for UI state).
     */
    public function getIds()
    {
        $ids = $this->getWishlistQuery(true)->pluck('product_id')->toArray();
        return response()->json(['success' => true, 'ids' => $ids]);
    }
}
