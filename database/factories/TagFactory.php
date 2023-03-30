<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
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
            'tag_name' => $this->faker->words(mt_rand(1, 2), true),
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
