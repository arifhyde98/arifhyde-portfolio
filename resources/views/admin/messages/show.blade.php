@extends('admin.layout')

@section('title', 'Read Message')
@section('page_title', 'Read Message')

@section('content')
<div class="max-w-3xl space-y-6">
    <!-- Header -->
    <div class="flex items-center space-x-2">
        <a href="{{ route('admin.messages.index') }}" class="text-zinc-400 hover:text-white transition duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Read Message</h1>
            <p class="text-zinc-400 text-sm mt-1">Detail pesan kontak dari pengunjung.</p>
        </div>
    </div>

    <!-- Message Detail Card -->
    <div class="bg-zinc-900/40 backdrop-blur-xl border border-zinc-900 rounded-xl overflow-hidden shadow-xl">
        <!-- Sender info banner -->
        <div class="p-6 bg-zinc-950/60 border-b border-zinc-900 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="space-y-1">
                <span class="text-xs font-semibold text-zinc-500 uppercase tracking-wider block">Sender Information</span>
                <h3 class="text-lg font-bold text-white">{{ $message->name }}</h3>
                <p class="text-sm text-zinc-400">
                    Email: <a href="mailto:{{ $message->email }}" class="text-blue-400 hover:underline">{{ $message->email }}</a>
                </p>
            </div>
            <div class="text-right text-xs text-zinc-500">
                <span>Received:</span>
                <span class="block text-zinc-400 font-semibold mt-0.5">{{ $message->created_at->format('F d, Y - H:i:s') }}</span>
                <span class="block text-[11px] mt-0.5">({{ $message->created_at->diffForHumans() }})</span>
            </div>
        </div>

        <!-- Subject & Content -->
        <div class="p-6 lg:p-8 space-y-6">
            <div>
                <span class="text-xs font-semibold text-zinc-500 uppercase tracking-wider block mb-1">Subject</span>
                <h2 class="text-xl font-bold text-white leading-tight">{{ $message->subject ?? '(No Subject)' }}</h2>
            </div>

            <div>
                <span class="text-xs font-semibold text-zinc-500 uppercase tracking-wider block mb-3">Message Content</span>
                <div class="p-5 bg-zinc-950/60 border border-zinc-800 rounded-xl text-zinc-300 text-sm leading-relaxed whitespace-pre-wrap">
                    {{ $message->message }}
                </div>
            </div>
        </div>

        <!-- Footer actions -->
        <div class="p-6 bg-zinc-950/40 border-t border-zinc-900 flex justify-between items-center">
            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-rose-500/10 border border-rose-500/20 hover:border-rose-500/40 text-rose-400 hover:text-rose-300 text-xs font-semibold rounded-lg transition duration-200">
                    Delete Message
                </button>
            </form>
            <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white font-medium text-xs rounded-lg transition duration-200 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transform hover:-translate-y-0.5 active:translate-y-0">
                Reply via Email
            </a>
        </div>
    </div>
</div>
@endsection
