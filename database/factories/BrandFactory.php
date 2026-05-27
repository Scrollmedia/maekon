<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
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
            'preview' => 5,
            'sort_order' => $this->faker->numberBetween(1, 30),
            'content_blocks' => [
                [
                    "data" => [
                        "title" => $title,
                        "button" => true,
                        "pod_title" => "<p>" . $this->faker->realText(100) . "</p>"
                    ],
                    "type" => "banner"
                ]
            ],
            'publish' => '1',
        ];
    }
}
