<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ModuleTemplate;
use App\Models\QuestionCategory;
use App\Models\QuestionGroupTemplate;

class QuestionGroupTemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuestionGroupTemplate::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'numberOfQuestions' => $this->faker->numberBetween(-10000, 10000),
            'pointsFrom' => $this->faker->numberBetween(-10000, 10000),
            'pointsTo' => $this->faker->numberBetween(-10000, 10000),
            'module_template_id' => ModuleTemplate::factory(),
            'question_category_id' => QuestionCategory::factory(),
        ];
    }
}
