<?php

namespace App\Http\Controllers\Cms;

use App\Models\Cms\Landing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    public function edit()
    {
        $landing = Landing::firstOrCreate([]);
        return view('cms.landing.index', compact('landing'));
    }

    public function update(Request $request)
    {
        $landing = Landing::firstOrCreate([]);

        $data = $request->all();

        // ✅ Upload Hero Image & hapus lama
        if ($request->hasFile('image')) {
            if ($landing->image && Storage::disk('public')->exists($landing->image)) {
                Storage::disk('public')->delete($landing->image);
            }
            $data['image'] = $request->file('image')->store('landing', 'public');
        }

        

        $landing->update($data);

        return back()->with('success', 'Landing Page updated successfully');
    }
}
