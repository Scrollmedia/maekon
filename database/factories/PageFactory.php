<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\UrlRegistry;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
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
          'template' => 'default',
          'publish' => '1',
 
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Page $page) {
            UrlRegistry::updateOrCreate([
                'slug' => $page->slug,
                'model_id' => $page->id,
                'model_type' => Page::class,
                'handler' => \App\Handlers\PageHandler::class,
            ]);
        });
    }
}
