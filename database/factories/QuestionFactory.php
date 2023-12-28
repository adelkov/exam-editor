<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Question;
use App\Models\QuestionCategory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'text' => $this->faker->text(),
            'points' => $this->faker->numberBetween(-10000, 10000),
            'type' => $this->faker->randomElement(["multiple-choice","single-choice","true-or-false","per-digit-match","all-answers-are-good","exact-number-match","cock-match","partial-image-match"]),
            'question_category_id' => QuestionCategory::factory(),
        ];
    }
}
