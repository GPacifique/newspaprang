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
      Schema::create('comments', function (Blueprint $table) {
    $table->id();

    $table->foreignId('article_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->foreignId('parent_id')
        ->nullable()
        ->constrained('comments')
        ->cascadeOnDelete();

    // Guest Information
    $table->string('name');
    $table->string('email')->nullable();

    // Comment
    $table->text('content');

    // Tracking
    $table->ipAddress('ip_address')->nullable();
    $table->text('user_agent')->nullable();

    // Moderation
    $table->boolean('approved')->default(true);
    $table->boolean('is_spam')->default(false);

    // Engagement
    $table->integer('likes')->default(0);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
