<?php

namespace Database\Factories;

use App\Models\QuestionCategory;
use App\Traits\Models\HasCommonQuestionAttributes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MultipleChoiceQuestion>
 */
class MultipleChoiceQuestionFactory extends Factory
{

    use HasCommonQuestionAttributes;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get the common attributes from the trait
        $commonAttributes = $this->defineCommonAttributes($this->faker);

        // Define custom attributes specific to MultipleChoiceQuestion
        $customAttributes = [
            'type' => 'multiple-choice',
        ];

        // Merge the common attributes with the custom ones and return the result
        return array_merge($commonAttributes, $customAttributes);
    }
}
