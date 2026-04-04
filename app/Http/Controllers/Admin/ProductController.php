<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $query = Product::with('category');

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%")->orWhere('sku', 'LIKE', "%{$search}%");
        }

        $products = $query->latest()->paginate(10);
        return view('admin.products.index', compact('products', 'search'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|unique:products,name',
            'sku'         => 'required|unique:products,sku',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'main_image'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['status']   = $request->has('status') ? 1 : 0;
        $data['featured'] = $request->has('featured') ? 1 : 0;

        // Main Image Upload
        if ($request->hasFile('main_image')) {
            $imageName = time() . '_main.' . $request->main_image->extension();
            $path = public_path('uploads/products');
            if (!File::exists($path)) File::makeDirectory($path, 0755, true);
            $request->main_image->move($path, $imageName);
            $data['main_image'] = 'uploads/products/' . $imageName;
        }

        $product = Product::create($data);

        // Save Gallery Images (JSON approach)
        if ($request->has('gallery_images_json')) {
            $galleryImages = json_decode($request->gallery_images_json, true);
            if (is_array($galleryImages)) {
                foreach ($galleryImages as $imagePath) {
                    if (!empty($imagePath)) {
                        ProductImage::create([
                            'product_id' => $product->id,
                            'image'      => $imagePath
                        ]);
                    }
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * AJAX: Image upload for Dropzone.
     */
    public function uploadGallery(Request $request)
    {
        $image = $request->file('file');
        $imageName = time() . '_' . uniqid() . '.' . $image->extension();
        $path = public_path('uploads/product_gallery');
        if (!File::exists($path)) File::makeDirectory($path, 0755, true);
        $image->move($path, $imageName);
        $fullPath = 'uploads/product_gallery/' . $imageName;

        // If product_id is provided (edit mode), save to DB immediately
        if ($request->has('product_id') && !empty($request->product_id)) {
            ProductImage::create([
                'product_id' => $request->product_id,
                'image'      => $fullPath
            ]);
        }

        return response()->json(['success' => $fullPath]);
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::with('gallery')->findOrFail($id);
        $categories = Category::active()->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::with(['category', 'gallery'])->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|unique:products,name,' . $id,
            'sku'         => 'required|unique:products,sku,' . $id,
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'main_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::findOrFail($id);
        $data = $request->all();
        $data['status']   = $request->has('status') ? 1 : 0;
        $data['featured'] = $request->has('featured') ? 1 : 0;

        if ($request->hasFile('main_image')) {
            if ($product->main_image && File::exists(public_path($product->main_image))) {
                File::delete(public_path($product->main_image));
            }
            $imageName = time() . '_main.' . $request->main_image->extension();
            $path = public_path('uploads/products');
            if (!File::exists($path)) File::makeDirectory($path, 0755, true);
            $request->main_image->move($path, $imageName);
            $data['main_image'] = 'uploads/products/' . $imageName;
        }

        $product->update($data);

        // Process NEW gallery images (JSON approach)
        if ($request->has('gallery_images_json')) {
            $galleryImages = json_decode($request->gallery_images_json, true);
            if (is_array($galleryImages)) {
                foreach ($galleryImages as $imagePath) {
                    if (!empty($imagePath)) {
                        ProductImage::create([
                            'product_id' => $product->id,
                            'image'      => $imagePath
                        ]);
                    }
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * AJAX: Image upload for Dropzone.
     */
    public function removeGalleryImage(Request $request)
    {
        if ($request->has('image_id')) {
            $image = ProductImage::find($request->image_id);
            if ($image) {
                if (File::exists(public_path($image->image))) {
                    File::delete(public_path($image->image));
                }
                $image->delete();
            }
        } elseif ($request->has('path')) {
            $path = $request->path;
            if (File::exists(public_path($path))) {
                File::delete(public_path($path));
            }
            // Also try to find and delete from DB if it exists
            ProductImage::where('image', $path)->delete();
        }

        return response()->json(['success' => 'Image removed.']);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Product::with('gallery')->findOrFail($id);

        if ($product->main_image && File::exists(public_path($product->main_image))) {
            File::delete(public_path($product->main_image));
        }

        foreach ($product->gallery as $img) {
            if (File::exists(public_path($img->image))) {
                File::delete(public_path($img->image));
            }
            $img->delete();
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
