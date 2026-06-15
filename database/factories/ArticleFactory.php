<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title_en = fake()->sentence();
        return [
            'slug' => \Illuminate\Support\Str::slug($title_en),
            'title_id' => 'Judul Dummy: ' . fake('id_ID')->sentence(),
            'title_en' => $title_en,
            'content_id' => '<p>' . implode('</p><p>', fake('id_ID')->paragraphs(4)) . '</p>',
            'content_en' => '<p>' . implode('</p><p>', fake()->paragraphs(4)) . '</p>',
            'image' => null, // Placeholder will be handled in view
            'seo_title' => null,
            'seo_description' => fake()->text(150),
            'is_published' => true,
        ];
    }
}
