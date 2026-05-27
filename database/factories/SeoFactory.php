<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seo>
 */
class SeoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
 
        $title = $this->faker->realText(rand(10,15));
        $description =  $this->faker->realText(30);

        return [
            'title' => $title,
            'description' => $description,
            'og_title' =>  $title,
            'og_description' =>  $description,
 

        ];
    }
}
