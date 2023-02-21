<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 20)->unique();
            $table->string('email', 50)->unique();
            $table->string('bio', 255)->nullable();
            $table->string('media')->nullable();
            $table->string('password');
            $table->timestamps();
        });
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            $table->tinyText('tweets', 250)->nullable();
            $table->string('user_id');
            $table->string('media')->nullable();
            $table->string('tags')->nullable();
            $table->timestamps();
        });
        // Schema::create('tags', function (Blueprint $table) {
        //     $table->id();
        //     $table->tinyText('name', 250);
        //     $table->timestamps();
        // });
        // Schema::create('tag_tweet', function (Blueprint $table) {
        //     $table->id('tag_id');
        //     $table->string('tweet_id');
        // });
        // Schema::create('tag_comment', function (Blueprint $table) {
        //     $table->id('tag_id');
        //     $table->string('comment_id');
        // });
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->tinyText('comment', 250);
            $table->string('media')->nullable();
            $table->string('tags')->nullable();
            $table->string('tweet_id');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('tweets');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tag_tweet');
        Schema::dropIfExists('tag_comment');
        Schema::dropIfExists('comments');
    }
};
