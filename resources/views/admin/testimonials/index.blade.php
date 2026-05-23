@extends('admin.layout')

@section('title', 'Manage Testimonials')
@section('page_title', 'Testimonials List')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Testimonials Management</h1>
            <p class="text-zinc-400 text-sm mt-1">Kelola testimoni atau rekomendasi klien yang ditampilkan di portfolio.</p>
        </div>
        <div>
            <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-medium text-sm rounded-lg transition duration-200 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transform hover:-translate-y-0.5 active:translate-y-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Testimonial
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-zinc-900/40 backdrop-blur-xl border border-zinc-900 rounded-xl overflow-hidden shadow-xl">
        @if($testimonials->isEmpty())
            <div class="text-center py-16 text-zinc-500">
                <svg class="w-12 h-12 mx-auto mb-4 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                <p class="text-sm">Belum ada testimoni. Klik "Add Testimonial" untuk menambahkan.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-zinc-900 bg-zinc-950/40 text-xs font-semibold text-zinc-400 uppercase tracking-wider">
                            <th class="px-6 py-4">Client Info</th>
                            <th class="px-6 py-4">Message</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-900">
                        @foreach($testimonials as $t)
                            <tr class="hover:bg-zinc-900/20 transition duration-150">
                                <td class="px-6 py-4 flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-zinc-950 border border-zinc-800 flex items-center justify-center shrink-0 overflow-hidden">
                                        @if($t->client_photo)
                                            <img src="{{ asset('storage/' . $t->client_photo) }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-xs font-bold text-zinc-500 uppercase">{{ substr($t->client_name, 0, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <span class="font-semibold text-white text-sm block truncate">{{ $t->client_name }}</span>
                                        <span class="text-xs text-zinc-400 block truncate mt-0.5">{{ $t->position }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-xs text-zinc-300 max-w-xs truncate">
                                    {{ $t->message }}
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
                                    <a href="{{ route('admin.testimonials.edit', $t) }}" class="text-xs text-blue-400 hover:text-blue-300 font-semibold transition duration-150">Edit</a>
                                    <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?')">
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
