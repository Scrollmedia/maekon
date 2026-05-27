<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = $this->faker->realText(rand(10,15));
        return [
            'title' => $title,
            'slug' => $this->faker->unique()->slug(),
            'preview' => 6,
            'excerpt' => $this->faker->realText(80),
            'sort_order' => $this->faker->numberBetween(1, 30),
            'content_blocks' => [
                [
                    "data" => [
                        "title" => $title,
                        "button" => true,
                        "pod_title" => "<p>" . $this->faker->realText(100) . "</p>"
                    ],
                    "type" => "banner"
                ],
                [
                    "data" => [
                        "content" => "
                            <h2>" . $this->faker->realText(rand(10,15)) . "</h2>
                            <p>" . $this->faker->paragraph(3) . "</p>
                            <ul>
                                <li>" . $this->faker->realText(rand(10,15)) . "</li>
                                <li>" . $this->faker->realText(rand(10,15)) . "</li>
                            </ul>
                            <p>" . $this->faker->paragraph(2) . "</p>
                        ",
                    ],
                    "type" => "text"
                ]
            ],
            'publish' => '1',
        ];
    }
}
 