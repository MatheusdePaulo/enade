<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simulado_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('total_questions');
            $table->unsignedSmallInteger('correct_answers');
            $table->unsignedInteger('time_spent'); // segundos
            $table->json('question_ids');           // [q1, q2, ...] — ordem original
            $table->json('answers');                // {question_id: alternative_id}
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simulado_histories');
    }
};
