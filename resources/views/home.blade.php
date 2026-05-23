@extends('layouts.public')

@section('content')
<!-- Navbar -->
<header class="fixed top-0 left-0 right-0 z-50 glass border-b border-white/5 transition-all duration-300" 
        x-data="{ isOpen: false, scrolled: false }" 
        @scroll.window="scrolled = (window.pageYOffset > 20)">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
        <!-- Brand logo -->
        <a href="#home" class="flex items-center space-x-2">
            <span class="text-xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent tracking-tight">Arif Hyde</span>
        </a>

        <!-- Desktop Menu -->
        <nav class="hidden md:flex items-center space-x-8 text-sm font-medium">
            <a href="#home" class="text-zinc-400 hover:text-white transition duration-200">Home</a>
            <a href="#about" class="text-zinc-400 hover:text-white transition duration-200">About</a>
            <a href="#skills" class="text-zinc-400 hover:text-white transition duration-200">Skills</a>
            <a href="#projects" class="text-zinc-400 hover:text-white transition duration-200">Projects</a>
            <a href="#timeline" class="text-zinc-400 hover:text-white transition duration-200">Timeline</a>
            <a href="#contact" class="text-zinc-400 hover:text-white transition duration-200">Contact</a>
        </nav>

        <!-- CTA Button -->
        <div class="hidden md:block">
            <a href="#contact" class="px-5 py-2 rounded-lg text-sm font-semibold bg-gradient-to-r from-primary to-secondary hover:opacity-90 text-white shadow-lg shadow-primary/10 hover:shadow-primary/20 transform hover:-translate-y-0.5 active:translate-y-0 transition duration-200">
                {{ $appearance->cta_text ?? 'Contact Me' }}
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-zinc-400 hover:text-white focus:outline-none" @click="isOpen = !isOpen">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" x-show="!isOpen"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" x-show="isOpen" style="display: none;"/>
            </svg>
        </button>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div class="md:hidden glass border-b border-white/5 py-4 px-6 space-y-3" x-show="isOpen" style="display: none;">
        <a href="#home" class="block text-zinc-400 hover:text-white text-sm font-medium" @click="isOpen = false">Home</a>
        <a href="#about" class="block text-zinc-400 hover:text-white text-sm font-medium" @click="isOpen = false">About</a>
        <a href="#skills" class="block text-zinc-400 hover:text-white text-sm font-medium" @click="isOpen = false">Skills</a>
        <a href="#projects" class="block text-zinc-400 hover:text-white text-sm font-medium" @click="isOpen = false">Projects</a>
        <a href="#timeline" class="block text-zinc-400 hover:text-white text-sm font-medium" @click="isOpen = false">Timeline</a>
        <a href="#contact" class="block text-zinc-400 hover:text-white text-sm font-medium" @click="isOpen = false">Contact</a>
        <a href="#contact" class="block text-center py-2.5 bg-gradient-to-r from-primary to-secondary rounded-lg text-sm font-semibold text-white" @click="isOpen = false">
            {{ $appearance->cta_text ?? 'Contact Me' }}
        </a>
    </div>
</header>

