<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogsController extends Controller
{
    
    public function blogsforwelcome()
    {
        $featuredBlogs = Blog::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(9)
            ->get();

        $categories = Blog::select('focus')
            ->where('status', 'published')
            ->groupBy('focus')
            ->get()
            ->map(function($item) {
                $name = ucfirst($item->focus ?? 'General');

                $latest_blog = Blog::where('focus', $item->focus)
                    ->where('status', 'published')
                    ->orderByDesc('published_at')
                    ->first();

                return (object)[
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'icon' => $this->iconForFocus($item->focus), // method below
                    'blogs_count' => Blog::where('focus', $item->focus)->count(),
                    'latest_blog' => $latest_blog,
                    'preview_text' => null, // optional
                ];
            });

        $trendingBlogs = Blog::where('status', 'published')
        ->where('created_at', '>=', Carbon::now()->subDays(7))
        ->orderByDesc('views_count')
        ->take(6)
        ->get();

        $editorsPicks = Blog::where('is_featured', true)
        ->where('status', 'published')
        ->latest()
        ->take(4)
        ->get();

        return view('welcome', compact('featuredBlogs', 'categories', 'trendingBlogs', 'editorsPicks'));
    }

    // helper for mapping focus to FA icon
    private function iconForFocus($focus)
        {
            return match(Str::lower($focus)) {
            // Core / Professional
            'tech' => 'fa-solid fa-microchip',
            'design' => 'fa-solid fa-palette',
            'writing' => 'fa-solid fa-pen-nib',
            'marketing' => 'fa-solid fa-bullhorn',
            'business' => 'fa-solid fa-briefcase',

            // Serious / Gated
            'public-policy' => 'fa-solid fa-gavel',
            'civic-issues' => 'fa-solid fa-landmark',
            'political-analysis' => 'fa-solid fa-chart-line',

            // Lifestyle / Money
            'luxury' => 'fa-solid fa-gem',
            'finance' => 'fa-solid fa-dollar-sign',
            'sports' => 'fa-solid fa-football',
            'entrepreneurship' => 'fa-solid fa-lightbulb',
            'real-estate' => 'fa-solid fa-building',
            'investing' => 'fa-solid fa-coins',

            // Creative
            'fashion' => 'fa-solid fa-tshirt',
            'beauty' => 'fa-solid fa-face-smile',
            'art' => 'fa-solid fa-paintbrush',
            'photography' => 'fa-solid fa-camera',
            'music' => 'fa-solid fa-music',

            // Digital / Online
            'content-creation' => 'fa-solid fa-file-lines',
            'social-media' => 'fa-brands fa-twitter', // or fa-facebook, whatever you vibe with
            'branding' => 'fa-solid fa-badge-check',
            'copywriting' => 'fa-solid fa-pen',
            'seo' => 'fa-solid fa-magnifying-glass',

            // Living
            'travel' => 'fa-solid fa-location-dot',
            'fitness' => 'fa-solid fa-dumbbell',
            'health' => 'fa-solid fa-heart-pulse',
            'food' => 'fa-solid fa-utensils',
            'relationships' => 'fa-solid fa-heart',

            // Culture
            'education' => 'fa-solid fa-book-open',
            'career' => 'fa-solid fa-briefcase',
            'productivity' => 'fa-solid fa-clock',
            'self-improvement' => 'fa-solid fa-rocket',
            'culture' => 'fa-solid fa-globe',
            
            default => 'fa-solid fa-circle',
        };

    }
}