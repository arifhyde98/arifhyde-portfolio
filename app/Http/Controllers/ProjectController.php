<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('display_order')->orderBy('title')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:500'],
            'full_description' => ['required', 'string'],
            'image_upload' => ['nullable', 'image', 'max:3072'], // max 3MB
            'tech_tags' => ['required', 'string', 'max:255'], // Comma separated tags
            'github_link' => ['nullable', 'url', 'max:255'],
            'live_link' => ['nullable', 'url', 'max:255'],
            'is_featured' => ['boolean'],
            'display_order' => ['required', 'integer'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['slug'] = Str::slug($request->input('title'));

        // Handle unique slug check
        $slugCount = Project::where('slug', 'like', $validated['slug'] . '%')->count();
        if ($slugCount > 0) {
            $validated['slug'] .= '-' . ($slugCount + 1);
        }

        if ($request->hasFile('image_upload')) {
            $validated['image'] = $request->file('image_upload')->store('projects', 'public');
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:500'],
            'full_description' => ['required', 'string'],
            'image_upload' => ['nullable', 'image', 'max:3072'],
            'tech_tags' => ['required', 'string', 'max:255'],
            'github_link' => ['nullable', 'url', 'max:255'],
            'live_link' => ['nullable', 'url', 'max:255'],
            'is_featured' => ['boolean'],
            'display_order' => ['required', 'integer'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        // Only update slug if title changed
        if ($project->title !== $request->input('title')) {
            $validated['slug'] = Str::slug($request->input('title'));
            $slugCount = Project::where('slug', 'like', $validated['slug'] . '%')->where('id', '!=', $project->id)->count();
            if ($slugCount > 0) {
                $validated['slug'] .= '-' . ($slugCount + 1);
            }
        }

        if ($request->hasFile('image_upload')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image_upload')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        // Keep file in storage in case of soft delete restore, or delete if wanted.
        // For soft delete, we'll keep the image so if we restore it, it works!
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted (soft delete) successfully.');
    }
}
