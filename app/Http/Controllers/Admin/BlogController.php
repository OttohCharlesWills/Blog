<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Show all blogs created by admin
     */
    public function index()
    {
        $blogs = Blog::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show create blog form
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store blog (ADMIN → publish instantly)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $coverPath = null;

        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('blog-covers', 'public');
        }

        Blog::create([
            'user_id'      => auth()->id(),
            'title'        => $request->title,
            'slug'         => Str::slug($request->title),
            'content'      => $request->content, // JSON from editor
            'cover_image'  => $coverPath,
            'status'       => 'published',
            'published_at' => now(),
        ]);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog published successfully 🔥');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('blogs', 'public');
            $blog->cover_image = $path;
        }

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully 🔥');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return back()->with('success', 'Blog deleted 🗑');
    }

}
