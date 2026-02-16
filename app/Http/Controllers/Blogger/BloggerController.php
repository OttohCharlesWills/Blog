<?php

namespace App\Http\Controllers\Blogger;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\activity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BloggerController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('user_id', auth()->id())
                     ->latest()
                     ->get();

        return view('bloggers.blogs.index', compact('blogs'));
    }

    public function pending()
    {
        $pendingBlogs = Blog::where('user_id', auth()->id())
                            ->where('status', 'pending')
                            ->latest()
                            ->get();

        return view('bloggers.blogs.pending', compact('pendingBlogs'));
    }

    public function create()
    {
        return view('bloggers.blogs.create');
    }

    // public function store(Request $request)
    // {
    //         $request->validate([
    //         'title' => 'required|string|max:255',
    //         'content' => 'required',
    //         'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    //     ]);

    //     $coverPath = null;

    //     if ($request->hasFile('cover_image')) {
    //         $uploadedFileUrl = Cloudinary::upload($request->file('cover_image')->getRealPath(), [
    //             'folder' => 'blog_covers',
    //             'overwrite' => true,
    //             'resource_type' => 'image'
    //         ])->getSecurePath();

    //         $coverPath = $uploadedFileUrl; // this is the full Cloudinary URL
    //     }

    //     $blog = Blog::create([
    //         'user_id' => auth()->id(),
    //         'title' => $request->title,
    //         'slug' => Str::slug($request->title) . '-' . uniqid(),
    //         'content' => $request->content,
    //         'cover_image' => $coverPath,
    //         'status' => 'pending',
    //     ]);

    //     // 🔥 ACTIVITY LOG
    //     Activity::log(
    //         'Blog Submitted',
    //         auth()->user()->name . ' submitted a blog titled "' . $blog->title . '"'
    //     );

    //     return redirect()
    //         ->route('blogger.bloggers.index')
    //         ->with('success', 'Blog submitted for approval ✅');
    // }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'sub_title' => 'required|string|max:255', // don't forget this now
        'content' => 'required',
        'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $coverPath = null;

    if ($request->hasFile('cover_image')) {
        $coverPath = Cloudinary::upload($request->file('cover_image')->getRealPath(), [
            'folder' => 'blog_covers',
            'overwrite' => true,
            'resource_type' => 'image'
        ])->getSecurePath();
    }

    $blog = Blog::create([
        'user_id' => auth()->id(),
        'title' => $request->title,
        'sub_title' => $request->sub_title, // new column
        'slug' => Str::slug($request->title) . '-' . uniqid(),
        'content' => $request->content,
        'cover_image' => $coverPath,
        'status' => 'pending',
        'focus' => auth()->user()->focus, // 🔥 auto-fill from user
    ]);

    // 🔥 ACTIVITY LOG
    Activity::log(
        'Blog Submitted',
        auth()->user()->name . ' submitted a blog titled "' . $blog->title . '"'
    );

    return redirect()
        ->route('blogger.bloggers.index')
        ->with('success', 'Blog submitted for approval ✅');
}


    public function edit(Blog $blog)
    {
        abort_if($blog->user_id !== auth()->id(), 403);

        return view('bloggers.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        abort_if($blog->user_id !== auth()->id(), 403);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $blog->update([
            'title'   => $request->title,
            'content' => $request->content,
            'status'  => 'pending',
        ]);

        // 🔥 ACTIVITY LOG
        Activity::log(
            'Blog Updated',
            auth()->user()->name . ' updated the blog "' . $blog->title . '"'
        );

        return redirect()
            ->route('bloggers.index')
            ->with('success', 'Blog updated and sent for review ✨');
    }

    public function destroy(Blog $blog)
    {
        abort_if($blog->user_id !== auth()->id(), 403);

        // 🔥 ACTIVITY LOG (log BEFORE delete)
        Activity::log(
            'Blog Deleted',
            auth()->user()->name . ' deleted the blog "' . $blog->title . '"'
        );

        $blog->delete();

        return back()->with('success', 'Blog deleted 🗑️');
    }
}
