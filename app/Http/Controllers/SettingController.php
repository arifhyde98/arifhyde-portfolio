<?php

namespace App\Http\Controllers;

use App\Models\SeoSetting;
use App\Models\AppearanceSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function editSeo()
    {
        $seo = SeoSetting::firstOrCreate(['id' => 1]);
        return view('admin.settings.seo', compact('seo'));
    }

    public function updateSeo(Request $request)
    {
        $seo = SeoSetting::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'meta_title' => ['required', 'string', 'max:255'],
            'meta_description' => ['required', 'string', 'max:500'],
            'keywords' => ['nullable', 'string', 'max:500'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string', 'max:500'],
            'og_image_upload' => ['nullable', 'image', 'max:3072'],
            'favicon_upload' => ['nullable', 'image', 'mimes:ico,png,jpg', 'max:1024'],
        ]);

        if ($request->hasFile('og_image_upload')) {
            if ($seo->og_image) {
                Storage::disk('public')->delete($seo->og_image);
            }
            $validated['og_image'] = $request->file('og_image_upload')->store('seo', 'public');
        }

        if ($request->hasFile('favicon_upload')) {
            if ($seo->favicon) {
                Storage::disk('public')->delete($seo->favicon);
            }
            $validated['favicon'] = $request->file('favicon_upload')->store('seo', 'public');
        }

        $seo->update($validated);

        return redirect()->route('admin.settings.seo')
            ->with('success', 'SEO settings updated successfully.');
    }

    public function editAppearance()
    {
        $appearance = AppearanceSetting::firstOrCreate(['id' => 1]);
        return view('admin.settings.appearance', compact('appearance'));
    }

    public function updateAppearance(Request $request)
    {
        $appearance = AppearanceSetting::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'hero_headline' => ['required', 'string', 'max:255'],
            'hero_subtitle' => ['required', 'string', 'max:500'],
            'primary_color' => ['required', 'string', 'max:20'],
            'secondary_color' => ['required', 'string', 'max:20'],
            'bg_style' => ['required', 'string', 'max:20'],
            'cta_text' => ['required', 'string', 'max:50'],
            'cta_link' => ['required', 'string', 'max:255'],
        ]);

        $appearance->update($validated);

        return redirect()->route('admin.settings.appearance')
            ->with('success', 'Appearance settings updated successfully.');
    }
}
