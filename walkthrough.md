# Walkthrough - Pembangunan Web Portofolio Arif Hyde

Sistem aplikasi web portofolio full-stack **Arif Hyde** telah berhasil dibangun menggunakan **Laravel 13**, **Tailwind CSS v4**, dan **Alpine.js**. Seluruh aset dikompilasi secara lokal via **Vite** tanpa ketergantungan pada CDN eksternal.

Aplikasi ini terdiri dari tiga bagian utama:
1.  **Landing Page** premium modern bergaya SaaS (bento grid, glassmorphic, dark theme).
2.  **Interactive AI Chatbot Widget**: Asisten virtual bawaan yang ditenagai oleh **Laravel 13 AI SDK** kustom untuk menjawab pertanyaan seputar Arif Hyde.
3.  **Admin Control Center (CMS)** berfitur lengkap untuk memperbarui seluruh konten secara dinamis.

---

## 🌟 Fitur Utama & Keunggulan

### A. Public Landing Page (Premium SaaS Style)
-   **Desain Modern & Gelap**: Tema gelap (#09090B), tipografi Outfit elegan, dan gradien biru-ungu yang halus.
-   **Bento Grid Layout**: Grid modern yang responsif untuk menyajikan data secara terstruktur dan estetik.
-   **Glassmorphic Cards**: Card dengan efek blur latar belakang halus dan border tipis transparan.
-   **Detail Proyek Interaktif (Modal)**: Menampilkan detail lengkap proyek dalam modal overlay interaktif (tanpa perlu reload halaman).
-   **Formulir Kontak AJAX**: Pengiriman pesan langsung ke database menggunakan Fetch API/AJAX yang aman dengan rate-limiting anti-spam.

### B. Interactive AI Chatbot Widget (Laravel 13 Native AI Integration)
-   **Pulsing Green Badge**: Status "Online" berkedip dinamis penanda asisten AI aktif.
-   **Floating Premium Panel**: Tampilan melayang modern dengan efek glassmorphism tebal dan background blur.
-   **Pemberdayaan Laravel 13 AI SDK**: Terintegrasi langsung dengan model `App\Ai\Agents\PortfolioAgent` bawaan framework untuk memproses prompt.
-   **System Prompt Dinamis**: AI dilatih secara dinamis menggunakan data aktual profil, keahlian, dan proyek dari database SQLite.
-   **Preset Pertanyaan Cepat**: Akses instan pengunjung untuk menanyakan info dasar (*"Who is Arif?"*, *"Projects"*, *"Contact"*).
-   **Indikator Mengetik (Typing Dots)**: Animasi loading saat AI memproses respons.
-   **Mesin Simulasi Cerdas (Zero-Config Fallback)**: Jika Anda belum memiliki API key di berkas `.env`, chatbot tetap berfungsi 100% menggunakan parser cerdas lokal sebagai simulasi. Begitu API key dimasukkan, sistem beralih ke kecerdasan buatan asli secara instan!

### C. Admin Panel & CMS (Control Center)
-   **Autentikasi Aman**: Halaman login admin dengan perlindungan Rate Limiting ketat (maksimal 5 percobaan per menit per IP).
-   **Dashboard Ringkasan**: Statistik jumlah proyek, pesan masuk, serta daftar pesan terbaru yang masuk.
-   **Modul CRUD Portofolio**:
    -   **Profile**: Mengelola data diri, kontak, media sosial, foto profil, dan unggah CV (PDF).
    -   **Skills**: Mengelola data keahlian beserta progress bar persentase dan urutan tampil.
    -   **Projects**: Mengelola portofolio proyek lengkap dengan auto-slug generator, deskripsi, tautan kode/demo, dan unggah gambar.
    -   **Timeline**: Mengelola perjalanan karir/milestone.
    -   **Testimonials**: Mengelola ulasan & feedback dari klien.
    -   **Contact Inbox**: Membaca, menandai (read/unread), dan menghapus pesan masuk dari pengunjung.
    -   **SEO Settings**: Mengelola meta tags lengkap (title, description, keywords, og:image, favicon) untuk SEO dinamis.
    -   **Appearance Settings**: Mengubah warna primer & sekunder landing page dengan Color Picker dinamis, serta teks headline utama secara langsung.
    -   **Media Manager**: Mengunggah gambar, menyalin URL path aset, dan menghapus berkas media secara praktis.

### D. Zero-CDN Vite Asset Pipeline
-   **Bundling Mandiri**: Seluruh kode CSS (Tailwind CSS v4) dan JS (Alpine.js) dibundel secara lokal menggunakan Vite, menghilangkan kebutuhan memuat script dari server CDN pihak ketiga.
-   **Warna Dinamis & CSS Variables**: Skema warna tetap dapat dikonfigurasi melalui CMS karena memanfaatkan CSS custom properties (`var(--primary)` dan `var(--secondary)`) pada runtime.

---

## 🛠️ Detail Struktur Berkas Utama

### 1. Database & Migrations
-   `database/migrations/..._create_profiles_table.php`
-   `database/migrations/..._create_skills_table.php`
-   `database/migrations/..._create_projects_table.php`
-   `database/migrations/..._create_timelines_table.php`
-   `database/migrations/..._create_testimonials_table.php`
-   `database/migrations/..._create_contact_messages_table.php`
-   `database/migrations/..._create_seo_settings_table.php`
-   `database/migrations/..._create_appearance_settings_table.php`
-   `database/migrations/..._create_media_table.php`
-   `database/migrations/2026_05_23_015154_create_agent_conversations_table.php` (Penyimpan chat history bawaan AI SDK)
-   `database/seeders/DatabaseSeeder.php` (Pengisi data portofolio awal & kredensial admin default)

### 2. Backend Models, Controllers & AI Agents
-   **Models**: `Profile`, `Skill`, `Project`, `Timeline`, `Testimonial`, `ContactMessage`, `SeoSetting`, `AppearanceSetting`, `Media`.
-   **AI Agent**:
    -   `PortfolioAgent.php` (Sistem Prompt dynamic training model AI bawaan Laravel 13)
-   **Controllers**:
    -   `HomeController.php` (Landing page render, rate-limited AJAX messages, & AI chat request handlers)
    -   `AuthController.php` (Autentikasi admin)
    -   `AdminController.php` (Dashboard metrik)
    -   `ProfileController.php`, `SkillController.php`, `ProjectController.php`, `TimelineController.php`, `TestimonialController.php`, `MessageController.php`, `SettingController.php`, `MediaController.php`

### 3. Frontend Assets & Layouts
-   `resources/js/app.js` (Inisialisasi Alpine.js lokal)
-   `resources/css/app.css` (Tailwind CSS v4 imports & custom @theme)
-   `resources/views/layouts/public.blade.php` (Layout utama landing page)
-   `resources/views/home.blade.php` (Bento layout landing page & Chatbot Widget HTML/AlpineJS)
-   `resources/views/admin/layout.blade.php` (Layout panel admin)
-   `resources/views/admin/auth/login.blade.php` (Layout login admin)

---

## 🚀 Kredensial Default & Cara Menjalankan

### A. Kredensial Admin Default
Untuk mengakses Admin Control Center, silakan masuk ke tautan berikut:
-   **Halaman Login**: `http://localhost:8000/login`
-   **Email**: `admin@arifhyde.com`
-   **Password**: `password`

*(Anda dapat langsung memperbarui nama, email, password, dan info kontak dari halaman **Profile Management**).*

### B. Kompilasi Aset via Docker Node 20
Karena lingkungan lokal menggunakan Node v18 sedangkan Vite 8 membutuhkan Node v20+, kompilasi aset dilakukan di dalam container Docker yang terisolasi dengan perintah:
```bash
docker run --rm -v /home/arif/webku:/app -w /app node:20-alpine sh -c "npm install && npm run build"
```
Langkah ini secara otomatis menyelesaikan isu arsitektur binding rolldown dan menstabilkan bundling CSS & JS.

### C. Cara Menjalankan secara Lokal
1.  **Jalankan Server Laravel**:
    ```bash
    php artisan serve
    ```
2.  **Akses Landing Page & AI Chat**:
    Buka `http://localhost:8000` di peramban Anda dan klik widget asisten AI di pojok kanan bawah.
3.  **Hubungkan AI API Key di `.env` (Pilihan)**:
    Masukkan key Anda ke `.env` untuk mengganti mode simulasi ke real AI:
    `GEMINI_API_KEY="kunci-gemini-anda"` atau `OPENAI_API_KEY="kunci-openai-anda"`.
4.  **Akses Admin Panel**:
    Buka `http://localhost:8000/login` dan gunakan kredensial admin default di atas.
