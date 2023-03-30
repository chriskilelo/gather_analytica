<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PollFactory extends Factory
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
            'title' => $this->faker->sentence(4, true),
            'description' => $this->faker->text(95),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