<!-- Hero Section -->
<section id="home" class="min-h-screen pt-32 pb-20 px-6 flex items-center max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center w-full">
        <!-- Headline / Intro -->
        <div class="lg:col-span-7 space-y-6 reveal opacity-0 translate-y-8">
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 text-xs font-semibold text-primary">
                <span class="w-1.5 h-1.5 rounded-full bg-primary animate-ping"></span>
                <span>Available for new projects</span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-tight">
                {{ $appearance->hero_headline ?? 'Building Digital Solutions That Solve Real Problems' }}
            </h1>
            <p class="text-zinc-400 text-lg sm:text-xl max-w-2xl font-light leading-relaxed">
                {{ $appearance->hero_subtitle ?? 'Full-stack developer focused on building scalable systems, automation tools, and modern web applications.' }}
            </p>
            <div class="flex flex-wrap gap-4 pt-4">
                <a href="#projects" class="px-6 py-3 rounded-lg text-sm font-semibold bg-gradient-to-r from-primary to-secondary hover:opacity-90 text-white shadow-lg shadow-primary/10 hover:shadow-primary/20 transform hover:-translate-y-0.5 active:translate-y-0 transition duration-200">
                    View Projects
                </a>
                <a href="#contact" class="px-6 py-3 rounded-lg text-sm font-semibold border border-white/10 hover:border-white/20 text-zinc-300 hover:text-white transition duration-200 bg-zinc-950/40">
                    Contact Me
                </a>
            </div>
        </div>

        <!-- Profile Card with Glow effect -->
        <div class="lg:col-span-5 flex justify-center reveal opacity-0 translate-y-8 delay-200">
            <div class="w-full max-w-[380px] relative group">
                <!-- Outer glowing blob behind card -->
                <div class="absolute -inset-1.5 bg-gradient-to-r from-primary to-secondary rounded-2xl blur opacity-30 group-hover:opacity-40 transition duration-300"></div>
                <!-- Card Container -->
                <div class="relative bg-zinc-950 border border-white/10 rounded-2xl p-6 shadow-2xl space-y-6">
                    <div class="w-full aspect-square bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden relative">
                        @if($profile->profile_photo)
                            <img src="{{ asset('storage/' . $profile->profile_photo) }}" class="w-full h-full object-cover">
                        @else
                            <!-- Cool minimalist profile avatar placeholder -->
                            <div class="w-full h-full bg-gradient-to-br from-zinc-950 to-zinc-900 flex flex-col items-center justify-center text-white relative">
                                <span class="text-6xl font-bold tracking-tighter bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">AH</span>
                                <span class="text-xs uppercase font-mono tracking-widest text-primary mt-2">Arif Hyde</span>
                                <div class="absolute bottom-4 text-[10px] text-zinc-500 font-mono">PORTFOLIO EDITION</div>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white tracking-tight">{{ $profile->name }}</h3>
                        <p class="text-sm text-primary font-medium mt-1">{{ $profile->title }}</p>
                        <p class="text-xs text-zinc-500 mt-2 leading-relaxed">
                            Specializing in Laravel backend architecture, MySQL optimizations, and interactive SPAs.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section (Bento Grid) -->
