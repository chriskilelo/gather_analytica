<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PollTagFactory extends Factory
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
            'poll_id' => $this->faker->numberBetween(1, 20),
            'tag_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
