<?php

namespace Database\Factories;

use App\Models\Category;
use Exception;
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
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'content' => $this->faker->text,
            'likes' => random_int(1, 2000),
            'is_published' => 1,
            'category_id' => Category::query()->get()->random()->id,
        ];
    }
}
