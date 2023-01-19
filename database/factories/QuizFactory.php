<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->text(),
            'category_id' => 1,
            'user_id' => 1,
        ];
    }
}
