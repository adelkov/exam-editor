<?php

namespace App\Traits\Models;

use App\Models\QuestionCategory;
use Faker\Generator as Faker;

trait HasCommonQuestionAttributes
{
    public function defineCommonAttributes(Faker $faker)
    {
        return [
            'name' => $this->faker->name(),
            'text' => $this->faker->text(),
            'points' => $this->faker->numberBetween(0, 10),
            'question_category_id' => QuestionCategory::factory(),
        ];
    }
}
