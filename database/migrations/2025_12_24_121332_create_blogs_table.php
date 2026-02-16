<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();

            // 🔗 ownership
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // 📝 core blog data
            $table->string('title');
            $table->string('sub_title'); 
            $table->string('slug')->unique();
            $table->longText('content'); 
            $table->string('cover_image')->nullable();
            
            // 🎯 user focus (auto-filled from user)
            $table->string('focus')->nullable(); // can be nullable if user hasn't set it yet

            // 🚦 blog control
            $table->enum('status', ['draft', 'pending', 'published', 'revoked'])
                ->default('draft');

            // 📅 publishing
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });


    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

