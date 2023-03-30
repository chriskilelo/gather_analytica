<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PollVoteFactory extends Factory
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
            'poll_id' => $this->faker->numberBetween(1, 20),
            'tag_id' => $this->faker->numberBetween(1, 20),
            'poll_question_id' => $this->faker->numberBetween(1, 20),
            'poll_answer_id' => $this->faker->numberBetween(1, 20),
            'user_id' => $this->faker->numberBetween(1, 3),
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
