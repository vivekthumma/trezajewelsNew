<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of sliders.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->get('search');
        $query = Slider::query();

        if ($searchQuery) {
            $query->where(function ($builder) use ($searchQuery) {
                $builder->where('title', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('sub_title', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('link', 'LIKE', "%{$searchQuery}%");
            });
        }

        $sliders = $query
            ->orderBy('order', 'asc')
            ->latest()
            ->paginate(10);

        return view('admin.sliders.index', compact('sliders', 'searchQuery'));
    }

    /**
     * Show the form for creating a new slider.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created slider in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateSlider($request, true);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'));
        }

        Slider::create($data);

        return redirect()->route('sliders.index')->with('success', 'Slider created successfully.');
    }

    /**
     * Display the specified slider.
     */
    public function show($id)
    {
        return redirect()->route('sliders.edit', $id);
    }

    /**
     * Show the form for editing the specified slider.
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified slider in storage.
     */
    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $data = $this->validateSlider($request, false);

        if ($request->hasFile('image')) {
            $this->deleteImage($slider->image);
            $data['image'] = $this->storeImage($request->file('image'));
        }

        $slider->update($data);

        return redirect()->route('sliders.index')->with('success', 'Slider updated successfully.');
    }

    /**
     * Remove the specified slider from storage.
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        $this->deleteImage($slider->image);
        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully.');
    }

    /**
     * Validate slider data and normalize checkbox input.
     */
    protected function validateSlider(Request $request, bool $imageRequired): array
    {
        $rules = [
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:2048',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable',
            'image' => ($imageRequired ? 'required' : 'nullable') . '|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ];

        $data = $request->validate($rules);
        $data['order'] = (int) ($data['order'] ?? 0);
        $data['status'] = $request->has('status') ? 1 : 0;

        return $data;
    }

    /**
     * Store a slider image and return the relative path.
     */
    protected function storeImage($image): string
    {
        $directory = public_path('uploads/sliders');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $imageName = time() . '_' . uniqid() . '.' . $image->extension();
        $image->move($directory, $imageName);

        return 'uploads/sliders/' . $imageName;
    }

    /**
     * Delete an image if it exists on disk.
     */
    protected function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
