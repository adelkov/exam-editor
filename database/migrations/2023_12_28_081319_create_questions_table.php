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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('text');
            $table->integer('points');
            $table->enum('type', ["multiple-choice","single-choice","true-or-false","per-digit-match","all-answers-are-good","exact-number-match","clock-match","partial-image-match", "free-numeric"]);

            $table->foreignId('question_category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
