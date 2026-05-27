<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Brand;
use App\Models\Direction;
use App\Models\Post;
use App\Models\Seo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
        $page = Page::factory(5)->has(Seo::factory(), 'seo')->create();

        $post = Post::factory(5)->has(Seo::factory(), 'seo')->create();
 
        $portfolio = Brand::factory(5)->has(Seo::factory(), 'seo')->create();
 
        $service = Direction::factory(5)->has(Seo::factory(), 'seo')->create();


    }
}
