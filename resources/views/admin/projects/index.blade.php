@extends('admin.layout')

@section('title', 'Manage Projects')
@section('page_title', 'Projects List')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Projects Management</h1>
            <p class="text-zinc-400 text-sm mt-1">Kelola proyek-proyek Anda yang ditampilkan di bento grid landing page.</p>
        </div>
        <div>
            <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-medium text-sm rounded-lg transition duration-200 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transform hover:-translate-y-0.5 active:translate-y-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add New Project
            </a>
        </div>
    </div>

    <!-- Projects Table Card -->
    <div class="bg-zinc-900/40 backdrop-blur-xl border border-zinc-900 rounded-xl overflow-hidden shadow-xl">
        @if($projects->isEmpty())
            <div class="text-center py-16 text-zinc-500">
                <svg class="w-12 h-12 mx-auto mb-4 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <p class="text-sm">Belum ada data proyek. Klik "Add New Project" untuk menambahkan.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-zinc-900 bg-zinc-950/40 text-xs font-semibold text-zinc-400 uppercase tracking-wider">
                            <th class="px-6 py-4">Project Info</th>
                            <th class="px-6 py-4">Tech Badges</th>
                            <th class="px-6 py-4">Display Order</th>
                            <th class="px-6 py-4">Featured</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-900">
                        @foreach($projects as $project)
                            <tr class="hover:bg-zinc-900/20 transition duration-150">
                                <td class="px-6 py-4 flex items-center space-x-4">
                                    <!-- Image Thumbnail -->
                                    <div class="w-14 h-14 rounded-lg bg-zinc-950 border border-zinc-800 flex items-center justify-center shrink-0 overflow-hidden">
                                        @if($project->image)
                                            <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-xs font-bold text-zinc-500 uppercase">{{ substr($project->title, 0, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <span class="font-semibold text-white text-sm block truncate">{{ $project->title }}</span>
                                        <span class="text-xs text-zinc-400 block truncate max-w-xs mt-0.5">{{ $project->short_description }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-xs text-zinc-300">
                                    <div class="flex flex-wrap gap-1 max-w-xs">
                                        @foreach(explode(',', $project->tech_tags) as $tag)
                                            <span class="px-1.5 py-0.5 bg-zinc-800 border border-zinc-700/50 rounded text-zinc-300">{{ trim($tag) }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-zinc-400">
                                    {{ $project->display_order }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($project->is_featured)
                                        <span class="inline-flex items-center px-2.5 py-0.5 bg-yellow-500/10 text-yellow-400 text-xs font-semibold rounded-full border border-yellow-500/20">
                                            Featured
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 bg-zinc-800 text-zinc-500 text-xs font-semibold rounded-full border border-zinc-700">
                                            Standard
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($project->is_active)
                                        <span class="inline-flex items-center px-2 py-0.5 bg-emerald-500/10 text-emerald-400 text-xs font-medium rounded-full border border-emerald-500/20">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 bg-zinc-800 text-zinc-400 text-xs font-medium rounded-full border border-zinc-700">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2 shrink-0">
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="text-xs text-blue-400 hover:text-blue-300 font-semibold transition duration-150">Edit</a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-500 hover:text-red-400 font-semibold transition duration-150">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
