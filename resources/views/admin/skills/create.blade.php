@extends('admin.layout')

@section('title', 'Add New Skill')
@section('page_title', 'Add Skill')

@section('content')
<div class="max-w-2xl space-y-6">
    <!-- Header -->
    <div class="flex items-center space-x-2">
        <a href="{{ route('admin.skills.index') }}" class="text-zinc-400 hover:text-white transition duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Add New Skill</h1>
            <p class="text-zinc-400 text-sm mt-1">Tambahkan data keahlian teknis atau alat kerja baru.</p>
        </div>
    </div>

    <!-- Card Form -->
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

        <form action="{{ route('admin.skills.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Skill Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-zinc-300 mb-1.5">Skill Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                        placeholder="e.g. PHP, Docker">
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-zinc-300 mb-1.5">Category</label>
                    <select name="category" id="category" required
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200">
                        <option value="Backend" {{ old('category') == 'Backend' ? 'selected' : '' }}>Backend</option>
                        <option value="Frontend" {{ old('category') == 'Frontend' ? 'selected' : '' }}>Frontend</option>
                        <option value="Tools" {{ old('category') == 'Tools' ? 'selected' : '' }}>Tools</option>
                        <option value="Automation" {{ old('category') == 'Automation' ? 'selected' : '' }}>Automation</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Percentage -->
                <div>
                    <label for="percentage" class="block text-sm font-medium text-zinc-300 mb-1.5">Proficiency Percentage</label>
                    <div class="relative flex items-center">
                        <input type="number" name="percentage" id="percentage" value="{{ old('percentage', 80) }}" min="0" max="100" required
                            class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200">
                        <span class="absolute right-4 text-sm text-zinc-400">%</span>
                    </div>
                </div>

                <!-- Display Order -->
                <div>
                    <label for="display_order" class="block text-sm font-medium text-zinc-300 mb-1.5">Display Order</label>
                    <input type="number" name="display_order" id="display_order" value="{{ old('display_order', 1) }}" required
                        class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200">
                </div>
            </div>

            <!-- Optional Icon Class / HTML -->
            <div>
                <label for="icon" class="block text-sm font-medium text-zinc-300 mb-1.5">Icon Slug / Identifier (Optional)</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                    class="w-full px-4 py-2 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition duration-200"
                    placeholder="e.g. php, laravel, docker, or font-awesome class">
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
                <a href="{{ route('admin.skills.index') }}" class="px-4 py-2.5 bg-zinc-950 border border-zinc-800 hover:border-zinc-700 text-zinc-300 hover:text-white rounded-lg text-sm font-semibold transition duration-200">
                    Cancel
                </a>
                <button type="submit"
                    class="py-2.5 px-6 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-medium rounded-lg shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transform hover:-translate-y-0.5 active:translate-y-0 transition duration-200">
                    Create Skill
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