<section id="about" class="py-24 px-6 border-t border-white/5 bg-zinc-950/20">
    <div class="max-w-7xl mx-auto space-y-12">
        <div class="text-center space-y-4 max-w-3xl mx-auto reveal opacity-0 translate-y-8">
            <span class="text-xs font-semibold text-primary uppercase tracking-widest">ABOUT ME</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Full-Stack Development Philosophy</h2>
            <p class="text-zinc-400 leading-relaxed font-light">Pendekatan saya terhadap rekayasa perangkat lunak adalah tentang struktur data yang kokoh, arsitektur bersih, dan otomatisasi pintar.</p>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Full stack -->
            <div class="glass rounded-2xl p-6 md:col-span-2 space-y-3 glow-hover transition-all duration-300 reveal opacity-0 translate-y-8">
                <div class="w-10 h-10 rounded-lg bg-primary/10 border border-primary/20 flex items-center justify-center text-primary mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                </div>
                <h3 class="text-lg font-bold text-white">Full-Stack Developer</h3>
                <p class="text-sm text-zinc-400 leading-relaxed">Merancang siklus hidup aplikasi secara menyeluruh, dari skema tabel database berkinerja tinggi, logika backend RESTful API Laravel, hingga interaktivitas frontend yang responsif dan respons cepat.</p>
            </div>

            <!-- Laravel -->
            <div class="glass rounded-2xl p-6 space-y-3 glow-hover transition-all duration-300 reveal opacity-0 translate-y-8 delay-100">
                <div class="w-10 h-10 rounded-lg bg-secondary/10 border border-secondary/20 flex items-center justify-center text-secondary mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-white">Laravel & PHP Specialist</h3>
                <p class="text-sm text-zinc-400 leading-relaxed">Penguasaan mendalam atas ORM Eloquent, Laravel Queues, Service Container, Event Listeners, dan pembuatan paket kustom modular.</p>
            </div>

            <!-- Government asset experience -->
            <div class="glass rounded-2xl p-6 space-y-3 glow-hover transition-all duration-300 reveal opacity-0 translate-y-8">
                <div class="w-10 h-10 rounded-lg bg-secondary/10 border border-secondary/20 flex items-center justify-center text-secondary mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-lg font-bold text-white">Government Asset Systems</h3>
                <p class="text-sm text-zinc-400 leading-relaxed">Berpengalaman merancang sistem pelaporan inventaris tanah dan armada mobil pemerintah yang aman, transparan, dan terstandarisasi undang-undang.</p>
            </div>

            <!-- Automation -->
            <div class="glass rounded-2xl p-6 md:col-span-2 space-y-3 glow-hover transition-all duration-300 reveal opacity-0 translate-y-8 delay-100">
                <div class="w-10 h-10 rounded-lg bg-primary/10 border border-primary/20 flex items-center justify-center text-primary mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                </div>
                <h3 class="text-lg font-bold text-white">Automation & Data Processing Focus</h3>
                <p class="text-sm text-zinc-400 leading-relaxed">Menghemat ratusan jam kerja operasional dengan mengotomatiskan validasi ribuan baris data Excel secara asinkron menggunakan queue worker dan database caching.</p>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section id="skills" class="py-24 px-6 border-t border-white/5">
    <div class="max-w-7xl mx-auto space-y-12">
        <div class="text-center space-y-4 max-w-3xl mx-auto reveal opacity-0 translate-y-8">
            <span class="text-xs font-semibold text-primary uppercase tracking-widest">TECHNICAL STACK</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Keahlian & Perkakas Kerja</h2>
            <p class="text-zinc-400 leading-relaxed font-light">Kombinasi teknologi yang saya gunakan secara intensif untuk menyelesaikan tantangan komputasi rumit.</p>
        </div>

        <!-- Skills grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($skills as $skill)
                <div class="glass rounded-xl p-5 hover:border-primary/20 hover:bg-zinc-900/40 hover:-translate-y-1 transition-all duration-300 relative group reveal opacity-0 translate-y-8">
                    <!-- Icon Area (Simple letters, matching aesthetic) -->
                    <div class="w-8 h-8 rounded-lg bg-zinc-950 border border-zinc-800 flex items-center justify-center text-primary text-xs font-bold font-mono uppercase mb-4">
                        {{ substr($skill->name, 0, 2) }}
                    </div>
                    <span class="font-semibold text-white block text-sm">{{ $skill->name }}</span>
                    <span class="text-xs text-zinc-500 block mt-0.5">{{ $skill->category }}</span>
                    <!-- Progress line -->
                    <div class="w-full bg-zinc-950 rounded-full h-1.5 mt-4 overflow-hidden border border-zinc-900">
                        <div class="bg-gradient-to-r from-primary to-secondary h-full rounded-full group-hover:scale-x-105 origin-left transition-transform duration-300" style="width: {{ $skill->percentage }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Projects Section -->
