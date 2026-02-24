<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\activity;
use Illuminate\Support\Facades\Mail;

class AdminBlogController extends Controller
{
    // LIST ALL BLOGS
    public function index()
    {
        $blogs = Blog::with('user')->latest()->get();
        return view('admin.blogs.index', compact('blogs'));
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

    public function pending()
{
    $blogs = Blog::where('status', 'pending')
        ->with('user')
        ->latest()
        ->get();

    return view('admin.blogs.pending', compact('blogs'));
}

    // SHOW REVOKE FORM
    public function revokeForm(Blog $blog)
    {
        return view('admin.blogs.revoke', compact('blog'));
    }

    // REVOKE + EMAIL
    public function revokeSend(Request $request, Blog $blog)
    {
        $request->validate([
            'reason' => 'required|min:10'
        ]);

        $blog->update([
            'status' => 'revoked'
        ]);

        Mail::raw(
            "Hello {$blog->user->name},

                Your blog titled \"{$blog->title}\" has been revoked.

                Reason:
                {$request->reason}

                — Admin",
            function ($message) use ($blog) {
                $message->to($blog->user->email)
                        ->subject('Blog Revoked');
            }
        );

        Activity::log(
            'Blog revoked',
            "Admin revoked blog: {$blog->title}"
        );

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog revoked and email sent');
    }

    // 🔁 MOVE BLOG BACK TO PENDING
    public function moveToPending(Blog $blog)
    {
        $blog->update([
            'status' => 'pending'
        ]);

        Activity::log(
            'Blog moved to pending',
            "Admin moved blog back to pending: {$blog->title}"
        );

        return back()->with('success', 'Blog moved back to pending');
    }

    // DELETE BLOG
    public function destroy(Blog $blog)
    {
        $blog->delete();

        Activity::log(
            'Blog deleted',
            "Admin deleted blog: {$blog->title}"
        );

        return back()->with('success', 'Blog deleted');
    }

    // FEATURES

    public function feature(Blog $blog)
    {
        $blog->update([
            'is_featured' => true,
        ]);

        Activity::log(
            'Blog featured',
            "Admin featured blog: {$blog->title}"
        );

        return back()->with('success', 'Blog marked as featured ⭐');
    }

    public function unfeature(Blog $blog)
    {
        $blog->update([
            'is_featured' => false,
        ]);

        Activity::log(
            'Blog unfeatured',
            "Admin removed featured status from: {$blog->title}"
        );

        return back()->with('success', 'Feature removed');
    }

    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }
}
