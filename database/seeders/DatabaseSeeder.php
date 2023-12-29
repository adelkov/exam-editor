<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ExamTemplate;
use App\Models\FreeNumericQuestion;
use App\Models\ModuleTemplate;
use App\Models\MultipleChoiceQuestion;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\QuestionGroupTemplate;
use App\Models\SingleChoiceQuestion;
use Database\Factories\SingleChoiceQuestionFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $categories = QuestionCategory::factory(20)->create();

        MultipleChoiceQuestion::factory(100)->recycle($categories)->create();
        SingleChoiceQuestion::factory(100)->recycle($categories)->create();
        FreeNumericQuestion::factory(100)->recycle($categories)->create();
//        Question::factory(3000)->recycle($categories)->create();
    }
}
