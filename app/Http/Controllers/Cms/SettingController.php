<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Cms\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::firstOrCreate([]);
        return view('cms.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::firstOrCreate([]);

        $data = $request->all();

        // ✅ Upload Logo & hapus lama
        if ($request->hasFile('logo')) {
            if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                Storage::disk('public')->delete($setting->logo);
            }
            $data['logo'] = $request->file('logo')->store('settings', 'public');
        }

        // ✅ Upload Favicon & hapus lama
        if ($request->hasFile('favicon')) {
            if ($setting->favicon && Storage::disk('public')->exists($setting->favicon)) {
                Storage::disk('public')->delete($setting->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('settings', 'public');
        }

        $setting->update($data);

        return back()->with('success', 'Settings updated successfully');
    }
}
