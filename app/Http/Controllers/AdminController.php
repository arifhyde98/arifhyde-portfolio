<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\ContactMessage;
use App\Models\Timeline;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'projects_count' => Project::count(),
            'skills_count' => Skill::count(),
            'messages_count' => ContactMessage::count(),
            'messages_unread_count' => ContactMessage::where('is_read', false)->count(),
            'timelines_count' => Timeline::count(),
            'testimonials_count' => Testimonial::count(),
        ];

        $recentMessages = ContactMessage::orderBy('created_at', 'desc')->take(5)->get();
        $recentProjects = Project::orderBy('created_at', 'desc')->take(3)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentProjects'));
    }
}
