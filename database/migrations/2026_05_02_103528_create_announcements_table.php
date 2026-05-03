<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run migrations
     */
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique()->nullable();

            $table->longText('content');

            $table->string('organization_name')->nullable();

            $table->string('featured_image')->nullable();

            $table->date('expiry_date')->nullable();

            $table->enum('type', [
                'public_notice',
                'job',
                'event',
                'obituary',
                'legal_notice'
            ])->default('public_notice');

            $table->enum('status', [
                'draft',
                'published'
            ])->default('draft');

            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};