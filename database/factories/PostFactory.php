<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'author_id' => rand(1,4),
            'post_name' => $this->faker->realText(rand(10,40)),
            'content' => $this->faker->realText(rand(100,500)),
            'created_at' => $this->faker->dateTimeBetween('-30 days','1 day'),
            'updated_at' => $this->faker->dateTimeBetween('-30 days','1 day'),
        ];
    }
}
