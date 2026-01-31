<?php

namespace App\Http\Controllers\Blogger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BloggerDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        return view('home', [
            'totalBlogs' => Blog::where('user_id', $userId)->count(),
            'pendingBlogs' => Blog::where('user_id', $userId)
                                  ->where('status', 'pending')
                                  ->count(),
            'publishedBlogs' => Blog::where('user_id', $userId)
                                    ->where('status', 'published')
                                    ->count(),
        ]);
    }

    public function dashboard()
    {
        $user = Auth::user();

        // Top stats
        $totalBlogs = Blog::where('user_id', $user->id)->count();
        $pendingBlogs = Blog::where('user_id', $user->id)->where('status', 'pending')->count();
        $publishedBlogs = Blog::where('user_id', $user->id)->where('status', 'published')->count();
        $draftBlogs = Blog::where('user_id', $user->id)->where('status', 'draft')->count();

        // For now, set these to 0 if you don't have views/comments table
        $totalViews = 0;
        $totalComments = 0;

        // Recent blogs
        $recentBlogs = Blog::where('user_id', $user->id)
                            ->latest()
                            ->take(5) // last 5
                            ->get();

        // Last 7 days chart
        $last7DaysLabels = [];
        $last7DaysCounts = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $last7DaysLabels[] = now()->subDays($i)->format('D');
            $last7DaysCounts[] = Blog::where('user_id', $user->id)
                                     ->whereDate('created_at', $date)
                                     ->where('status', 'published')
                                     ->count();
        }

        return view('/home', compact(
            'totalBlogs',
            'pendingBlogs',
            'publishedBlogs',
            'draftBlogs',
            'totalViews',
            'totalComments',
            'recentBlogs',
            'last7DaysLabels',
            'last7DaysCounts'
        ));
    }
}
