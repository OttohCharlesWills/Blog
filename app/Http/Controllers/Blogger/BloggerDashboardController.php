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
}
