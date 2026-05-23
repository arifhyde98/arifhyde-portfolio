@extends('admin.layout')

@section('title', 'SEO Settings')
@section('page_title', 'SEO Configurations')

@section('content')
<div class="max-w-3xl space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">SEO Settings</h1>
        <p class="text-zinc-400 text-sm mt-1">Konfigurasi metadata SEO dan Open Graph (sosial media share) website portfolio Anda.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-zinc-900/40 backdrop-blur-xl border border-zinc-900 rounded-xl p-6 lg:p-8">
        @if ($errors->any())
            <div class="bg-rose-500/15 border border-rose-500/30 text-rose-400 text-sm px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.settings.seo.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Meta Title -->
            <div>
                <label for="meta_title" class="block text-sm font-medium text-zinc-300 mb-1.5">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $seo->meta_title) }}" required
                    class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                    placeholder="e.g. Arif Hyde | Full-Stack Developer">
            </div>

            <!-- Meta Description -->
            <div>
                <label for="meta_description" class="block text-sm font-medium text-zinc-300 mb-1.5">Meta Description</label>
                <textarea name="meta_description" id="meta_description" rows="3" required
                    class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                    placeholder="Brief description for search engines...">{{ old('meta_description', $seo->meta_description) }}</textarea>
            </div>

            <!-- Keywords -->
            <div>
                <label for="keywords" class="block text-sm font-medium text-zinc-300 mb-1.5">Keywords (Comma Separated)</label>
                <input type="text" name="keywords" id="keywords" value="{{ old('keywords', $seo->keywords) }}"
                    class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                    placeholder="e.g. Full-stack developer, Laravel, PHP, Arif Hyde">
            </div>

            <!-- Open Graph Section -->
            <div class="pt-6 border-t border-zinc-900 space-y-6">
                <h3 class="text-sm font-semibold text-white">Open Graph (Social Sharing)</h3>

                <!-- OG Title -->
                <div>
                    <label for="og_title" class="block text-sm font-medium text-zinc-300 mb-1.5">OG Title</label>
                    <input type="text" name="og_title" id="og_title" value="{{ old('og_title', $seo->og_title) }}"
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                        placeholder="Title for social media links...">
                </div>

                <!-- OG Description -->
                <div>
                    <label for="og_description" class="block text-sm font-medium text-zinc-300 mb-1.5">OG Description</label>
                    <textarea name="og_description" id="og_description" rows="3"
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                        placeholder="Description for social media sharing...">{{ old('og_description', $seo->og_description) }}</textarea>
                </div>

                <!-- Media Uploads Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Favicon -->
                    <div>
                        <label class="block text-sm font-medium text-zinc-300 mb-1.5">Favicon (.ico or .png)</label>
                        <div class="flex items-center space-x-3">
                            <input type="file" name="favicon_upload" id="favicon_upload" class="hidden" accept="image/x-icon,image/png,image/jpeg">
                            <label for="favicon_upload" class="px-4 py-2 border border-zinc-800 hover:border-zinc-700 rounded-lg text-xs font-semibold text-zinc-300 hover:text-white cursor-pointer transition duration-200">
                                Choose Icon
                            </label>
                            @if($seo->favicon)
                                <img src="{{ asset('storage/' . $seo->favicon) }}" class="w-8 h-8 rounded border border-zinc-800 object-cover shrink-0">
                            @endif
                        </div>
                        <span class="block text-[10px] text-zinc-500 mt-2">Maksimal 1MB</span>
                    </div>

                    <!-- OG Image -->
                    <div x-data="{ photoName: null, photoPreview: null }">
                        <label class="block text-sm font-medium text-zinc-300 mb-1.5">OG Image / Social Share Banner</label>
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-10 bg-zinc-950 border border-zinc-800 rounded flex items-center justify-center shrink-0 overflow-hidden">
                                <template x-if="photoPreview">
                                    <img :src="photoPreview" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!photoPreview">
                                    @if($seo->og_image)
                                        <img src="{{ asset('storage/' . $seo->og_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-5 h-5 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    @endif
                                </template>
                            </div>
                            <div class="flex-1">
                                <input type="file" name="og_image_upload" id="og_image_upload" class="hidden" accept="image/*"
                                       @change="
                                           const file = $event.target.files[0];
                                           if (file) {
                                               photoName = file.name;
                                               const reader = new FileReader();
                                               reader.onload = (e) => { photoPreview = e.target.result; };
                                               reader.readAsDataURL(file);
                                           }
                                       ">
                                <label for="og_image_upload" class="px-3 py-1.5 border border-zinc-800 hover:border-zinc-700 rounded text-xs font-semibold text-zinc-300 hover:text-white cursor-pointer transition duration-200">
                                    Upload Banner
                                </label>
                                <span class="block text-[9px] text-zinc-500 mt-1" x-text="photoName ? photoName : 'Maksimal 3MB (PNG/JPG)'"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-4 border-t border-zinc-900">
                <button type="submit"
                    class="py-2.5 px-6 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-medium rounded-lg shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transform hover:-translate-y-0.5 active:translate-y-0 transition duration-200">
                    Save SEO Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
