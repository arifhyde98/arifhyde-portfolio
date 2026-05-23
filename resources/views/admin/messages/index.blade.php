@extends('admin.layout')

@section('title', 'Contact Messages')
@section('page_title', 'Inbox')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Contact Messages</h1>
        <p class="text-zinc-400 text-sm mt-1">Pesan masuk dari formulir kontak di landing page utama.</p>
    </div>

    <!-- Table Card -->
    <div class="bg-zinc-900/40 backdrop-blur-xl border border-zinc-900 rounded-xl overflow-hidden shadow-xl">
        @if($messages->isEmpty())
            <div class="text-center py-16 text-zinc-500">
                <svg class="w-12 h-12 mx-auto mb-4 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <p class="text-sm">Tidak ada pesan masuk.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-zinc-900 bg-zinc-950/40 text-xs font-semibold text-zinc-400 uppercase tracking-wider">
                            <th class="px-6 py-4">Sender</th>
                            <th class="px-6 py-4">Subject</th>
                            <th class="px-6 py-4">Date Received</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-900">
                        @foreach($messages as $msg)
                            <tr class="hover:bg-zinc-900/20 transition duration-150 {{ !$msg->is_read ? 'bg-blue-600/5' : '' }}">
                                <td class="px-6 py-4">
                                    <div class="space-y-0.5">
                                        <span class="font-semibold text-white text-sm block">{{ $msg->name }}</span>
                                        <span class="text-xs text-zinc-500 block">{{ $msg->email }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-zinc-300 max-w-xs truncate">
                                    {{ $msg->subject ?? '(No Subject)' }}
                                </td>
                                <td class="px-6 py-4 text-xs text-zinc-400">
                                    {{ $msg->created_at->format('M d, Y - H:i') }}
                                    <span class="block text-[10px] text-zinc-500">{{ $msg->created_at->diffForHumans() }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if(!$msg->is_read)
                                        <span class="inline-flex items-center px-2.5 py-0.5 bg-blue-500/10 text-blue-400 text-xs font-semibold rounded-full border border-blue-500/20">
                                            Unread
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 bg-zinc-800 text-zinc-500 text-xs font-semibold rounded-full border border-zinc-700">
                                            Read
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2 shrink-0">
                                    <a href="{{ route('admin.messages.show', $msg) }}" class="text-xs text-blue-400 hover:text-blue-300 font-semibold transition duration-150">Open</a>
                                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
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
            <!-- Pagination links -->
            <div class="px-6 py-4 border-t border-zinc-900 bg-zinc-950/20">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
