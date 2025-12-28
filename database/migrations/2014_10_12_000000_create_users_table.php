<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // 🔑 ROLE (locked)
            $table->enum('role', ['admin', 'blogger'])->default('blogger');

            // 🧠 BLOG INTEREST (filled after login)
            $table->string('focus')->nullable();

            // 🧾 PROFILE INFO (onboarding)
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();

            // 🚦 ACCOUNT CONTROL
            $table->boolean('is_active')->default(true);

            // 🎯 ONBOARDING CHECK
            $table->boolean('onboarding_completed')->default(false);

            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
