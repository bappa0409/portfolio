<?php

namespace App\Http\Controllers\Admin;

use App\Services\GitHubService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Visitor;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $totalProjects = Project::count();
        $publishedProjects = Project::where('status', 'published')->count();
        $draftProjects = Project::where('status', 'draft')->count();
        $totalContacts = Contact::count();
        $recentProjects = Project::latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();

        $today = now()->toDateString();

        $totalVisitors = Visitor::distinct('ip')->count('ip');
        $todayVisitors = Visitor::where('visit_date', $today)->distinct('ip')->count('ip');

        $todayVisitorList = Visitor::where('visit_date', $today)
            ->orderByDesc('visits')
            ->get();

        return view('pages.dashboard', compact(
            'totalProjects',
            'publishedProjects',
            'draftProjects',
            'totalContacts',
            'recentProjects',
            'recentContacts',
            'totalVisitors',
            'todayVisitors',
            'todayVisitorList'
        ));
    }

}

