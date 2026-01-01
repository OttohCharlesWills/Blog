<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['title', 'description'];

    public static function log($title, $description)
    {
        self::create(compact('title', 'description'));
    }
}

