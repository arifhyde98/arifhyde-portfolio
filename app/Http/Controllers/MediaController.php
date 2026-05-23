<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $mediaFiles = Media::orderBy('created_at', 'desc')->get();
        return view('admin.media.index', compact('mediaFiles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_upload' => ['required', 'file', 'image', 'max:5120'], // Max 5MB images
        ]);

        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $fileName = $file->getClientOriginalName();
            $path = $file->store('media', 'public');
            $type = $file->getMimeType();
            $size = $file->getSize();

            Media::create([
                'file_name' => $fileName,
                'file_path' => $path,
                'file_type' => $type,
                'size' => $size,
            ]);

            return redirect()->route('admin.media.index')
                ->with('success', 'Media file uploaded successfully.');
        }

        return redirect()->route('admin.media.index')
            ->with('error', 'No file was uploaded.');
    }

    public function destroy(Media $medium)
    {
        Storage::disk('public')->delete($medium->file_path);
        $medium->delete();

        return redirect()->route('admin.media.index')
            ->with('success', 'Media file deleted successfully.');
    }
}
