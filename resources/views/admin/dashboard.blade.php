@extends('admin.layout')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Overview')

@section('content')
<div class="space-y-8">
    <!-- Welcome Header -->
    <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Selamat Datang, Arif Hyde</h1>
        <p class="text-zinc-400 text-sm mt-1">Ini adalah pusat pengelolaan portofolio digital dan otomatisasi sistem Anda.</p>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Projects Card -->
        <div class="bg-zinc-900/40 backdrop-blur-xl border border-white/5 rounded-xl p-6 hover:border-blue-500/20 transition duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wider">Total Projects</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $stats['projects_count'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-blue-500/10 border border-blue-500/20 rounded-lg flex items-center justify-center text-blue-400 group-hover:scale-110 transition duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
            </div>
            <a href="{{ route('admin.projects.index') }}" class="text-xs text-blue-400 hover:text-blue-300 font-medium flex items-center mt-4">
                Manage Projects <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <!-- Skills Card -->
        <div class="bg-zinc-900/40 backdrop-blur-xl border border-white/5 rounded-xl p-6 hover:border-purple-500/20 transition duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wider">Active Skills</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $stats['skills_count'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-purple-500/10 border border-purple-500/20 rounded-lg flex items-center justify-center text-purple-400 group-hover:scale-110 transition duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
            </div>
            <a href="{{ route('admin.skills.index') }}" class="text-xs text-purple-400 hover:text-purple-300 font-medium flex items-center mt-4">
                Manage Skills <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <!-- Messages Card -->
        <div class="bg-zinc-900/40 backdrop-blur-xl border border-white/5 rounded-xl p-6 hover:border-amber-500/20 transition duration-300 group relative">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wider">Total Messages</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $stats['messages_count'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-amber-500/10 border border-amber-500/20 rounded-lg flex items-center justify-center text-amber-400 group-hover:scale-110 transition duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
            </div>
            @if($stats['messages_unread_count'] > 0)
                <span class="absolute top-3 right-3 bg-red-600 border border-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full animate-pulse">
                    {{ $stats['messages_unread_count'] }} Unread
                </span>
            @endif
            <a href="{{ route('admin.messages.index') }}" class="text-xs text-amber-400 hover:text-amber-300 font-medium flex items-center mt-4">
                View Messages <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <!-- Milestones Card -->
        <div class="bg-zinc-900/40 backdrop-blur-xl border border-white/5 rounded-xl p-6 hover:border-emerald-500/20 transition duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wider">Milestones</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $stats['timelines_count'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-emerald-500/10 border border-emerald-500/20 rounded-lg flex items-center justify-center text-emerald-400 group-hover:scale-110 transition duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <a href="{{ route('admin.timelines.index') }}" class="text-xs text-emerald-400 hover:text-emerald-300 font-medium flex items-center mt-4">
                Manage Timeline <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>

    <!-- Details Sections Split Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Messages Timeline (2/3 width on large screens) -->
        <div class="lg:col-span-2 bg-zinc-900/30 border border-zinc-900 rounded-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-white">Recent Messages</h3>
                <a href="{{ route('admin.messages.index') }}" class="text-xs text-zinc-400 hover:text-white transition duration-200">View All</a>
            </div>

            @if($recentMessages->isEmpty())
                <div class="text-center py-12 text-zinc-500 border border-dashed border-zinc-800 rounded-lg">
                    <p class="text-sm">Tidak ada pesan masuk saat ini.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($recentMessages as $msg)
                        <div class="p-4 bg-zinc-950/60 border {{ $msg->is_read ? 'border-zinc-900' : 'border-blue-500/20 bg-blue-500/5' }} rounded-xl flex justify-between items-start transition duration-200">
                            <div class="space-y-1">
                                <div class="flex items-center space-x-2">
                                    <span class="font-medium text-white text-sm">{{ $msg->name }}</span>
                                    <span class="text-xs text-zinc-500">&lt;{{ $msg->email }}&gt;</span>
                                    @if(!$msg->is_read)
                                        <span class="text-[10px] bg-blue-500 text-white font-bold px-1.5 py-0.25 rounded">NEW</span>
                                    @endif
                                </div>
                                <p class="text-xs text-zinc-400 font-semibold">{{ $msg->subject ?? '(No Subject)' }}</p>
                                <p class="text-sm text-zinc-300 line-clamp-2 mt-2 leading-relaxed">{{ $msg->message }}</p>
                            </div>
                            <span class="text-[10px] text-zinc-500">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Recent Projects (1/3 width) -->
        <div class="bg-zinc-900/30 border border-zinc-900 rounded-xl p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-white">Recent Projects</h3>
                    <a href="{{ route('admin.projects.index') }}" class="text-xs text-zinc-400 hover:text-white transition duration-200">View All</a>
                </div>

                @if($recentProjects->isEmpty())
                    <div class="text-center py-12 text-zinc-500 border border-dashed border-zinc-800 rounded-lg">
                        <p class="text-sm">Belum ada proyek ditambahkan.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($recentProjects as $project)
                            <div class="p-3 bg-zinc-950/60 border border-zinc-900 rounded-xl flex items-center space-x-4">
                                <div class="w-12 h-12 bg-zinc-900 rounded-lg border border-zinc-800 flex items-center justify-center shrink-0 overflow-hidden">
                                    @if($project->image)
                                        <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-xs font-bold text-zinc-500 uppercase">{{ substr($project->title, 0, 2) }}</span>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-medium text-sm text-white truncate">{{ $project->title }}</h4>
                                    <p class="text-xs text-zinc-500 truncate mt-1">{{ $project->tech_tags }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Quick Link / Shortcut Action -->
            <div class="mt-8 p-4 bg-gradient-to-r from-blue-900/20 to-purple-900/20 border border-blue-500/10 rounded-xl">
                <h4 class="text-sm font-semibold text-white">Quick Shortcut</h4>
                <p class="text-xs text-zinc-400 mt-1">Tambahkan proyek baru Anda sekarang secara instan.</p>
                <a href="{{ route('admin.projects.create') }}" class="mt-3 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white font-medium text-xs rounded-lg transition duration-200">
                    + Add New Project
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
