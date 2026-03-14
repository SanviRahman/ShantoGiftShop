<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->unique()->after('email');
            $table->string('auth_provider')->nullable()->after('google_id');
            $table->text('temp_password')->nullable()->after('auth_provider');
            $table->timestamp('temp_password_created_at')->nullable()->after('temp_password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['google_id']);
            $table->dropColumn(['google_id', 'auth_provider', 'temp_password', 'temp_password_created_at']);
        });
    }
};
