<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Arif Hyde Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #09090B;
        }
    </style>

    @yield('styles')
</head>
<body class="text-zinc-200 min-h-screen flex" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div class="fixed inset-0 bg-black/60 z-40 lg:hidden" 
         x-show="sidebarOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         style="display: none;">
    </div>

    <!-- Sidebar Component -->
    <aside class="fixed top-0 bottom-0 left-0 z-50 w-64 bg-zinc-950 border-r border-zinc-900 flex flex-col justify-between transform transition-transform duration-300 lg:translate-x-0 lg:static"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div>
            <!-- Sidebar Header -->
            <div class="h-16 flex items-center justify-between px-6 border-b border-zinc-900">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                    <span class="text-xl font-bold bg-gradient-to-r from-blue-500 to-purple-500 bg-clip-text text-transparent">Arif Hyde</span>
                    <span class="text-xs px-2 py-0.5 bg-zinc-900 border border-zinc-800 rounded text-zinc-400">CMS</span>
                </a>
                <button class="lg:hidden text-zinc-400 hover:text-white" @click="sidebarOpen = false">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Sidebar Navigation Links -->
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600/10 text-blue-400 border border-blue-500/20' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-200 border border-transparent' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/></svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.profile') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition duration-200 {{ request()->routeIs('admin.profile*') ? 'bg-blue-600/10 text-blue-400 border border-blue-500/20' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-200 border border-transparent' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profile Management
                </a>

                <a href="{{ route('admin.skills.index') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition duration-200 {{ request()->routeIs('admin.skills*') ? 'bg-blue-600/10 text-blue-400 border border-blue-500/20' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-200 border border-transparent' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Skills
                </a>

                <a href="{{ route('admin.projects.index') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition duration-200 {{ request()->routeIs('admin.projects*') ? 'bg-blue-600/10 text-blue-400 border border-blue-500/20' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-200 border border-transparent' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Projects
                </a>

                <a href="{{ route('admin.timelines.index') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition duration-200 {{ request()->routeIs('admin.timelines*') ? 'bg-blue-600/10 text-blue-400 border border-blue-500/20' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-200 border border-transparent' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Timeline
                </a>

                <a href="{{ route('admin.testimonials.index') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition duration-200 {{ request()->routeIs('admin.testimonials*') ? 'bg-blue-600/10 text-blue-400 border border-blue-500/20' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-200 border border-transparent' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    Testimonials
                </a>

                <a href="{{ route('admin.messages.index') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition duration-200 {{ request()->routeIs('admin.messages*') ? 'bg-blue-600/10 text-blue-400 border border-blue-500/20' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-200 border border-transparent' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Contact Messages
                    @php $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="ml-auto bg-blue-600 text-white text-xs px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.settings.seo') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition duration-200 {{ request()->routeIs('admin.settings.seo*') ? 'bg-blue-600/10 text-blue-400 border border-blue-500/20' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-200 border border-transparent' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    SEO Settings
                </a>

                <a href="{{ route('admin.settings.appearance') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition duration-200 {{ request()->routeIs('admin.settings.appearance*') ? 'bg-blue-600/10 text-blue-400 border border-blue-500/20' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-200 border border-transparent' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.344l2.122-2.122a2 2 0 112.828 2.828l-8.485 8.485M7 13.757L10.243 17"/></svg>
                    Appearance
                </a>

                <a href="{{ route('admin.media.index') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition duration-200 {{ request()->routeIs('admin.media*') ? 'bg-blue-600/10 text-blue-400 border border-blue-500/20' : 'text-zinc-400 hover:bg-zinc-900 hover:text-zinc-200 border border-transparent' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Media Manager
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer / Logout -->
        <div class="p-4 border-t border-zinc-900">
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-2.5 text-sm font-medium text-zinc-400 hover:text-white hover:bg-red-950/20 rounded-lg transition duration-200 border border-transparent hover:border-red-900/30">
                    <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Topbar -->
        <header class="h-16 bg-zinc-950 border-b border-zinc-900 flex items-center justify-between px-6 lg:px-8">
            <div class="flex items-center space-x-4">
                <button class="lg:hidden text-zinc-400 hover:text-white focus:outline-none" @click="sidebarOpen = true">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="hidden sm:flex text-sm text-zinc-400 items-center space-x-2">
                    <span>Admin</span>
                    <span>/</span>
                    <span class="text-zinc-200">@yield('page_title', 'Dashboard')</span>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="flex items-center space-x-4" x-data="{ open: false }">
                <div class="relative">
                    <button class="flex items-center space-x-3 text-zinc-300 hover:text-white focus:outline-none" @click="open = !open" @click.away="open = false">
                        <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center font-bold text-white text-sm">
                            AH
                        </div>
                        <span class="hidden md:inline-block text-sm font-medium">Arif Hyde</span>
                        <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-2 w-48 bg-zinc-950 border border-zinc-900 rounded-lg shadow-xl py-1 z-50" x-show="open" style="display: none;">
                        <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-zinc-400 hover:bg-zinc-900 hover:text-white">Your Profile</a>
                        <a href="{{ url('/') }}" target="_blank" class="block px-4 py-2 text-sm text-zinc-400 hover:bg-zinc-900 hover:text-white">View Site</a>
                        <hr class="border-zinc-900 my-1">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-500 hover:bg-red-950/20 hover:text-red-400">Sign Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Inner Dashboard -->
        <main class="flex-1 overflow-y-auto p-6 lg:p-8">
            <!-- Toast Notifications -->
            @if (session('success'))
                <div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-3.5 rounded-lg flex items-center justify-between shadow-lg"
                     x-data="{ show: true }" x-show="show" x-transition>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                    <button class="text-emerald-400 hover:text-emerald-300 focus:outline-none" @click="show = false">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-rose-500/10 border border-rose-500/20 text-rose-400 px-4 py-3.5 rounded-lg flex items-center justify-between shadow-lg"
                     x-data="{ show: true }" x-show="show" x-transition>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                    <button class="text-rose-400 hover:text-rose-300 focus:outline-none" @click="show = false">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif

            <!-- Content Area -->
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
