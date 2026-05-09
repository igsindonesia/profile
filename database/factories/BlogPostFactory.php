<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\PersonalInfo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<BlogPost>
 */
class BlogPostFactory extends Factory
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
            'personal_info_id' => PersonalInfo::factory(),
            'title' => [
                'en' => $title,
                'id' => fake('id_ID')->sentence(),
            ],
            'slug' => Str::slug($title),
            'excerpt' => [
                'en' => fake()->paragraph(),
                'id' => fake('id_ID')->paragraph(),
            ],
            'content' => [
                'en' => fake()->paragraphs(5, true),
                'id' => fake('id_ID')->paragraphs(5, true),
            ],
            'status' => fake()->randomElement(['draft', 'published']),
            'published_at' => fake()->boolean(70) ? fake()->dateTimeBetween('-1 year', '+1 month') : null,
            'meta_description' => [
                'en' => fake()->sentence(),
                'id' => fake('id_ID')->sentence(),
            ],
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'published',
            'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }
}
