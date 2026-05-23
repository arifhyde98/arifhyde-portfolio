@extends('admin.layout')

@section('title', 'Add Testimonial')
@section('page_title', 'Add Testimonial')

@section('content')
<div class="max-w-2xl space-y-6">
    <!-- Header -->
    <div class="flex items-center space-x-2">
        <a href="{{ route('admin.testimonials.index') }}" class="text-zinc-400 hover:text-white transition duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Add Testimonial</h1>
            <p class="text-zinc-400 text-sm mt-1">Tambahkan testimoni atau ulasan klien baru.</p>
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

        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Client Name -->
                <div>
                    <label for="client_name" class="block text-sm font-medium text-zinc-300 mb-1.5">Client Name</label>
                    <input type="text" name="client_name" id="client_name" value="{{ old('client_name') }}" required
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                        placeholder="e.g. Budi Santoso">
                </div>

                <!-- Position -->
                <div>
                    <label for="position" class="block text-sm font-medium text-zinc-300 mb-1.5">Position / Job Title</label>
                    <input type="text" name="position" id="position" value="{{ old('position') }}" required
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                        placeholder="e.g. CEO at TechCorp">
                </div>
            </div>

            <!-- Message -->
            <div>
                <label for="message" class="block text-sm font-medium text-zinc-300 mb-1.5">Message / Review</label>
                <textarea name="message" id="message" rows="4" required
                    class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                    placeholder="Write client testimonial here..."></textarea>
            </div>

            <!-- Client Photo Upload -->
            <div x-data="{ photoName: null, photoPreview: null }">
                <label class="block text-sm font-medium text-zinc-300 mb-1.5">Client Photo</label>
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 rounded-full bg-zinc-950 border border-zinc-800 flex items-center justify-center shrink-0 overflow-hidden">
                        <template x-if="photoPreview">
                            <img :src="photoPreview" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!photoPreview">
                            <svg class="w-6 h-6 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </template>
                    </div>
                    <div class="flex-1">
                        <input type="file" name="client_photo_upload" id="client_photo_upload" class="hidden" accept="image/*"
                               @change="
                                   const file = $event.target.files[0];
                                   if (file) {
                                       photoName = file.name;
                                       const reader = new FileReader();
                                       reader.onload = (e) => { photoPreview = e.target.result; };
                                       reader.readAsDataURL(file);
                                   }
                               ">
                        <label for="client_photo_upload" class="px-4 py-2 border border-zinc-800 hover:border-zinc-700 rounded-lg text-xs font-semibold text-zinc-300 hover:text-white cursor-pointer transition duration-200">
                            Choose Image
                        </label>
                        <span class="block text-[11px] text-zinc-500 mt-2" x-text="photoName ? photoName : 'Maksimal 2MB (JPG/PNG)'"></span>
                    </div>
                </div>
            </div>

            <!-- Active Checkbox -->
            <div class="flex items-center">
                <label class="flex items-center text-zinc-400 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked
                        class="w-4 h-4 rounded bg-zinc-950 border-zinc-800 text-blue-600 focus:ring-blue-500/50 focus:ring-offset-zinc-900 mr-2">
                    <span class="text-sm font-medium text-zinc-300">Active (Tampilkan di Portfolio)</span>
                </label>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-zinc-900">
                <a href="{{ route('admin.testimonials.index') }}" class="px-4 py-2.5 bg-zinc-950 border border-zinc-800 hover:border-zinc-700 text-zinc-300 hover:text-white rounded-lg text-sm font-semibold transition duration-200">
                    Cancel
                </a>
                <button type="submit"
                    class="py-2.5 px-6 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-medium rounded-lg shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transform hover:-translate-y-0.5 active:translate-y-0 transition duration-200">
                    Save Testimonial
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
