<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PollAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account_id' => 1,
            'answer' => $this->faker->sentence(4, true),
            'is_active' => $this->faker->boolean(80),
            'poll_question_id' => $this->faker->numberBetween(1, 20)
        ];
    }
}
