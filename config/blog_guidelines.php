<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Global Sections (shown to everyone)
    |--------------------------------------------------------------------------
    */
    'global' => [
        'introduction' => [
            'title' => 'Welcome',
            'content' => 'Welcome to our blogging community. These guidelines will help you publish high-quality, impactful content.'
        ],

        'mission' => [
            'title' => 'Our Mission',
            'content' => 'We exist to publish insightful, accurate, and meaningful content that educates and empowers readers.'
        ],

        'who_can_publish' => [
            'title' => 'Who Can Publish',
            'content' => 'Subject-matter experts, professionals, and creators with real experience in their chosen focus.'
        ],

        'commitment' => [
            'title' => 'Our Commitment to You',
            'content' => 'Fair reviews, constructive feedback, and long-term visibility for quality work.'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Content Quality Standards
    |--------------------------------------------------------------------------
    */
    'quality_standards' => [
        'encourage' => [
            'Original, well-researched content',
            'Clear structure and headings',
            'Practical, real-world insights',
            'Accurate and verifiable information',
        ],
        'avoid' => [
            'Plagiarism or recycled content',
            'Clickbait or misleading titles',
            'Unverified claims',
            'Low-effort or rushed writing',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Copyright
    |--------------------------------------------------------------------------
    */
    'copyright' => [
        'You must own or properly license all content.',
        'Third-party assets must be credited.',
        'Violations may result in suspension.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Politics (ALWAYS SHOWN)
    |--------------------------------------------------------------------------
    */
    'politics' => [
        'Balanced and neutral tone required',
        'Claims must be supported by credible sources',
        'No hate speech or incitement',
        'No propaganda or deliberate misinformation',
    ],

    /*
    |--------------------------------------------------------------------------
    | Focus-Specific Guidelines
    |--------------------------------------------------------------------------
    */
    'focus' => [

        'tech' => [
            'Use accurate technical terminology',
            'Avoid spreading unverified tech rumors',
            'Explain concepts clearly for non-experts',
        ],

        'finance' => [
            'No financial guarantees or promises',
            'Disclose risks clearly',
            'Avoid misleading investment advice',
        ],

        'health' => [
            'No medical claims without sources',
            'Avoid diagnosing readers',
            'Always recommend professional consultation',
        ],

        'public-policy' => [
            'Maintain objectivity',
            'Differentiate facts from opinions',
            'Use primary sources where possible',
        ],

        'sports' => [
            'Use verified statistics',
            'No defamatory claims about athletes',
        ],

        // fallback handled in code
    ],

    /*
    |--------------------------------------------------------------------------
    | FAQs
    |--------------------------------------------------------------------------
    */
    'faqs' => [
        [
            'q' => 'Who can publish blogs?',
            'a' => 'Only approved bloggers with a selected focus.',
        ],
        [
            'q' => 'Can I edit after submission?',
            'a' => 'Yes, before approval.',
        ],
        [
            'q' => 'How long does approval take?',
            'a' => '24–72 hours on average.',
        ],
    ],
];
