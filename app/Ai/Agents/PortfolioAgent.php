<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

class PortfolioAgent implements Agent, Conversational, HasTools
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        $profile = \App\Models\Profile::first();
        
        $skills = \App\Models\Skill::where('is_active', true)->get()->map(function($s) {
            return "- {$s->name} ({$s->category})";
        })->implode("\n");
        
        $projects = \App\Models\Project::where('is_active', true)->get()->map(function($p) {
            return "- {$p->title}: {$p->short_description}";
        })->implode("\n");

        $name = $profile->name ?? 'Arif Hyde';
        $title = $profile->title ?? 'Full-Stack Developer';
        $bio = $profile->short_bio ?? '';
        $desc = $profile->about_description ?? '';
        $email = $profile->email ?? 'contact@arifhyde.com';
        $whatsapp = $profile->whatsapp ?? '';
        $github = $profile->github ?? '';
        $linkedin = $profile->linkedin ?? '';

        return "Anda adalah Asisten AI Virtual untuk portofolio profesional {$name}, seorang {$title}.
        Tugas Anda adalah menjawab pertanyaan pengunjung website dengan ramah, profesional, dan ringkas dalam Bahasa Indonesia.

        Berikut adalah data aktual tentang {$name}:
        Nama: {$name}
        Gelar/Spesialisasi: {$title}
        Bio Ringkas: {$bio}
        Deskripsi: {$desc}

        Keahlian & Perkakas Kerja (Skills):
        {$skills}

        Daftar Proyek Unggulan (Projects):
        {$projects}

        Kontak Resmi:
        Email: {$email}
        WhatsApp: +{$whatsapp}
        GitHub: {$github}
        LinkedIn: {$linkedin}

        Aturan:
        1. Jawab hanya berdasarkan informasi di atas. Jika Anda tidak mengetahui jawabannya, katakan secara jujur dan arahkan pengunjung untuk menghubungi Arif melalui kontak di atas.
        2. Gunakan gaya bahasa yang ramah, sopan, dan profesional.";
    }

    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }
}
