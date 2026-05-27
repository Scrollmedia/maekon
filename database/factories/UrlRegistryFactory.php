<?php

namespace Database\Factories;

use App\Handlers\PageHandler;
use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UrlRegistry>
 */
class UrlRegistryFactory extends Factory
{
 
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug,
            'model_id' => Page::factory(), // Автоматически создаст страницу, если не передать id
            'model_type' => Page::class,
            'handler' => PageHandler::class,
        ];
    }

   
}
