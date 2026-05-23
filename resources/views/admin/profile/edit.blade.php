@extends('admin.layout')

@section('title', 'Manage Profile')
@section('page_title', 'Profile Management')

@section('content')
<div class="max-w-4xl space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Profile Management</h1>
        <p class="text-zinc-400 text-sm mt-1">Ubah data profil pribadi Anda yang akan ditampilkan di landing page utama.</p>
    </div>

    <!-- Profile Form Card -->
    <div class="bg-zinc-900/40 backdrop-blur-xl border border-zinc-900 rounded-xl p-6 lg:p-8">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Personal Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-zinc-300 mb-1.5">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $profile->name) }}" required
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200">
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-zinc-300 mb-1.5">Professional Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $profile->title) }}" required
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                        placeholder="e.g. Full-Stack Developer">
                </div>
            </div>

            <!-- Short Bio -->
            <div>
                <label for="short_bio" class="block text-sm font-medium text-zinc-300 mb-1.5">Short Bio (Headline Subtitle)</label>
                <textarea name="short_bio" id="short_bio" rows="3" required
                    class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                    placeholder="Short summary for the top section...">{{ old('short_bio', $profile->short_bio) }}</textarea>
            </div>

            <!-- About Description -->
            <div>
                <label for="about_description" class="block text-sm font-medium text-zinc-300 mb-1.5">About Description (Full Intro)</label>
                <textarea name="about_description" id="about_description" rows="6" required
                    class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                    placeholder="Describe your career history, specialties, and architectural values...">{{ old('about_description', $profile->about_description) }}</textarea>
            </div>

            <!-- File Upload Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Profile Photo -->
                <div x-data="{ photoName: null, photoPreview: null }">
                    <label class="block text-sm font-medium text-zinc-300 mb-1.5">Profile Photo</label>
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center shrink-0 overflow-hidden">
                            <template x-if="photoPreview">
                                <img :src="photoPreview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!photoPreview">
                                @if($profile->profile_photo)
                                    <img src="{{ asset('storage/' . $profile->profile_photo) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-xs font-bold text-zinc-500 uppercase">AH</span>
                                @endif
                            </template>
                        </div>
                        <div class="flex-1">
                            <input type="file" name="profile_photo" id="profile_photo" class="hidden" accept="image/*"
                                   @change="
                                       const file = $event.target.files[0];
                                       if (file) {
                                           photoName = file.name;
                                           const reader = new FileReader();
                                           reader.onload = (e) => { photoPreview = e.target.result; };
                                           reader.readAsDataURL(file);
                                       }
                                   ">
                            <label for="profile_photo" class="px-4 py-2 border border-zinc-800 hover:border-zinc-700 rounded-lg text-xs font-semibold text-zinc-300 hover:text-white cursor-pointer transition duration-200">
                                Choose Image
                            </label>
                            <span class="block text-[11px] text-zinc-500 mt-2" x-text="photoName ? photoName : 'Maksimal 2MB (JPG/PNG)'"></span>
                        </div>
                    </div>
                </div>

                <!-- Resume PDF -->
                <div>
                    <label class="block text-sm font-medium text-zinc-300 mb-1.5">Resume / CV (PDF Only)</label>
                    <div class="flex items-center space-x-3">
                        <input type="file" name="resume_upload" id="resume_upload" class="hidden" accept="application/pdf">
                        <label for="resume_upload" class="px-4 py-2 border border-zinc-800 hover:border-zinc-700 rounded-lg text-xs font-semibold text-zinc-300 hover:text-white cursor-pointer transition duration-200">
                            Upload CV
                        </label>
                        @if($profile->resume_url)
                            <a href="{{ asset('storage/' . $profile->resume_url) }}" target="_blank" class="text-xs text-blue-400 hover:underline">
                                View Current Resume
                            </a>
                        @else
                            <span class="text-xs text-zinc-500">Belum diunggah</span>
                        @endif
                    </div>
                    <span class="block text-[11px] text-zinc-500 mt-2">Maksimal 5MB (Format PDF)</span>
                </div>
            </div>

            <!-- Contacts Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-zinc-900">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-zinc-300 mb-1.5">Public Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $profile->email) }}"
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200">
                </div>

                <!-- WhatsApp -->
                <div>
                    <label for="whatsapp" class="block text-sm font-medium text-zinc-300 mb-1.5">WhatsApp Number</label>
                    <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $profile->whatsapp) }}"
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                        placeholder="e.g. 628123456789">
                </div>

                <!-- GitHub -->
                <div>
                    <label for="github" class="block text-sm font-medium text-zinc-300 mb-1.5">GitHub URL</label>
                    <input type="url" name="github" id="github" value="{{ old('github', $profile->github) }}"
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200">
                </div>

                <!-- LinkedIn -->
                <div>
                    <label for="linkedin" class="block text-sm font-medium text-zinc-300 mb-1.5">LinkedIn URL</label>
                    <input type="url" name="linkedin" id="linkedin" value="{{ old('linkedin', $profile->linkedin) }}"
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-4 border-t border-zinc-900">
                <button type="submit"
                    class="py-2.5 px-6 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-medium rounded-lg shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transform hover:-translate-y-0.5 active:translate-y-0 transition duration-200">
                    Save Profile Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
