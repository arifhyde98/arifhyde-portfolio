<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::firstOrCreate(['id' => 1], [
            'name' => 'Arif Hyde',
            'title' => 'Full-Stack Developer',
        ]);
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'short_bio' => ['required', 'string', 'max:500'],
            'about_description' => ['required', 'string'],
            'profile_photo' => ['nullable', 'image', 'max:2048'], // max 2MB
            'resume_upload' => ['nullable', 'mimes:pdf', 'max:5120'], // max 5MB PDF
            'email' => ['nullable', 'email', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:20'],
            'github' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
        ]);

        if ($request->hasFile('profile_photo')) {
            // Delete old file
            if ($profile->profile_photo) {
                Storage::disk('public')->delete($profile->profile_photo);
            }
            $validated['profile_photo'] = $request->file('profile_photo')->store('profile', 'public');
        }

        if ($request->hasFile('resume_upload')) {
            // Delete old file
            if ($profile->resume_url) {
                Storage::disk('public')->delete($profile->resume_url);
            }
            $validated['resume_url'] = $request->file('resume_upload')->store('resume', 'public');
        }

        // Clean up resume_upload field from validation before update
        unset($validated['resume_upload']);

        $profile->update($validated);

        return redirect()->route('admin.profile')
            ->with('success', 'Profile updated successfully.');
    }
}
