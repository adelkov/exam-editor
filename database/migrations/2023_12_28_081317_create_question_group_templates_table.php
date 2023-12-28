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
        Schema::create('question_group_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('numberOfQuestions');
            $table->integer('pointsFrom');
            $table->integer('pointsTo');
            $table->foreignId('module_template_id');
            $table->foreignId('question_category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_group_templates');
    }
};
