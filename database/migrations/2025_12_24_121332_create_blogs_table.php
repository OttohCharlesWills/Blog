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
            $table->text('excerpt')->nullable(); // short preview
            $table->string('cover_image')->nullable();

            // 🎯 user focus
            $table->string('focus')->nullable();

            // ⏱ reading time (minutes)
            $table->unsignedInteger('time_read')->nullable();

            // 🔍 SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            // 📊 analytics
            $table->unsignedBigInteger('views_count')->default(0);

            // ⭐ features & control
            $table->boolean('is_featured')->default(false);
            $table->boolean('allow_comments')->default(true);

            // 🏷 tags (temporary solution, pivot later if you grow up)
            $table->json('tags')->nullable();

            // 🚦 blog status
            $table->enum('status', ['draft', 'pending', 'published', 'revoked'])
                ->default('draft');

            // 📅 publishing & edits
            $table->timestamp('published_at')->nullable();
            $table->timestamp('last_edited_at')->nullable();

            // 🗑 soft delete (because mistakes happen)
            $table->softDeletes();

            $table->timestamps();
        });



    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

