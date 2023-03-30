<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PollQuestionFactory extends Factory
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
            'question' => $this->faker->sentence(mt_rand(4, 7), true),
            'poll_id' => $this->faker->numberBetween(1, 40),
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
