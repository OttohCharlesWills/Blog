<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use App\Models\activity;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalBlogs' => Blog::count(),
            'pendingBlogs' => Blog::where('status', 'pending')->count(),
            'publishedBlogs' => Blog::where('status', 'published')->count(),
        ]);
    }

    

    public function latestActivities()
    {
        $activities = Activity::latest()->take(10)->get();

        // return as JSON for JS to consume
        return response()->json($activities);
    }


}
