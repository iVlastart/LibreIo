<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \Illuminate\Support\Str;

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
        $title = fake()->sentence();
        return [
            'slug'=>Str::slug($title),
            'user_id'=>1,
            'title'=>$title,
            'descr'=>fake()->paragraph(1),
            'src'=>fake()->imageUrl(),
            'thumbnail'=>fake()->imageUrl(),
            'published_at'=>fake()->dateTime()
        ];
    }
}
