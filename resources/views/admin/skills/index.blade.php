@extends('admin.layout')

@section('title', 'Manage Skills')
@section('page_title', 'Skills List')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Skills Management</h1>
            <p class="text-zinc-400 text-sm mt-1">Kelola kemampuan teknis yang ditampilkan di landing page Anda.</p>
        </div>
        <div>
            <a href="{{ route('admin.skills.create') }}" class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-medium text-sm rounded-lg transition duration-200 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transform hover:-translate-y-0.5 active:translate-y-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add New Skill
            </a>
        </div>
    </div>

    <!-- Skills Table Card -->
    <div class="bg-zinc-900/40 backdrop-blur-xl border border-zinc-900 rounded-xl overflow-hidden shadow-xl">
        @if($skills->isEmpty())
            <div class="text-center py-16 text-zinc-500">
                <svg class="w-12 h-12 mx-auto mb-4 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                <p class="text-sm">Belum ada data keahlian. Klik "Add New Skill" untuk menambahkan.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-zinc-900 bg-zinc-950/40 text-xs font-semibold text-zinc-400 uppercase tracking-wider">
                            <th class="px-6 py-4">Skill Name</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Percentage</th>
                            <th class="px-6 py-4">Display Order</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-900">
                        @foreach($skills as $skill)
                            <tr class="hover:bg-zinc-900/20 transition duration-150">
                                <td class="px-6 py-4 flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-lg bg-zinc-950 border border-zinc-800 flex items-center justify-center text-blue-400 text-xs font-bold shrink-0">
                                        {{ substr($skill->name, 0, 2) }}
                                    </div>
                                    <span class="font-medium text-white text-sm">{{ $skill->name }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-zinc-300">
                                    <span class="px-2 py-1 bg-zinc-800 text-zinc-300 rounded-md text-xs font-medium border border-zinc-700/50">
                                        {{ $skill->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-24 bg-zinc-950 border border-zinc-800 rounded-full h-2 overflow-hidden shrink-0">
                                            <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-full rounded-full" style="width: {{ $skill->percentage }}%"></div>
                                        </div>
                                        <span class="text-xs text-zinc-400 font-medium">{{ $skill->percentage }}%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-zinc-400">
                                    {{ $skill->display_order }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($skill->is_active)
                                        <span class="inline-flex items-center px-2 py-0.5 bg-emerald-500/10 text-emerald-400 text-xs font-medium rounded-full border border-emerald-500/20">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 bg-zinc-800 text-zinc-400 text-xs font-medium rounded-full border border-zinc-700">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.skills.edit', $skill) }}" class="text-xs text-blue-400 hover:text-blue-300 font-semibold transition duration-150">Edit</a>
                                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus keahlian ini?')">
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
