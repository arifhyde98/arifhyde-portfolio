@extends('admin.layout')

@section('title', 'Media Manager')
@section('page_title', 'Media Manager')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Media Manager</h1>
        <p class="text-zinc-400 text-sm mt-1">Unggah dan kelola aset media (gambar, logo, banner) untuk digunakan kembali di seluruh portfolio.</p>
    </div>

    <!-- Upload Card -->
    <div class="bg-zinc-900/40 backdrop-blur-xl border border-zinc-900 rounded-xl p-6">
        <h3 class="text-sm font-semibold text-white mb-4">Upload New File</h3>
        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
            @csrf
            <div class="flex-1 w-full">
                <input type="file" name="file_upload" id="file_upload" required accept="image/*"
                    class="w-full text-sm text-zinc-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-zinc-950 file:text-zinc-300 file:border-zinc-800 hover:file:bg-zinc-900 file:cursor-pointer">
            </div>
            <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-medium text-sm rounded-lg transition duration-200 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transform hover:-translate-y-0.5 active:translate-y-0 shrink-0 w-full sm:w-auto text-center">
                Upload File
            </button>
        </form>
        <span class="block text-[11px] text-zinc-500 mt-2">Maksimal file gambar: 5MB (JPG, PNG, WEBP, GIF, SVG)</span>
    </div>

    <!-- Media Grid -->
    <div>
        <h3 class="text-lg font-semibold text-white mb-4">Uploaded Media Library</h3>
        
        @if($mediaFiles->isEmpty())
            <div class="text-center py-16 text-zinc-500 border border-dashed border-zinc-800 rounded-xl">
                <svg class="w-12 h-12 mx-auto mb-4 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p class="text-sm">Perpustakaan media kosong. Unggah file pertama Anda di atas.</p>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach($mediaFiles as $media)
                    <div class="bg-zinc-900/30 border border-zinc-900 rounded-xl overflow-hidden shadow-md flex flex-col group hover:border-zinc-800 transition duration-300">
                        <!-- Preview area -->
                        <div class="aspect-square bg-zinc-950 flex items-center justify-center relative overflow-hidden border-b border-zinc-900 shrink-0">
                            <img src="{{ asset('storage/' . $media->file_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center transition duration-200 space-x-2">
                                <a href="{{ asset('storage/' . $media->file_path) }}" target="_blank" class="w-8 h-8 rounded-full bg-zinc-900 hover:bg-zinc-800 border border-zinc-700/50 flex items-center justify-center text-white text-xs" title="View Fullscreen">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <button onclick="navigator.clipboard.writeText('{{ asset('storage/' . $media->file_path) }}'); alert('File path copied to clipboard!');" class="w-8 h-8 rounded-full bg-zinc-900 hover:bg-zinc-800 border border-zinc-700/50 flex items-center justify-center text-white text-xs" title="Copy Path URL">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Details area -->
                        <div class="p-3 flex-1 flex flex-col justify-between space-y-1">
                            <span class="text-xs font-semibold text-white block truncate" title="{{ $media->file_name }}">{{ $media->file_name }}</span>
                            <span class="text-[10px] text-zinc-500 block">
                                {{ round($media->size / 1024, 1) }} KB
                            </span>
                            <div class="flex justify-between items-center pt-2 mt-auto">
                                <span class="text-[9px] text-zinc-600 font-mono uppercase bg-zinc-950 px-1 border border-zinc-900 rounded shrink-0">
                                    {{ substr($media->file_type, strpos($media->file_type, '/') + 1) }}
                                </span>
                                <form action="{{ route('admin.media.destroy', $media) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus file media ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[10px] text-red-500 hover:text-red-400 font-semibold transition duration-150">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
