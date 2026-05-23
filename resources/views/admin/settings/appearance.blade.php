@extends('admin.layout')

@section('title', 'Appearance Settings')
@section('page_title', 'Customize Appearance')

@section('content')
<div class="max-w-3xl space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Appearance Settings</h1>
        <p class="text-zinc-400 text-sm mt-1">Sesuaikan elemen tampilan, warna utama, slogan hero, dan navigasi CTA portfolio Anda.</p>
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

        <form action="{{ route('admin.settings.appearance.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Hero Section Headline -->
            <div>
                <label for="hero_headline" class="block text-sm font-medium text-zinc-300 mb-1.5">Hero Headline Title</label>
                <input type="text" name="hero_headline" id="hero_headline" value="{{ old('hero_headline', $appearance->hero_headline) }}" required
                    class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                    placeholder="e.g. Building Digital Solutions That Solve Real Problems">
            </div>

            <!-- Hero Section Subtitle -->
            <div>
                <label for="hero_subtitle" class="block text-sm font-medium text-zinc-300 mb-1.5">Hero Subtitle</label>
                <textarea name="hero_subtitle" id="hero_subtitle" rows="3" required
                    class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                    placeholder="e.g. Full-stack developer focused on building scalable systems...">{{ old('hero_subtitle', $appearance->hero_subtitle) }}</textarea>
            </div>

            <!-- Color Palette Setup -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-zinc-900">
                <!-- Primary Color -->
                <div>
                    <label for="primary_color" class="block text-sm font-medium text-zinc-300 mb-1.5">Primary Color (Hex)</label>
                    <div class="flex items-center space-x-2">
                        <input type="color" id="primary_picker" value="{{ old('primary_color', $appearance->primary_color) }}" 
                               @input="document.getElementById('primary_color').value = $event.target.value"
                               class="w-10 h-10 border border-zinc-800 bg-transparent rounded cursor-pointer">
                        <input type="text" name="primary_color" id="primary_color" value="{{ old('primary_color', $appearance->primary_color) }}" required
                            @input="document.getElementById('primary_picker').value = $event.target.value"
                            class="flex-1 px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200">
                    </div>
                </div>

                <!-- Secondary Color -->
                <div>
                    <label for="secondary_color" class="block text-sm font-medium text-zinc-300 mb-1.5">Secondary Color (Hex)</label>
                    <div class="flex items-center space-x-2">
                        <input type="color" id="secondary_picker" value="{{ old('secondary_color', $appearance->secondary_color) }}" 
                               @input="document.getElementById('secondary_color').value = $event.target.value"
                               class="w-10 h-10 border border-zinc-800 bg-transparent rounded cursor-pointer">
                        <input type="text" name="secondary_color" id="secondary_color" value="{{ old('secondary_color', $appearance->secondary_color) }}" required
                            @input="document.getElementById('secondary_picker').value = $event.target.value"
                            class="flex-1 px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200">
                    </div>
                </div>
            </div>

            <!-- Call to Action (CTA) details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-zinc-900">
                <!-- CTA Button Text -->
                <div>
                    <label for="cta_text" class="block text-sm font-medium text-zinc-300 mb-1.5">CTA Button Text</label>
                    <input type="text" name="cta_text" id="cta_text" value="{{ old('cta_text', $appearance->cta_text) }}" required
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                        placeholder="e.g. Contact Me">
                </div>

                <!-- CTA Button Link -->
                <div>
                    <label for="cta_link" class="block text-sm font-medium text-zinc-300 mb-1.5">CTA Button Link</label>
                    <input type="text" name="cta_link" id="cta_link" value="{{ old('cta_link', $appearance->cta_link) }}" required
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                        placeholder="e.g. #contact or internal page URL">
                </div>
            </div>

            <!-- Background Style Options -->
            <div>
                <label for="bg_style" class="block text-sm font-medium text-zinc-300 mb-1.5">Background Style Mode</label>
                <select name="bg_style" id="bg_style" required
                    class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200">
                    <option value="dark" {{ old('bg_style', $appearance->bg_style) == 'dark' ? 'selected' : '' }}>Dark Theme (#09090B)</option>
                    <option value="light" {{ old('bg_style', $appearance->bg_style) == 'light' ? 'selected' : '' }}>Light Theme (#F8F9FA) - Custom</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-4 border-t border-zinc-900">
                <button type="submit"
                    class="py-2.5 px-6 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-medium rounded-lg shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transform hover:-translate-y-0.5 active:translate-y-0 transition duration-200">
                    Save Appearance Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
