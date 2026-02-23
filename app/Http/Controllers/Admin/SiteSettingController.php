<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index()
    {
        $setting = SiteSetting::first() ?? new SiteSetting();
        return view('admin.cms.site-settings', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $setting = SiteSetting::first() ?? new SiteSetting();
        
        $data = $request->except(['site_logo', 'about_image']);

        if ($request->hasFile('site_logo')) {
            if ($setting->site_logo) {
                Storage::delete('public/' . $setting->site_logo);
            }
            $data['site_logo'] = $request->file('site_logo')->store('settings', 'public');
        }

        if ($request->hasFile('about_image')) {
            if ($setting->about_image) {
                Storage::delete('public/' . $setting->about_image);
            }
            $data['about_image'] = $request->file('about_image')->store('settings', 'public');
        }

        if ($setting->exists) {
            $setting->update($data);
        } else {
            SiteSetting::create($data);
        }

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
