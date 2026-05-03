<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            // Basic article info
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');

            // Relationships
            $table->foreignId('author_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Category/Section
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            // Optional editor approval
            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Workflow statuses
            $table->enum('status', [
                'draft',
                'submitted',
                'under_review',
                'needs_revision',
                'approved',
                'scheduled',
                'published',
                'archived'
            ])->default('draft');

            // Media
            $table->string('featured_image')->nullable();
            $table->string('video_url')->nullable();

            // Homepage features
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_breaking')->default(false);

            // Tracking
            $table->integer('views')->default(0);

            // Publishing
            $table->timestamp('published_at')->nullable();
            $table->timestamp('scheduled_at')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};