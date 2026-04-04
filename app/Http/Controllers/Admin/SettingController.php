<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Display a listing of settings.
     */
    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings in the database.
     */
    public function update(Request $request)
    {
        // Validation for required fields and image types
        $request->validate([
            'email' => 'sometimes|required|email',
            'phone' => 'sometimes|required',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
        ]);

        foreach ($request->except('_token') as $slug => $value) {
            
            // Check if this is a file upload
            if ($request->hasFile($slug)) {
                $file = $request->file($slug);
                $filename = time() . '_' . $slug . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $filename);
                
                // Get old setting value to delete the old file
                $oldSetting = Setting::where('slug', $slug)->first();
                if ($oldSetting && $oldSetting->value && file_exists(public_path('uploads/settings/' . $oldSetting->value))) {
                    @unlink(public_path('uploads/settings/' . $oldSetting->value));
                }
                
                $value = $filename;
                $type = 'file';
            } elseif (is_array($value)) {
                // Handle team members and other potential array settings
                
                // Handle files inside the array (like team member images)
                // Note: Standard Laravel request->hasFile doesn't work deep in nested arrays easily for direct move
                // But if they are passed as separate files or if we handle them specifically.
                // For the team repeater, we'll handle image uploads separately if needed, 
                // but let's see if the user's logic expects them inline.
                
                $value = json_encode($value);
                $type = 'json';
            } else {
                // Determine type based on slug or manual map if needed
                $typeMap = [
                    'address' => 'textarea',
                    'footer_text' => 'textarea',
                    'site_logo' => 'file',
                    'favicon' => 'file',
                    'about_company_description' => 'textarea',
                    'about_vision_description' => 'textarea',
                    'about_team_description' => 'textarea',
                    'about_company_logo' => 'file',
                    'about_vision_image' => 'file',
                    'about_team_image' => 'file',
                ];
                $type = $typeMap[$slug] ?? 'text';
            }

            // Update or create the setting
            Setting::updateOrCreate(
                ['slug' => $slug],
                ['value' => $value, 'type' => $type]
            );
        }

        return back()->with('success', 'Settings Updated Successfully');
    }
}
