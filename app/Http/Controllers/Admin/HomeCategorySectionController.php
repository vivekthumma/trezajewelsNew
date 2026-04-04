<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeCategorySection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeCategorySectionController extends Controller
{
    /**
     * Display a listing of home category sections.
     */
    public function index()
    {
        $sections = HomeCategorySection::with('category')
            ->orderBy('sort_order', 'asc')
            ->latest('id')
            ->get();

        return view('admin.home_sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new section.
     */
    public function create()
    {
        $categories = Category::active()->orderBy('name')->get();

        return view('admin.home_sections.create', compact('categories'));
    }

    /**
     * Store a newly created section in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateSection($request);

        if ($request->hasFile('icon')) {
            $data['icon'] = $this->storeIcon($request->file('icon'));
        }

        HomeCategorySection::create($data);

        return redirect()->route('home-sections.index')->with('success', 'Home section created successfully.');
    }

    /**
     * Display the specified section.
     */
    public function show($id)
    {
        return redirect()->route('home-sections.edit', $id);
    }

    /**
     * Show the form for editing the specified section.
     */
    public function edit($id)
    {
        $section = HomeCategorySection::findOrFail($id);
        $categories = Category::active()->orderBy('name')->get();

        return view('admin.home_sections.edit', compact('section', 'categories'));
    }

    /**
     * Update the specified section in storage.
     */
    public function update(Request $request, $id)
    {
        $section = HomeCategorySection::findOrFail($id);
        $data = $this->validateSection($request);

        if ($request->hasFile('icon')) {
            $this->deleteIcon($section->icon);
            $data['icon'] = $this->storeIcon($request->file('icon'));
        }

        $section->update($data);

        return redirect()->route('home-sections.index')->with('success', 'Home section updated successfully.');
    }

    /**
     * Remove the specified section from storage.
     */
    public function destroy($id)
    {
        $section = HomeCategorySection::findOrFail($id);

        $this->deleteIcon($section->icon);
        $section->delete();

        return redirect()->route('home-sections.index')->with('success', 'Home section deleted successfully.');
    }

    /**
     * Validate section data and normalize checkbox input.
     */
    protected function validateSection(Request $request): array
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'product_count_text' => 'nullable|string|max:255',
            'sort_order' => 'required|integer|min:0',
            'status' => 'nullable',
            'icon' => 'nullable|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $data['status'] = $request->has('status') ? 1 : 0;

        return $data;
    }

    /**
     * Store an icon and return the relative path.
     */
    protected function storeIcon($icon): string
    {
        $directory = public_path('uploads/home-sections');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $iconName = time() . '_' . uniqid() . '.' . $icon->extension();
        $icon->move($directory, $iconName);

        return 'uploads/home-sections/' . $iconName;
    }

    /**
     * Delete an icon if it exists on disk.
     */
    protected function deleteIcon(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
