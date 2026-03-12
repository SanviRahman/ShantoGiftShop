<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('risk_score')->default(0)->after('order_status');
            $table->string('risk_level')->default('low')->after('risk_score');
            $table->boolean('is_suspicious')->default(false)->after('risk_level');
            $table->text('verification_notes')->nullable()->after('is_suspicious');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['risk_score', 'risk_level', 'is_suspicious', 'verification_notes']);
        });
    }
};
