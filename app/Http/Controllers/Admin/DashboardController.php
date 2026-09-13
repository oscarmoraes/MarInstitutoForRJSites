<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Member;
use App\Models\OfficialDocument;
use App\Models\Post;
use App\Models\PrerogativeClaim;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'events_count' => Event::count(),
            'registrations_count' => EventRegistration::count(),
            'posts_count' => Post::count(),
            'members_count' => Member::count(),
            'claims_count' => PrerogativeClaim::count(),
            'certificates_count' => Certificate::count(),
            'documents_count' => OfficialDocument::count(),
        ];

        $recentRegistrations = EventRegistration::with('event')->latest()->take(10)->get();
        $recentClaims = PrerogativeClaim::latest()->take(5)->get();
        $events = Event::withCount('registrations')->get();

        return view('admin.dashboard', compact('stats', 'recentRegistrations', 'recentClaims', 'events'));
    }
}