<section id="projects" class="py-24 px-6 border-t border-white/5 bg-zinc-950/20" x-data="{ activeProject: null }">
    <div class="max-w-7xl mx-auto space-y-12">
        <div class="text-center space-y-4 max-w-3xl mx-auto reveal opacity-0 translate-y-8">
            <span class="text-xs font-semibold text-primary uppercase tracking-widest">PORTFOLIO SHOWCASE</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Featured Projects</h2>
            <p class="text-zinc-400 leading-relaxed font-light">Proyek-proyek unggulan yang telah diimplementasikan secara komersial dan sukses menyelesaikan masalah operasional.</p>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $p)
                <div class="glass rounded-2xl overflow-hidden flex flex-col justify-between hover:border-zinc-800 group hover:-translate-y-1 transition duration-300 reveal opacity-0 translate-y-8">
                    <div>
                        <!-- Thumbnail area -->
                        <div class="aspect-video bg-zinc-950 relative overflow-hidden border-b border-white/5 flex items-center justify-center shrink-0">
                            @if($p->image)
                                <img src="{{ asset('storage/' . $p->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-zinc-950 to-zinc-900 flex items-center justify-center font-bold text-white text-3xl select-none uppercase tracking-widest font-mono">
                                    {{ $p->title }}
                                </div>
                            @endif
                            @if($p->is_featured)
                                <span class="absolute top-4 right-4 bg-primary/15 border border-primary/30 text-primary text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">FEATURED</span>
                            @endif
                        </div>

                        <!-- Info Area -->
                        <div class="p-6 space-y-4">
                            <div class="space-y-1">
                                <h3 class="text-xl font-bold text-white group-hover:text-primary transition duration-200">{{ $p->title }}</h3>
                                <p class="text-xs text-zinc-400 font-semibold">{{ $p->short_description }}</p>
                            </div>
                            <div class="flex flex-wrap gap-1">
                                @foreach(explode(',', $p->tech_tags) as $tag)
                                    <span class="text-[10px] font-mono px-2 py-0.5 bg-zinc-900 border border-zinc-800 rounded text-zinc-400">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Footer actions -->
                    <div class="p-6 pt-0 border-t border-transparent flex gap-3 mt-auto">
                        <button @click="activeProject = @js($p)" class="flex-1 text-center py-2 bg-zinc-900 hover:bg-zinc-800 border border-white/5 rounded-lg text-xs font-semibold text-white transition duration-200">
                            View Details
                        </button>
                        @if($p->github_link)
                            <a href="{{ $p->github_link }}" target="_blank" class="px-3 py-2 bg-zinc-950 hover:bg-zinc-900 border border-zinc-850 rounded-lg text-zinc-400 hover:text-white transition duration-200" title="Source Code">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Project Detail Modal (AlpineJS overlay) -->
        <div class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4" 
             x-show="activeProject !== null" 
             x-transition
             style="display: none;">
            <div class="bg-zinc-950 border border-zinc-900 w-full max-w-2xl rounded-2xl overflow-hidden shadow-2xl relative"
                 @click.away="activeProject = null">
                
                <!-- Close Button -->
                <button @click="activeProject = null" class="absolute top-4 right-4 text-zinc-400 hover:text-white bg-zinc-900 border border-zinc-800 rounded-full w-8 h-8 flex items-center justify-center transition duration-200 z-10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <!-- Modal Content -->
                <template x-if="activeProject !== null">
                    <div>
                        <!-- Modal Image Banner -->
                        <div class="aspect-video bg-zinc-900 relative">
                            <template x-if="activeProject.image">
                                <img :src="'{{ asset('storage') }}/' + activeProject.image" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!activeProject.image">
                                <div class="w-full h-full bg-gradient-to-br from-zinc-950 to-zinc-900 flex items-center justify-center font-bold text-white text-3xl uppercase tracking-widest font-mono">
                                    <span x-text="activeProject.title"></span>
                                </div>
                            </template>
                        </div>
                        
                        <!-- Modal Details -->
                        <div class="p-6 lg:p-8 space-y-6">
                            <div class="space-y-2">
                                <h3 class="text-2xl font-extrabold text-white" x-text="activeProject.title"></h3>
                                <p class="text-xs text-primary font-semibold" x-text="activeProject.short_description"></p>
                            </div>
                            
                            <div class="space-y-2">
                                <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest block">Project Overview</span>
                                <p class="text-zinc-300 text-sm leading-relaxed whitespace-pre-line" x-text="activeProject.full_description"></p>
                            </div>

                            <div class="space-y-2">
                                <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest block">Technologies Used</span>
                                <div class="flex flex-wrap gap-1">
                                    <template x-for="tag in activeProject.tech_tags.split(',')">
                                        <span class="text-xs font-mono px-2 py-0.5 bg-zinc-900 border border-zinc-800 rounded text-zinc-400" x-text="tag.trim()"></span>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Action footer -->
                        <div class="p-6 bg-zinc-950/60 border-t border-zinc-900 flex justify-end gap-3">
                            <template x-if="activeProject.github_link">
                                <a :href="activeProject.github_link" target="_blank" class="px-4 py-2 border border-white/5 hover:border-white/10 bg-zinc-900 hover:bg-zinc-800 text-zinc-300 hover:text-white text-xs font-semibold rounded-lg transition duration-200">
                                    View Source Code
                                </a>
                            </template>
                            <template x-if="activeProject.live_link">
                                <a :href="activeProject.live_link" target="_blank" class="px-4 py-2 bg-primary hover:opacity-90 text-white text-xs font-semibold rounded-lg transition duration-200">
                                    Live Demo
                                </a>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</section>

