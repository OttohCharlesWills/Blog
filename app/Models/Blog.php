<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'cover_image',
        'status',
        'published_at',
    ];

    protected $casts = [
        'content' => 'array',        // auto JSON decode
        'published_at' => 'datetime',
    ];

    /**
     * Auto-generate slug
     */
    protected static function booted()
    {
        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }

    /**
     * Blog owner
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
