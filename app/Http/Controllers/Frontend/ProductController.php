<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products with filters.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'gallery'])->active();

        // 1. Category Filter
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('id', $request->category)->orWhere('slug', $request->category);
            });
        }

        // 2. Availability Filter
        if ($request->filled('stock')) {
            if ($request->stock == 'in-stock') {
                $query->where('quantity', '>', 0);
            } elseif ($request->stock == 'out-of-stock') {
                $query->where('quantity', '=', 0);
            }
        }

        // 3. Price Filter
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // 4. Sorting
        $sort = $request->input('sort', 'latest');
        switch ($sort) {
            case 'az':
                $query->orderBy('name', 'asc');
                break;
            case 'za':
                $query->orderBy('name', 'desc');
                break;
            case 'low-high':
                $query->orderBy('price', 'asc');
                break;
            case 'high-low':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = \App\Models\Category::withCount('products')->active()->get();
        $maxDbPrice = Product::max('price') ?: 1000;

        $selectedCategoryId = $request->input('category');
        $currentCategory = $selectedCategoryId ? $categories->firstWhere('id', $selectedCategoryId) : null;
        if(!$currentCategory && $selectedCategoryId) {
            $currentCategory = \App\Models\Category::where('slug', $selectedCategoryId)->first();
        }

        // Get a default banner if no category selected
        $defaultBanner = \App\Models\Category::whereNotNull('banner_image')->latest()->value('banner_image') ?? 'assets/images/collection/collection-banner.jpg';

        if ($request->ajax()) {
            \Log::info('AJAX Request Received. Filter Parameters: ', $request->all());
            return response()->json([
                'html' => (string) view('frontend.products._list', compact('products')),
                'pagination' => (string) $products->links('vendor.pagination.bootstrap-5'),
                'total' => (int) $products->total(),
                'first_item' => (int) $products->firstItem(),
                'last_item' => (int) $products->lastItem(),
                'current_category_banner' => $currentCategory && $currentCategory->banner_image ? imgPath($currentCategory->banner_image) : imgPath($defaultBanner),
                'current_category_name' => $currentCategory ? $currentCategory->name : 'All Products',
            ]);
        }

        return view('frontend.products.index', compact('products', 'categories', 'maxDbPrice', 'currentCategory', 'defaultBanner'));
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::with(['category', 'gallery'])->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['gallery'])
            ->active()
            ->take(8)
            ->get();
            
        return view('frontend.product_details', compact('product', 'relatedProducts'));
    }

    /**

     * Get product data for quickview modal.
     */
    public function quickview($id)
    {
        $product = Product::with(['category', 'gallery'])->findOrFail($id);
        
        return view('frontend.partials.quickview_content', compact('product'))->render();
    }
}
