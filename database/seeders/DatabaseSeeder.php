<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Timeline;
use App\Models\Testimonial;
use App\Models\SeoSetting;
use App\Models\AppearanceSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Default Admin User
        User::updateOrCreate(
            ['email' => 'admin@arifhyde.com'],
            [
                'name' => 'Arif Hyde',
                'password' => Hash::make('password'), // default password
            ]
        );

        // 2. Create Default Profile
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Arif Hyde',
                'title' => 'Full-Stack Developer & Automation Specialist',
                'short_bio' => 'Full-stack developer focused on building scalable systems, automation tools, and modern web applications.',
                'about_description' => 'I am a highly motivated and detail-oriented Full-Stack Developer with extensive experience in the PHP/Laravel ecosystem. I specialize in designing robust backend systems, automated data processing engines, and clean, high-performance user interfaces. With a strong foundation in clean architecture and database optimization, I have successfully delivered high-impact government asset management systems (SIPAT, E-RANDIS) and advanced automation tools that save hundreds of operational hours.',
                'profile_photo' => null, // fallback in views
                'resume_url' => null,
                'email' => 'contact@arifhyde.com',
                'whatsapp' => '628123456789', // Example ID country code
                'github' => 'https://github.com/arifhyde',
                'linkedin' => 'https://linkedin.com/in/arifhyde',
            ]
        );

        // 3. Create Default Skills
        $skills = [
            ['name' => 'PHP', 'icon' => 'php', 'percentage' => 95, 'category' => 'Backend', 'display_order' => 1],
            ['name' => 'Laravel', 'icon' => 'laravel', 'percentage' => 95, 'category' => 'Backend', 'display_order' => 2],
            ['name' => 'MySQL', 'icon' => 'mysql', 'percentage' => 90, 'category' => 'Backend', 'display_order' => 3],
            ['name' => 'JavaScript', 'icon' => 'javascript', 'percentage' => 85, 'category' => 'Frontend', 'display_order' => 4],
            ['name' => 'TailwindCSS', 'icon' => 'tailwindcss', 'percentage' => 90, 'category' => 'Frontend', 'display_order' => 5],
            ['name' => 'Docker', 'icon' => 'docker', 'percentage' => 80, 'category' => 'Tools', 'display_order' => 6],
            ['name' => 'Git', 'icon' => 'git', 'percentage' => 90, 'category' => 'Tools', 'display_order' => 7],
            ['name' => 'REST API', 'icon' => 'api', 'percentage' => 95, 'category' => 'Backend', 'display_order' => 8],
            ['name' => 'Excel Automation', 'icon' => 'excel', 'percentage' => 90, 'category' => 'Automation', 'display_order' => 9],
            ['name' => 'Data Processing', 'icon' => 'processing', 'percentage' => 95, 'category' => 'Automation', 'display_order' => 10],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['name' => $skill['name']], $skill);
        }

        // 4. Create Default Projects
        $projects = [
            [
                'title' => 'SIPAT',
                'slug' => 'sipat-monitoring-tanah',
                'short_description' => 'Sistem Informasi Monitoring Pengsertifikatan Tanah Pemerintah Daerah untuk mendukung pengamanan aset daerah.',
                'full_description' => 'SIPAT (Sistem Informasi Pengsertifikatan Aset Tanah) adalah platform enterprise yang dirancang khusus untuk memfasilitasi instansi pemerintah daerah dalam memetakan, melacak, dan mengelola proses sertifikasi aset tanah milik negara. Dibangun dengan framework Laravel, MySQL, dan Tailwind CSS, aplikasi ini menyediakan visualisasi peta spasial terintegrasi, workflow persetujuan berjenjang, penataan dokumen sertifikasi digital, dan modul audit log terperinci untuk mencegah penyalahgunaan data serta mempercepat pengamanan aset daerah secara hukum.',
                'tech_tags' => 'Laravel,MySQL,TailwindCSS,LeafletJS,PDF-Generator',
                'github_link' => 'https://github.com/arifhyde/sipat',
                'live_link' => null,
                'is_featured' => true,
                'display_order' => 1,
            ],
            [
                'title' => 'E-RANDIS',
                'slug' => 'e-randis-manajemen-kendaraan-dinas',
                'short_description' => 'Sistem manajemen kendaraan dinas untuk pengelolaan data, monitoring aset, dan administrasi kendaraan pemerintah.',
                'full_description' => 'E-RANDIS adalah solusi manajemen armada dan inventarisasi kendaraan dinas operasional pemerintah daerah. Sistem ini melacak siklus hidup kendaraan mulai dari pengadaan, mutasi penugasan pegawai, pemeliharaan rutin, jadwal perpanjangan pajak/STNK, hingga konsumsi bahan bakar minyak (BBM). Memanfaatkan dashboard analitik yang komprehensif, E-RANDIS membantu pembuat keputusan mengoptimalkan pengeluaran anggaran transportasi dan mendeteksi anomali penggunaan aset dinas secara real-time.',
                'tech_tags' => 'Laravel,AlpineJS,MySQL,TailwindCSS,ChartJS',
                'github_link' => 'https://github.com/arifhyde/e-randis',
                'live_link' => null,
                'is_featured' => true,
                'display_order' => 2,
            ],
            [
                'title' => 'Data Processing Automation Tool',
                'slug' => 'data-processing-automation-tool',
                'short_description' => 'Aplikasi olah data berbasis upload Excel untuk VLOOKUP otomatis, validasi data, dan generate laporan.',
                'full_description' => 'Sebuah tools otomatisasi berbasis web yang memproses file Excel berukuran besar secara asinkron (Queue processing). Mendukung fitur pencocokan data cerdas (VLOOKUP multi-sheet), validasi format otomatis sesuai regulasi pajak/akuntansi, pembersihan entri duplikat, dan ekspor laporan terformat dengan satu klik. Menggunakan sistem database SQLite memori dan Laravel Queue untuk memastikan performa tinggi tanpa membebani server utama.',
                'tech_tags' => 'Laravel,Excel-Automation,SQLite,TailwindCSS,Queue-Worker',
                'github_link' => 'https://github.com/arifhyde/excel-automation',
                'live_link' => null,
                'is_featured' => true,
                'display_order' => 3,
            ]
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(['title' => $project['title']], $project);
        }

        // 5. Create Default Timelines
        $timelines = [
            [
                'year' => '2021',
                'title' => 'Started learning web development',
                'description' => 'Memulai langkah awal dengan mempelajari HTML, CSS, JavaScript, dan dasar-dasar pemrograman PHP.',
                'display_order' => 1,
            ],
            [
                'year' => '2022',
                'title' => 'Built Laravel-based CRUD systems',
                'description' => 'Mengembangkan berbagai aplikasi web sederhana dengan PHP native kemudian beralih ke Laravel untuk memahami arsitektur MVC, database migrations, dan routing.',
                'display_order' => 2,
            ],
            [
                'year' => '2023',
                'title' => 'Developed government asset management tools',
                'description' => 'Mulai merancang dan mengimplementasikan sistem berskala enterprise untuk pemerintah daerah seperti SIPAT dan E-RANDIS, berfokus pada efisiensi serta keamanan data.',
                'display_order' => 3,
            ],
            [
                'year' => '2024',
                'title' => 'Improved system architecture and reusable components',
                'description' => 'Memperdalam keahlian dalam REST API, Queue Processing, dan otomatisasi data menggunakan Excel parsers, serta menulis kode dengan standar Clean Architecture.',
                'display_order' => 4,
            ],
            [
                'year' => '2026',
                'title' => 'Focused on scalable and maintainable applications',
                'description' => 'Mengembangkan website portofolio premium ini sebagai perwujudan keahlian full-stack modern dengan CMS internal yang intuitif.',
                'display_order' => 5,
            ],
        ];

        foreach ($timelines as $timeline) {
            Timeline::updateOrCreate(['title' => $timeline['title']], $timeline);
        }

        // 6. Create Default Testimonial
        Testimonial::updateOrCreate(
            ['client_name' => 'Budi Santoso'],
            [
                'client_name' => 'Budi Santoso',
                'position' => 'Kepala Bidang Aset BPKAD',
                'message' => 'Sistem SIPAT yang dikembangkan oleh Arif benar-benar mempermudah pelacakan aset tanah daerah kami. Proses pengsertifikatan kini terpantau secara transparan dan aman.',
                'is_active' => true,
            ]
        );

        // 7. Create Default SEO Settings
        SeoSetting::updateOrCreate(
            ['id' => 1],
            [
                'meta_title' => 'Arif Hyde | Full-Stack Developer & Automation Specialist',
                'meta_description' => 'Portofolio profesional Arif Hyde - Full-stack developer berfokus pada Laravel, database, otomatisasi data, dan sistem manajemen aset pemerintah.',
                'keywords' => 'Arif Hyde, Full-stack Developer, Laravel, PHP, MySQL, Sistem Informasi Aset, Otomatisasi Excel, Web Developer Indonesia',
                'og_title' => 'Arif Hyde | Full-Stack Developer Portofolio',
                'og_description' => 'Pelajari proyek-proyek inovatif dan sistem manajemen aset terotomatisasi yang dikembangkan oleh Arif Hyde.',
                'og_image' => null,
                'favicon' => null,
            ]
        );

        // 8. Create Default Appearance Settings
        AppearanceSetting::updateOrCreate(
            ['id' => 1],
            [
                'hero_headline' => 'Building Digital Solutions That Solve Real Problems',
                'hero_subtitle' => 'Full-stack developer focused on building scalable systems, automation tools, and modern web applications.',
                'primary_color' => '#3B82F6',
                'secondary_color' => '#8B5CF6',
                'bg_style' => 'dark',
                'cta_text' => 'Contact Me',
                'cta_link' => '#contact',
            ]
        );
    }
}
