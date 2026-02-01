<?php

namespace App\Http\Controllers\Blogger;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BloggerGuidelinesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $focus = $user->focus ?? 'tech'; // fallback

        $config = config('blog_guidelines');

        // Global sections
        $global = $config['global'] ?? [];

        // Content Quality Standards
        $baseRules = $config['quality_standards'] ?? [];

        // Focus-specific rules
        $focusRules = $config['focus'][$focus] ?? [];

        // Politics ALWAYS included
        $politicsRules = $config['politics'] ?? [];

        // Copyright
        $copyright = $config['copyright'] ?? [];

        // Make sure to pass $global to the view!
        return view('bloggers.guidelines.guidelines', compact(
            'focus',
            'baseRules',
            'focusRules',
            'politicsRules',
            'copyright',
            'global'
        ));
    }
}


