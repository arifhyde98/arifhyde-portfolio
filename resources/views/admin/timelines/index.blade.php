@extends('admin.layout')

@section('title', 'Manage Timeline')
@section('page_title', 'Timeline Milestones')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Timeline Management</h1>
            <p class="text-zinc-400 text-sm mt-1">Kelola tonggak sejarah karir atau pencapaian portofolio Anda.</p>
        </div>
        <div>
            <a href="{{ route('admin.timelines.create') }}" class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-medium text-sm rounded-lg transition duration-200 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transform hover:-translate-y-0.5 active:translate-y-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add New Milestone
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-zinc-900/40 backdrop-blur-xl border border-zinc-900 rounded-xl overflow-hidden shadow-xl">
        @if($timelines->isEmpty())
            <div class="text-center py-16 text-zinc-500">
                <svg class="w-12 h-12 mx-auto mb-4 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p class="text-sm">Belum ada pencapaian. Klik "Add New Milestone" untuk menambahkan.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-zinc-900 bg-zinc-950/40 text-xs font-semibold text-zinc-400 uppercase tracking-wider">
                            <th class="px-6 py-4">Year/Date</th>
                            <th class="px-6 py-4">Title</th>
                            <th class="px-6 py-4">Description</th>
                            <th class="px-6 py-4">Display Order</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-900">
                        @foreach($timelines as $t)
                            <tr class="hover:bg-zinc-900/20 transition duration-150">
                                <td class="px-6 py-4 text-sm font-semibold text-white">
                                    {{ $t->year }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-zinc-200">
                                    {{ $t->title }}
                                </td>
                                <td class="px-6 py-4 text-xs text-zinc-400 max-w-sm truncate">
                                    {{ $t->description }}
                                </td>
                                <td class="px-6 py-4 text-sm text-zinc-400">
                                    {{ $t->display_order }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($t->is_active)
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
                                    <a href="{{ route('admin.timelines.edit', $t) }}" class="text-xs text-blue-400 hover:text-blue-300 font-semibold transition duration-150">Edit</a>
                                    <form action="{{ route('admin.timelines.destroy', $t) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus milestone ini?')">
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
