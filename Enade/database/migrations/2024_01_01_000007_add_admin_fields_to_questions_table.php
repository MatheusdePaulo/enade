<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('explanation');
            $table->unsignedInteger('order')->default(0)->after('is_featured');
            $table->unsignedBigInteger('times_answered')->default(0)->after('order');
        });
    }

    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn(['is_featured', 'order', 'times_answered']);
        });
    }
};
