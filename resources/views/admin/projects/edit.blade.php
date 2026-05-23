@extends('admin.layout')

@section('title', 'Edit Project')
@section('page_title', 'Edit Project')

@section('content')
<div class="max-w-4xl space-y-6">
    <!-- Header -->
    <div class="flex items-center space-x-2">
        <a href="{{ route('admin.projects.index') }}" class="text-zinc-400 hover:text-white transition duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Edit Project</h1>
            <p class="text-zinc-400 text-sm mt-1">Ubah rincian proyek Anda.</p>
        </div>
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

        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-zinc-300 mb-1.5">Project Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" required
                    class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                    placeholder="e.g. SIPAT, E-RANDIS">
            </div>

            <!-- Short Description -->
            <div>
                <label for="short_description" class="block text-sm font-medium text-zinc-300 mb-1.5">Short Description</label>
                <input type="text" name="short_description" id="short_description" value="{{ old('short_description', $project->short_description) }}" required
                    class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                    placeholder="Brief 1-sentence summary of the project...">
            </div>

            <!-- Full Description -->
            <div>
                <label for="full_description" class="block text-sm font-medium text-zinc-300 mb-1.5">Full Description (Markdown/Text)</label>
                <textarea name="full_description" id="full_description" rows="6" required
                    class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                    placeholder="Detailed explanation of features, architecture, challenges...">{{ old('full_description', $project->full_description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tech Tags -->
                <div>
                    <label for="tech_tags" class="block text-sm font-medium text-zinc-300 mb-1.5">Technology Tags (Comma Separated)</label>
                    <input type="text" name="tech_tags" id="tech_tags" value="{{ old('tech_tags', $project->tech_tags) }}" required
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                        placeholder="e.g. Laravel,TailwindCSS,MySQL,ChartJS">
                </div>

                <!-- Display Order -->
                <div>
                    <label for="display_order" class="block text-sm font-medium text-zinc-300 mb-1.5">Display Order</label>
                    <input type="number" name="display_order" id="display_order" value="{{ old('display_order', $project->display_order) }}" required
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200">
                </div>
            </div>

            <!-- Links Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- GitHub Link -->
                <div>
                    <label for="github_link" class="block text-sm font-medium text-zinc-300 mb-1.5">GitHub Repository Link</label>
                    <input type="url" name="github_link" id="github_link" value="{{ old('github_link', $project->github_link) }}"
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                        placeholder="https://github.com/...">
                </div>

                <!-- Live Demo Link -->
                <div>
                    <label for="live_link" class="block text-sm font-medium text-zinc-300 mb-1.5">Live Demo Link</label>
                    <input type="url" name="live_link" id="live_link" value="{{ old('live_link', $project->live_link) }}"
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                        placeholder="https://...">
                </div>
            </div>

            <!-- Image Upload -->
            <div x-data="{ photoName: null, photoPreview: null }">
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Project Thumbnail Image</label>
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 bg-zinc-950 border border-zinc-800 rounded-lg flex items-center justify-center shrink-0 overflow-hidden">
                        <template x-if="photoPreview">
                            <img :src="photoPreview" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!photoPreview">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-8 h-8 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            @endif
                        </template>
                    </div>
                    <div class="flex-1">
                        <input type="file" name="image_upload" id="image_upload" class="hidden" accept="image/*"
                               @change="
                                   const file = $event.target.files[0];
                                   if (file) {
                                       photoName = file.name;
                                       const reader = new FileReader();
                                       reader.onload = (e) => { photoPreview = e.target.result; };
                                       reader.readAsDataURL(file);
                                   }
                               ">
                        <label for="image_upload" class="px-4 py-2.5 border border-zinc-800 hover:border-zinc-700 rounded-lg text-xs font-semibold text-zinc-300 hover:text-white cursor-pointer transition duration-200">
                            Change Image
                        </label>
                        <span class="block text-[11px] text-zinc-500 mt-2" x-text="photoName ? photoName : 'Maksimal 3MB (JPG/PNG)'"></span>
                    </div>
                </div>
            </div>

            <!-- Checkbox Controls -->
            <div class="flex flex-col sm:flex-row gap-4 pt-2">
                <label class="flex items-center text-zinc-400 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                        class="w-4 h-4 rounded bg-zinc-950 border-zinc-800 text-blue-600 focus:ring-blue-500/50 focus:ring-offset-zinc-900 mr-2">
                    <span class="text-sm font-medium text-zinc-300">Featured (Tampilkan lebih menonjol)</span>
                </label>

                <label class="flex items-center text-zinc-400 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}
                        class="w-4 h-4 rounded bg-zinc-950 border-zinc-800 text-blue-600 focus:ring-blue-500/50 focus:ring-offset-zinc-900 mr-2">
                    <span class="text-sm font-medium text-zinc-300">Active (Tampilkan di web)</span>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-zinc-900">
                <a href="{{ route('admin.projects.index') }}" class="px-4 py-2.5 bg-zinc-950 border border-zinc-800 hover:border-zinc-700 text-zinc-300 hover:text-white rounded-lg text-sm font-semibold transition duration-200">
                    Cancel
                </a>
                <button type="submit"
                    class="py-2.5 px-6 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-medium rounded-lg shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transform hover:-translate-y-0.5 active:translate-y-0 transition duration-200">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
