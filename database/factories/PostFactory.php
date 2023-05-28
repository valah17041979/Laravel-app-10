<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Post;

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
    public function definition(): array
    {
        return [
        'name' => $this->faker->realText(rand(11, 50)),
        'description' => $this->faker->realText(rand(110, 300)),
        'created_at' => $this->faker->dateTimeBetween('-60 days', '-30 days'),
        'updated_at' => $this->faker->dateTimeBetween('-20 days', '-1 days'),
    ];
    }
}
