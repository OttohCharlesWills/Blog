<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;

class AdminBlogController extends Controller
{

public function pending()
{
    $blogs = Blog::where('status', 'pending')
        ->with('user')
        ->latest()
        ->get();

    return view('admin.blogs.pending', compact('blogs'));
}

public function approve(Blog $blog)
{
    $blog->update(['status' => 'published']);

    Activity::log(
        "Blog approved",
        "Admin approved blog: {$blog->title}"
    );

    return back()->with('success', 'Blog approved');
}

public function revoke(Blog $blog)
{
    $blog->update(['status' => 'revoked']);

    Activity::log(
        "Blog revoked",
        "Admin revoked blog: {$blog->title}"
    );

    return back()->with('success', 'Blog revoked');
}

}

