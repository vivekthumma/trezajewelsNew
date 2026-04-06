<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\HomeCategorySection;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Display the frontend home page.
     */
    public function index()
    {
        $products = Product::with('gallery')->active()->latest()->take(8)->get();
        $categories = Category::active()->take(12)->get();
        $homeSections = HomeCategorySection::with('category')->active()
            ->orderBy('sort_order', 'asc')
            ->get();

        $firstSectionProducts = collect();
        if ($homeSections->count() > 0) {
            $firstSectionProducts = Product::where('category_id', $homeSections->first()->category_id)
                ->active()
                ->latest()
                ->take(2)
                ->get();
        }

        $sliders = \App\Models\Slider::active()->orderBy('order', 'asc')->get();

        return view('frontend.home', compact('products', 'categories', 'homeSections', 'firstSectionProducts', 'sliders'));
    }

    /**
     * Get products for a specific category via AJAX.
     */
    public function getCategoryProducts($categoryId)
    {
        $products = Product::where('category_id', $categoryId)
            ->active()
            ->latest()
            ->take(2)
            ->get();
            
        return view('frontend.partials.home_category_products', [
            'products' => $products,
            'categoryId' => $categoryId
        ]);
    }

    /**
     * Display the payment policy page.
     */
    public function paymentPolicy()
    {
        $categories = \App\Models\Category::active()->take(12)->get();
        return view('frontend.payment-policy', compact('categories'));
    }

    /**
     * Display the privacy policy page.
     */
    public function privacyPolicy()
    {
        $categories = \App\Models\Category::active()->take(12)->get();
        return view('frontend.privacy-policy', compact('categories'));
    }

    /**
     * Display the return policy page.
     */
    public function returnPolicy()
    {
        $categories = \App\Models\Category::active()->take(12)->get();
        return view('frontend.return-policy', compact('categories'));
    }

    /**
     * Display the shipping policy page.
     */
    public function shippingPolicy()
    {
        $categories = \App\Models\Category::active()->take(12)->get();
        return view('frontend.shipping-policy', compact('categories'));
    }

    /**
     * Display the terms and condition page.
     */
    public function termsCondition()
    {
        $categories = \App\Models\Category::active()->take(12)->get();
        return view('frontend.terms-condition', compact('categories'));
    }
}
