<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>{{ $seo->meta_title ?? 'Arif Hyde | Portofolio' }}</title>
    <meta name="description" content="{{ $seo->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $seo->keywords ?? '' }}">

    <!-- Open Graph (Facebook / LinkedIn) -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $seo->og_title ?? $seo->meta_title }}">
    <meta property="og:description" content="{{ $seo->og_description ?? $seo->meta_description }}">
    @if($seo->og_image)
        <meta property="og:image" content="{{ asset('storage/' . $seo->og_image) }}">
    @endif

    <!-- Favicon -->
    @if($seo->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $seo->favicon) }}">
    @else
        <link rel="icon" type="image/png" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>⚡</text></svg>">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Assets via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: {{ $appearance->primary_color ?? '#3B82F6' }};
            --secondary: {{ $appearance->secondary_color ?? '#8B5CF6' }};
        }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #09090B;
        }
        .glow-hover:hover {
            box-shadow: 0 0 25px -5px var(--primary);
            border-color: rgba(255, 255, 255, 0.2);
        }
        .glass {
            background: rgba(15, 15, 20, 0.6);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>


</head>
<body class="text-zinc-300 relative selection:bg-primary/30 selection:text-white overflow-x-hidden">
    <!-- Glowing background elements -->
    <div class="absolute top-0 left-1/4 -translate-x-1/2 w-[500px] h-[500px] bg-primary/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute top-1/3 right-1/4 translate-x-1/2 w-[500px] h-[500px] bg-secondary/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 left-1/3 -translate-x-1/2 w-[600px] h-[600px] bg-primary/5 rounded-full blur-[150px] pointer-events-none"></div>

    @yield('content')

    <!-- Fade In On Scroll Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100');
                        entry.target.classList.remove('opacity-0', 'translate-y-8');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.reveal').forEach((el) => {
                el.classList.add('transition', 'duration-1000', 'ease-out');
                observer.observe(el);
            });
        });
    </script>
</body>
</html>
