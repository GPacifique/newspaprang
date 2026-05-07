<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('username')->unique()->nullable();

            // Authentication
            $table->string('password');
            $table->rememberToken();

            // Profile
            $table->string('profile_image')->nullable();
            $table->text('bio')->nullable();

            // Roles
            $table->enum('role', [
                'admin',
                'editor',
                'journalist',
                'advertiser',
                'subscriber',
                'reader'
            ])->default('reader');

            // Account Status
            $table->enum('status', [
                'active',
                'inactive',
                'suspended'
            ])->default('active');

            // Verification
            $table->timestamp('email_verified_at')->nullable();

            // Optional tracking
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};