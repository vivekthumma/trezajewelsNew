<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    private function getSessionId()
    {
        if (Auth::check()) {
            return Auth::id(); // Use user ID if authenticated
        }

        if (!Session::has('cart_session_id')) {
            Session::put('cart_session_id', uniqid('cart_', true));
        }

        return Session::get('cart_session_id');
    }

    private function getCartItems()
    {
        if (Auth::check()) {
            return Cart::with('product')->where('user_id', Auth::id())->get();
        } else {
            return Cart::with('product')->where('session_id', $this->getSessionId())->get();
        }
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock available.'
            ], 400);
        }

        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $this->getSessionId();

        $cartQuery = Cart::where('product_id', $product->id)
                         ->where('size', $request->size)
                         ->where('color', $request->color);

        if ($userId) {
            $cartQuery->where('user_id', $userId);
        } else {
            $cartQuery->where('session_id', $sessionId);
        }

        $cartItem = $cartQuery->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($newQuantity > $product->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot add more. Stock limit reached.'
                ], 400);
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'size' => $request->size,
                'color' => $request->color,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully.',
            'cart_count' => $this->getCartItems()->sum('quantity')
        ]);
    }

    public function getCart()
    {
        $cartItems = $this->getCartItems();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $html = view('frontend.partials.cart_drawer_items', compact('cartItems'))->render();
        $pageHtml = view('frontend.partials.cart_page_items', compact('cartItems', 'subtotal'))->render();

        return response()->json([
            'success'   => true,
            'html'      => $html,
            'page_html' => $pageHtml,
            'cart_count'=> $cartItems->sum('quantity'),
            'subtotal'  => number_format($subtotal, 2)
        ]);
    }

    public function updateQty(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($request->cart_id);
        $product = $cartItem->product;

        if ($request->quantity > $product->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Requested quantity exceeds available stock.',
                'stock' => $product->quantity
            ], 400);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json(['success' => true]);
    }

    public function page()
    {
        $cartItems = $this->getCartItems();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        return view('frontend.cart', compact('cartItems', 'subtotal'));
    }

    public function removeItem(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id'
        ]);

        Cart::findOrFail($request->cart_id)->delete();

        return response()->json(['success' => true]);
    }

    public function clear()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            Cart::where('session_id', $this->getSessionId())->delete();
        }
        return response()->json(['success' => true]);
    }
}
