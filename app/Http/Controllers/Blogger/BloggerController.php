<?php

namespace App\Http\Controllers\Blogger;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BloggerController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('user_id', auth()->id())
                     ->latest()
                     ->get();

        return view('bloggers.index', compact('blogs'));
    }

    public function create()
    {
        return view('bloggers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $coverPath = null;

        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')
                ->store('blog_covers', 'public');
        }

        $blog = Blog::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'content' => $request->content,
            'cover_image' => $coverPath,
            'status' => 'pending',
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

        return view('bloggers.edit', compact('blog'));
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
