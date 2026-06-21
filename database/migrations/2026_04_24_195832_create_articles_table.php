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
        Schema::create('articles', function (Blueprint $table) {

            $table->id();

            // Article Information
            $table->string('title');
            $table->string('slug')->unique();

            $table->text('excerpt')->nullable();
            $table->longText('content');

            // Featured Image
            $table->string('featured_image')->nullable();

            // Status
            $table->enum('status', [
                'draft',
                'published',
                'archived'
            ])->default('draft');

            // SEO
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            // News Features
            $table->boolean('is_breaking')->default(false);
            $table->boolean('is_featured')->default(false);

            // Analytics
            $table->unsignedBigInteger('views')->default(0);

            // Relations
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Publishing
            $table->timestamp('published_at')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('status');
            $table->index('slug');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};