<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Timeline;
use App\Models\Testimonial;
use App\Models\SeoSetting;
use App\Models\AppearanceSetting;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch or load default fallbacks
        $profile = Profile::first() ?? (object) [
            'name' => 'Arif Hyde',
            'title' => 'Full-Stack Developer & Automation Specialist',
            'short_bio' => 'Full-stack developer focused on building scalable systems, automation tools, and modern web applications.',
            'about_description' => 'I am a highly motivated and detail-oriented Full-Stack Developer with extensive experience in the PHP/Laravel ecosystem. I specialize in designing robust backend systems, automated data processing engines, and clean, high-performance user interfaces. With a strong foundation in clean architecture and database optimization, I have successfully delivered high-impact government asset management systems (SIPAT, E-RANDIS) and advanced automation tools that save hundreds of operational hours.',
            'profile_photo' => null,
            'resume_url' => null,
            'email' => 'contact@arifhyde.com',
            'whatsapp' => '628123456789',
            'github' => 'https://github.com/arifhyde',
            'linkedin' => 'https://linkedin.com/in/arifhyde',
        ];

        $skills = Skill::where('is_active', true)->orderBy('display_order')->get();
        if ($skills->isEmpty()) {
            $skills = collect([
                (object) ['name' => 'PHP', 'icon' => 'php', 'percentage' => 95, 'category' => 'Backend'],
                (object) ['name' => 'Laravel', 'icon' => 'laravel', 'percentage' => 95, 'category' => 'Backend'],
                (object) ['name' => 'MySQL', 'icon' => 'mysql', 'percentage' => 90, 'category' => 'Backend'],
                (object) ['name' => 'JavaScript', 'icon' => 'javascript', 'percentage' => 85, 'category' => 'Frontend'],
                (object) ['name' => 'TailwindCSS', 'icon' => 'tailwindcss', 'percentage' => 90, 'category' => 'Frontend'],
                (object) ['name' => 'Docker', 'icon' => 'docker', 'percentage' => 80, 'category' => 'Tools'],
                (object) ['name' => 'Git', 'icon' => 'git', 'percentage' => 90, 'category' => 'Tools'],
                (object) ['name' => 'REST API', 'icon' => 'api', 'percentage' => 95, 'category' => 'Backend'],
                (object) ['name' => 'Excel Automation', 'icon' => 'excel', 'percentage' => 90, 'category' => 'Automation'],
                (object) ['name' => 'Data Processing', 'icon' => 'processing', 'percentage' => 95, 'category' => 'Automation'],
            ]);
        }

        $projects = Project::where('is_active', true)->orderBy('display_order')->get();
        if ($projects->isEmpty()) {
            $projects = collect([
                (object) [
                    'title' => 'SIPAT',
                    'slug' => 'sipat',
                    'short_description' => 'Sistem Informasi Monitoring Pengsertifikatan Tanah Pemerintah Daerah untuk mendukung pengamanan aset daerah.',
                    'full_description' => 'SIPAT (Sistem Informasi Pengsertifikatan Aset Tanah) adalah platform enterprise yang dirancang khusus untuk memfasilitasi instansi pemerintah daerah dalam memetakan, melacak, dan mengelola proses sertifikasi aset tanah milik negara.',
                    'tech_tags' => 'Laravel,MySQL,TailwindCSS,LeafletJS,PDF-Generator',
                    'image' => null,
                    'github_link' => 'https://github.com/arifhyde/sipat',
                    'live_link' => null,
                    'is_featured' => true,
                ],
                (object) [
                    'title' => 'E-RANDIS',
                    'slug' => 'e-randis',
                    'short_description' => 'Sistem manajemen kendaraan dinas untuk pengelolaan data, monitoring aset, dan administrasi kendaraan pemerintah.',
                    'full_description' => 'E-RANDIS adalah solusi manajemen armada dan inventarisasi kendaraan dinas operasional pemerintah daerah.',
                    'tech_tags' => 'Laravel,AlpineJS,MySQL,TailwindCSS,ChartJS',
                    'image' => null,
                    'github_link' => 'https://github.com/arifhyde/e-randis',
                    'live_link' => null,
                    'is_featured' => true,
                ],
                (object) [
                    'title' => 'Data Processing Automation Tool',
                    'slug' => 'excel-automation',
                    'short_description' => 'Aplikasi olah data berbasis upload Excel untuk VLOOKUP otomatis, validasi data, dan generate laporan.',
                    'full_description' => 'Sebuah tools otomatisasi berbasis web yang memproses file Excel berukuran besar secara asinkron.',
                    'tech_tags' => 'Laravel,Excel-Automation,SQLite,TailwindCSS,Queue-Worker',
                    'image' => null,
                    'github_link' => 'https://github.com/arifhyde/excel-automation',
                    'live_link' => null,
                    'is_featured' => true,
                ]
            ]);
        }

        $timelines = Timeline::where('is_active', true)->orderBy('display_order')->get();
        if ($timelines->isEmpty()) {
            $timelines = collect([
                (object) ['year' => '2021', 'title' => 'Started learning web development', 'description' => 'Memulai langkah awal dengan mempelajari HTML, CSS, JavaScript, dan dasar-dasar pemrograman PHP.'],
                (object) ['year' => '2022', 'title' => 'Built Laravel-based CRUD systems', 'description' => 'Mengembangkan berbagai aplikasi web sederhana dengan PHP native kemudian beralih ke Laravel.'],
                (object) ['year' => '2023', 'title' => 'Developed government asset management tools', 'description' => 'Mulai merancang dan mengimplementasikan sistem berskala enterprise untuk pemerintah daerah seperti SIPAT dan E-RANDIS.'],
                (object) ['year' => '2024', 'title' => 'Improved system architecture and reusable components', 'description' => 'Memperdalam keahlian dalam REST API, Queue Processing, dan otomatisasi data menggunakan Excel parsers.'],
                (object) ['year' => '2026', 'title' => 'Focused on scalable and maintainable applications', 'description' => 'Mengembangkan website portofolio premium ini sebagai perwujudan keahlian full-stack modern dengan CMS internal.'],
            ]);
        }

        $testimonials = Testimonial::where('is_active', true)->get();
        if ($testimonials->isEmpty()) {
            $testimonials = collect([
                (object) [
                    'client_name' => 'Budi Santoso',
                    'position' => 'Kepala Bidang Aset BPKAD',
                    'message' => 'Sistem SIPAT yang dikembangkan oleh Arif benar-benar mempermudah pelacakan aset tanah daerah kami. Proses pengsertifikatan kini terpantau secara transparan dan aman.',
                    'client_photo' => null,
                ]
            ]);
        }

        $seo = SeoSetting::first() ?? (object) [
            'meta_title' => 'Arif Hyde | Full-Stack Developer & Automation Specialist',
            'meta_description' => 'Portofolio profesional Arif Hyde - Full-stack developer berfokus pada Laravel, database, otomatisasi data, dan sistem manajemen aset pemerintah.',
            'keywords' => 'Arif Hyde, Full-stack Developer, Laravel, PHP, MySQL, Sistem Informasi Aset, Otomatisasi Excel, Web Developer Indonesia',
            'og_title' => 'Arif Hyde | Full-Stack Developer Portofolio',
            'og_description' => 'Pelajari proyek-proyek inovatif dan sistem manajemen aset terotomatisasi yang dikembangkan oleh Arif Hyde.',
            'og_image' => null,
            'favicon' => null,
        ];

        $appearance = AppearanceSetting::first() ?? (object) [
            'hero_headline' => 'Building Digital Solutions That Solve Real Problems',
            'hero_subtitle' => 'Full-stack developer focused on building scalable systems, automation tools, and modern web applications.',
            'primary_color' => '#3B82F6',
            'secondary_color' => '#8B5CF6',
            'bg_style' => 'dark',
            'cta_text' => 'Contact Me',
            'cta_link' => '#contact',
        ];

        return view('home', compact('profile', 'skills', 'projects', 'timelines', 'testimonials', 'seo', 'appearance'));
    }

    public function storeMessage(Request $request)
    {
        // Anti-spam Rate Limiting: 3 message submissions per IP per hour
        $ipKey = 'contact-msg|' . $request->ip();
        if (RateLimiter::tooManyAttempts($ipKey, 3)) {
            $seconds = RateLimiter::availableIn($ipKey);
            $minutes = ceil($seconds / 60);
            return response()->json([
                'success' => false,
                'message' => "Terlalu banyak mengirim pesan. Silakan coba lagi dalam {$minutes} menit."
            ], 429);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::create($validated);

        RateLimiter::hit($ipKey, 3600); // lock for 1 hour

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan Anda telah berhasil dikirim! Terima kasih atas kerjasamanya.'
            ]);
        }

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim! Terima kasih atas kerjasamanya.');
    }

    public function aiChat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = $request->input('message');

        // Check if an AI API Key is configured in config
        $openaiKey = config('ai.providers.openai.key');
        $geminiKey = config('ai.providers.gemini.key');

        if (!empty($openaiKey) || !empty($geminiKey)) {
            try {
                // Using the native Laravel 13 AI SDK!
                $response = \App\Ai\Agents\PortfolioAgent::make()->prompt($message);
                return response()->json([
                    'success' => true,
                    'reply' => (string) $response,
                ]);
            } catch (\Exception $e) {
                // Fallback in case of API errors
                return response()->json([
                    'success' => true,
                    'reply' => "Maaf, terjadi gangguan saat menghubungi penyedia layanan AI. Ini respon simulasi: Saya adalah AI Assistant Arif Hyde. Arif adalah Full-Stack Developer spesialis Laravel dan MySQL. Anda bisa menghubungi Arif di contact@arifhyde.com.",
                ]);
            }
        }

        // Mock/Simulated Intelligent AI Response if no API key is provided yet
        $reply = $this->simulateAiResponse($message);

        return response()->json([
            'success' => true,
            'reply' => $reply,
        ]);
    }

    private function simulateAiResponse($message)
    {
        $message = strtolower($message);
        
        $profile = Profile::first();
        $name = $profile->name ?? 'Arif Hyde';
        $whatsapp = $profile->whatsapp ?? '628123456789';
        $email = $profile->email ?? 'contact@arifhyde.com';

        if (str_contains($message, 'siapa') || str_contains($message, 'profil') || str_contains($message, 'biodata')) {
            return "Halo! Saya adalah AI Assistant **{$name}**. Arif adalah seorang Full-Stack Developer spesialis PHP/Laravel, MySQL, dan Otomatisasi Olah Data (Excel). Dia sangat berpengalaman dalam membangun sistem manajemen aset pemerintah daerah (seperti SIPAT dan E-RANDIS) serta memproses ribuan data secara asinkron.";
        }

        if (str_contains($message, 'proyek') || str_contains($message, 'project') || str_contains($message, 'portofolio') || str_contains($message, 'sipat') || str_contains($message, 'randis')) {
            return "Arif Hyde telah membangun beberapa proyek unggulan berskala enterprise:
1. **SIPAT**: Sistem Monitoring Pengsertifikatan Tanah Pemerintah Daerah untuk pelacakan legalitas aset.
2. **E-RANDIS**: Sistem inventarisasi dan administrasi kendaraan dinas pemerintah.
3. **Excel Data Processing Tool**: Aplikasi web untuk validasi data besar secara asinkron menggunakan Queue Worker.

Ingin tahu lebih banyak tentang salah satu proyek ini?";
        }

        if (str_contains($message, 'skill') || str_contains($message, 'keahlian') || str_contains($message, 'bahasa') || str_contains($message, 'teknologi')) {
            return "Teknologi utama yang dikuasai oleh Arif meliputi:
- **Backend**: Laravel, PHP, MySQL, REST API, SQLite, PostgreSQL
- **Frontend**: JavaScript, TailwindCSS, Alpine.js, HTML5/CSS3
- **Automation/Tools**: Excel Parsing/Automation, Docker, Git versioning

Arif selalu menerapkan *Clean Architecture* dan *Optimized Database Indexing* dalam setiap proyeknya.";
        }

        if (str_contains($message, 'kontak') || str_contains($message, 'hubungi') || str_contains($message, 'email') || str_contains($message, 'whatsapp') || str_contains($message, 'no hp')) {
            return "Anda bisa menghubungi Arif Hyde secara langsung melalui:
- ✉️ **Email**: {$email}
- 💬 **WhatsApp**: [Chat Sekarang](https://wa.me/{$whatsapp})
- 🐙 **GitHub**: https://github.com/arifhyde

Silakan gunakan formulir kontak di bawah halaman ini untuk mengirim pesan langsung ke inbox admin!";
        }

        return "Halo! Terima kasih telah berkunjung. Saya adalah AI Assistant bawaan **Laravel 13 AI SDK** kustom untuk portofolio Arif Hyde. 

Saya dapat menceritakan tentang *keahlian (skills)*, *proyek unggulan (projects)*, atau *informasi kontak* Arif Hyde. Apa yang ingin Anda ketahui?";
    }
}