<!-- Timeline Section -->
<section id="timeline" class="py-24 px-6 border-t border-white/5">
    <div class="max-w-4xl mx-auto space-y-16">
        <div class="text-center space-y-4 max-w-3xl mx-auto reveal opacity-0 translate-y-8">
            <span class="text-xs font-semibold text-primary uppercase tracking-widest">JOURNEY & EXPERIENCE</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Timeline Milestone</h2>
            <p class="text-zinc-400 leading-relaxed font-light">Perjalanan karir dan pencapaian profesional sepanjang waktu.</p>
        </div>

        <!-- Vertical Timeline Graphic -->
        <div class="relative border-l border-white/5 pl-8 ml-4 space-y-12">
            @foreach($timelines as $t)
                <div class="relative reveal opacity-0 translate-y-8">
                    <!-- Glowing circular pointer -->
                    <span class="absolute -left-[41px] top-1 flex items-center justify-center rounded-full bg-[#09090B] border border-primary/30 w-5 h-5 shadow-lg shadow-primary/20">
                        <span class="rounded-full bg-primary w-2 h-2"></span>
                    </span>
                    
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-primary font-mono tracking-wider">{{ $t->year }}</span>
                        <h3 class="text-lg font-bold text-white">{{ $t->title }}</h3>
                        <p class="text-sm text-zinc-400 leading-relaxed max-w-2xl font-light">{{ $t->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Carousel Section -->
<section id="testimonials" class="py-24 px-6 border-t border-white/5 bg-zinc-950/20">
    <div class="max-w-4xl mx-auto space-y-12">
        <div class="text-center space-y-4 max-w-3xl mx-auto reveal opacity-0 translate-y-8">
            <span class="text-xs font-semibold text-primary uppercase tracking-widest">CLIENT STORIES</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Rekomendasi & Ulasan Klien</h2>
        </div>

        <div class="grid grid-cols-1 gap-6 reveal opacity-0 translate-y-8">
            @foreach($testimonials as $t)
                <div class="glass rounded-2xl p-8 relative flex flex-col justify-between space-y-6">
                    <p class="text-zinc-300 italic leading-relaxed text-base font-light">
                        "{{ $t->message }}"
                    </p>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-full bg-zinc-900 border border-zinc-800 flex items-center justify-center overflow-hidden shrink-0">
                            @if($t->client_photo)
                                <img src="{{ asset('storage/' . $t->client_photo) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-sm font-bold text-zinc-500 uppercase">{{ substr($t->client_name, 0, 2) }}</span>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-sm">{{ $t->client_name }}</h4>
                            <p class="text-xs text-zinc-500 mt-0.5">{{ $t->position }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-24 px-6 border-t border-white/5">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Contact info -->
            <div class="lg:col-span-5 space-y-8 reveal opacity-0 translate-y-8">
                <div class="space-y-4">
                    <span class="text-xs font-semibold text-primary uppercase tracking-widest">GET IN TOUCH</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Let's Build Something Useful</h2>
                    <p class="text-zinc-400 leading-relaxed font-light">Terbuka untuk kolaborasi proyek, pembuatan sistem manajemen data, integrasi API, atau diskusi pengembangan perangkat lunak kustom.</p>
                </div>

                <div class="space-y-4">
                    <!-- Email -->
                    @if($profile->email)
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-lg bg-zinc-900 border border-zinc-850 flex items-center justify-center text-zinc-400 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <span class="text-[10px] text-zinc-500 font-bold uppercase tracking-wider block">Email Address</span>
                                <a href="mailto:{{ $profile->email }}" class="text-sm font-medium text-white hover:text-primary transition">{{ $profile->email }}</a>
                            </div>
                        </div>
                    @endif

                    <!-- WhatsApp -->
                    @if($profile->whatsapp)
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-lg bg-zinc-900 border border-zinc-850 flex items-center justify-center text-zinc-400 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <span class="text-[10px] text-zinc-500 font-bold uppercase tracking-wider block">WhatsApp</span>
                                <a href="https://wa.me/{{ $profile->whatsapp }}" target="_blank" class="text-sm font-medium text-white hover:text-primary transition">+{{ $profile->whatsapp }}</a>
                            </div>
                        </div>
                    @endif

                    <!-- Social Icons -->
                    <div class="flex items-center space-x-3 pt-4">
                        @if($profile->github)
                            <a href="{{ $profile->github }}" target="_blank" class="w-10 h-10 rounded-lg bg-zinc-900 hover:bg-zinc-850 border border-zinc-850 flex items-center justify-center text-zinc-400 hover:text-white transition duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            </a>
                        @endif
                        @if($profile->linkedin)
                            <a href="{{ $profile->linkedin }}" target="_blank" class="w-10 h-10 rounded-lg bg-zinc-900 hover:bg-zinc-850 border border-zinc-850 flex items-center justify-center text-zinc-400 hover:text-white transition duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Form (with secure async submission) -->
            <div class="lg:col-span-7 bg-zinc-900/30 border border-zinc-900 rounded-2xl p-6 lg:p-8 reveal opacity-0 translate-y-8 delay-100" 
                 x-data="{ 
                     name: '', 
                     email: '', 
                     subject: '', 
                     message: '', 
                     loading: false, 
                     successMessage: '', 
                     errorMessage: '',
                     async submitForm() {
                         this.loading = true;
                         this.successMessage = '';
                         this.errorMessage = '';
                         try {
                             const response = await fetch('{{ route('contact.post') }}', {
                                 method: 'POST',
                                 headers: {
                                     'Content-Type': 'application/json',
                                     'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                     'X-Requested-With': 'XMLHttpRequest'
                                 },
                                 body: JSON.stringify({
                                     name: this.name,
                                     email: this.email,
                                     subject: this.subject,
                                     message: this.message
                                 })
                             });
                             const data = await response.json();
                             if (response.ok && data.success) {
                                 this.successMessage = data.message;
                                 this.name = '';
                                 this.email = '';
                                 this.subject = '';
                                 this.message = '';
                             } else {
                                 this.errorMessage = data.message || 'Gagal mengirim pesan. Periksa kembali form Anda.';
                             }
                         } catch (error) {
                             this.errorMessage = 'Terjadi kesalahan sistem. Silakan coba lagi.';
                         } finally {
                             this.loading = false;
                         }
                     }
                 }">
                <h3 class="text-lg font-bold text-white mb-6">Send Me a Message</h3>

                <!-- Success Alert -->
                <div x-show="successMessage" x-transition class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm px-4 py-3.5 rounded-lg mb-6 flex items-center" style="display: none;">
                    <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span x-text="successMessage"></span>
                </div>

                <!-- Error Alert -->
                <div x-show="errorMessage" x-transition class="bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm px-4 py-3.5 rounded-lg mb-6 flex items-center" style="display: none;">
                    <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span x-text="errorMessage"></span>
                </div>

                <form @submit.prevent="submitForm" class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Name -->
                        <div>
                            <label for="c_name" class="block text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-1.5">Your Name</label>
                            <input type="text" x-model="name" id="c_name" required
                                class="w-full px-4 py-2.5 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white placeholder-zinc-650 focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary/40 transition duration-250"
                                placeholder="Arif Hyde">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="c_email" class="block text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-1.5">Email Address</label>
                            <input type="email" x-model="email" id="c_email" required
                                class="w-full px-4 py-2.5 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white placeholder-zinc-650 focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary/40 transition duration-250"
                                placeholder="name@domain.com">
                        </div>
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="c_subject" class="block text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-1.5">Subject</label>
                        <input type="text" x-model="subject" id="c_subject"
                            class="w-full px-4 py-2.5 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white placeholder-zinc-650 focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary/40 transition duration-250"
                            placeholder="How can I help you?">
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="c_message" class="block text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-1.5">Message</label>
                        <textarea x-model="message" id="c_message" rows="5" required
                            class="w-full px-4 py-2.5 bg-zinc-950/60 border border-zinc-800 rounded-lg text-white placeholder-zinc-650 focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary/40 transition duration-250"
                            placeholder="Write your project requirements or hello here..."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" :disabled="loading"
                        class="w-full py-3 bg-gradient-to-r from-primary to-secondary hover:opacity-90 disabled:opacity-50 text-white font-semibold rounded-lg shadow-lg shadow-primary/10 hover:shadow-primary/20 transform hover:-translate-y-0.5 disabled:pointer-events-none transition duration-200 flex items-center justify-center space-x-2">
                        <span x-show="!loading">Send Message</span>
                        <span x-show="loading" style="display: none;">Sending...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Floating AI Chat Widget -->
<div x-data="aiChatbox()" class="fixed bottom-6 right-6 z-50 font-sans">
    <!-- Pulsing Trigger Button -->
    <button @click="toggle()" 
        class="w-14 h-14 rounded-full bg-gradient-to-r from-primary to-secondary text-white shadow-xl shadow-primary/20 hover:shadow-primary/45 flex items-center justify-center hover:-translate-y-1 hover:scale-105 active:scale-95 transition-all duration-300 relative group">
        <span class="absolute -top-1 -right-1 w-4 h-4 bg-emerald-500 rounded-full border-2 border-zinc-950 animate-ping"></span>
        <span class="absolute -top-1 -right-1 w-4 h-4 bg-emerald-500 rounded-full border-2 border-zinc-950"></span>
        <!-- Chat Icon -->
        <svg class="w-6 h-6 transform group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
        </svg>
    </button>

    <!-- Chat Window -->
    <div x-show="open" 
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-8 scale-90"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-8 scale-90"
        @click.away="open = false"
        class="absolute bottom-18 right-0 w-[320px] md:w-[360px] h-[450px] bg-zinc-950/90 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl overflow-hidden flex flex-col"
        style="display: none;">
        
        <!-- Header -->
        <div class="px-4 py-3.5 bg-gradient-to-r from-zinc-950 to-zinc-900 border-b border-white/5 flex items-center justify-between">
            <div class="flex items-center space-x-2.5">
                <div class="w-7 h-7 rounded-full bg-primary/20 border border-primary/30 flex items-center justify-center font-bold text-primary text-[10px]">
                    AH
                </div>
                <div>
                    <h4 class="text-xs font-semibold text-white">Arif's AI Assistant</h4>
                    <span class="flex items-center text-[9px] text-emerald-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1 animate-pulse"></span>
                        Online (Laravel 13 AI SDK)
                    </span>
                </div>
            </div>
            <button @click="open = false" class="text-zinc-550 hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Messages Area -->
        <div class="flex-1 p-3.5 overflow-y-auto space-y-2.5 scrollbar-thin scrollbar-thumb-zinc-800" id="chat-messages">
            <!-- Welcome message -->
            <div class="flex items-start space-x-2">
                <div class="w-5 h-5 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center text-[9px] font-bold text-primary shrink-0">AI</div>
                <div class="bg-zinc-900/60 border border-white/5 text-zinc-300 text-[11px] px-2.5 py-1.5 rounded-lg max-w-[85%] leading-relaxed">
                    Halo! Saya adalah Asisten AI Virtual Arif Hyde. Tanyakan apa saja tentang keahlian, proyek, atau cara menghubungi Arif! ⚡
                </div>
            </div>

            <!-- Dynamic Messages -->
            <template x-for="(msg, index) in messages" :key="index">
                <div class="flex items-start" :class="msg.role === 'user' ? 'justify-end' : 'space-x-2'">
                    <!-- Bot Avatar -->
                    <template x-if="msg.role === 'bot'">
                        <div class="w-5 h-5 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center text-[9px] font-bold text-primary shrink-0">AI</div>
                    </template>
                    
                    <div class="text-[11px] px-2.5 py-1.5 rounded-lg max-w-[85%] leading-relaxed"
                        :class="msg.role === 'user' 
                            ? 'bg-gradient-to-r from-primary to-secondary text-white rounded-br-none' 
                            : 'bg-zinc-900/60 border border-white/5 text-zinc-300 rounded-bl-none'">
                        <span x-text="msg.text"></span>
                    </div>
                </div>
            </template>

            <!-- Typing indicator -->
            <div x-show="typing" class="flex items-start space-x-2" style="display: none;">
                <div class="w-5 h-5 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center text-[9px] font-bold text-primary shrink-0">AI</div>
                <div class="bg-zinc-900/60 border border-white/5 text-zinc-400 text-[11px] px-2.5 py-1.5 rounded-lg flex items-center space-x-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-zinc-450 animate-bounce"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-zinc-450 animate-bounce" style="animation-delay: 0.2s"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-zinc-450 animate-bounce" style="animation-delay: 0.4s"></span>
                </div>
            </div>
        </div>

        <!-- Quick prompts suggestions -->
        <div class="px-3 py-1.5 border-t border-white/5 bg-zinc-950/40 flex flex-wrap gap-1">
            <button @click="sendQuickPrompt('Siapa Arif Hyde?')" class="text-[9px] bg-zinc-900/40 hover:bg-zinc-900 border border-white/5 text-zinc-300 px-2 py-0.5 rounded transition">Who is Arif?</button>
            <button @click="sendQuickPrompt('Apa proyek unggulan Arif?')" class="text-[9px] bg-zinc-900/40 hover:bg-zinc-900 border border-white/5 text-zinc-300 px-2 py-0.5 rounded transition">Projects</button>
            <button @click="sendQuickPrompt('Bagaimana menghubungi Arif?')" class="text-[9px] bg-zinc-900/40 hover:bg-zinc-900 border border-white/5 text-zinc-300 px-2 py-0.5 rounded transition">Contact</button>
        </div>

        <!-- Input Area -->
        <form @submit.prevent="sendMessage()" class="p-2.5 border-t border-white/5 bg-zinc-950 flex items-center space-x-2">
            <input type="text" x-model="input" placeholder="Tanyakan sesuatu..." required
                class="flex-1 bg-zinc-900 border border-zinc-800 rounded-lg px-3 py-1.5 text-xs text-white placeholder-zinc-500 focus:outline-none focus:ring-1 focus:ring-primary/50 focus:border-primary/50 transition">
            <button type="submit" :disabled="typing || !input.trim()"
                class="p-1.5 bg-gradient-to-r from-primary to-secondary text-white rounded-lg hover:opacity-90 disabled:opacity-40 transition shrink-0">
                <svg class="w-3.5 h-3.5 transform rotate-90" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
function aiChatbox() {
    return {
        open: false,
        input: '',
        messages: [],
        typing: false,
        
        toggle() {
            this.open = !this.open;
            if (this.open) {
                this.scrollToBottom();
            }
        },
        
        sendQuickPrompt(prompt) {
            this.input = prompt;
            this.sendMessage();
        },
        
        async sendMessage() {
            if (!this.input.trim() || this.typing) return;
            
            const userMsg = this.input.trim();
            this.messages.push({ role: 'user', text: userMsg });
            this.input = '';
            this.typing = true;
            this.scrollToBottom();
            
            try {
                const response = await fetch("{{ route('ai.chat') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ message: userMsg })
                });
                
                const data = await response.json();
                
                this.typing = false;
                if (data.success) {
                    this.messages.push({ role: 'bot', text: data.reply });
                } else {
                    this.messages.push({ role: 'bot', text: 'Maaf, sistem AI sedang sibuk. Silakan coba kembali sesaat lagi.' });
                }
            } catch (error) {
                this.typing = false;
                this.messages.push({ role: 'bot', text: 'Koneksi terputus. Silakan periksa jaringan Anda.' });
            }
            this.scrollToBottom();
        },
        
        scrollToBottom() {
            setTimeout(() => {
                const chatContainer = document.getElementById('chat-messages');
                if (chatContainer) {
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }
            }, 50);
        }
    }
}
</script>

<!-- Footer -->
<footer class="py-12 px-6 border-t border-white/5 bg-zinc-950 text-center text-xs text-zinc-500 space-y-3">
    <p class="font-mono text-zinc-400">© 2026 Arif Hyde. Built with passion and clean code.</p>
    <div class="flex justify-center space-x-4">
        <a href="#home" class="hover:text-zinc-300">Home</a>
        <span>•</span>
        <a href="#about" class="hover:text-zinc-300">About</a>
        <span>•</span>
        <a href="#skills" class="hover:text-zinc-300">Skills</a>
        <span>•</span>
        <a href="#projects" class="hover:text-zinc-300">Projects</a>
        <span>•</span>
        <a href="#timeline" class="hover:text-zinc-300">Timeline</a>
    </div>
    <div class="pt-4">
        <a href="{{ route('login') }}" class="text-[10px] text-zinc-600 hover:text-zinc-400 border border-zinc-900 rounded px-2.5 py-1">Admin Panel Login</a>
    </div>
</footer>
@endsection
