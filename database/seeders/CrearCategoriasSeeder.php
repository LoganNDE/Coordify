<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrearCategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'arte', 'image' => '/img/categories/art.svg'],
            ['name' => 'negocios', 'image' => '/img/categories/business.svg'],
            ['name' => 'educación', 'image' => '/img/categories/education.svg'],
            ['name' => 'ocio', 'image' => '/img/categories/entertainment.svg'],
            ['name' => 'gastronomía', 'image' => '/img/categories/food.svg'],
            ['name' => 'gaming', 'image' => '/img/categories/gaming.svg'],
            ['name' => 'bienestar', 'image' => '/img/categories/health.svg'],
            ['name' => 'naturaleza', 'image' => '/img/categories/nature.svg'],
            ['name' => 'deportes', 'image' => '/img/categories/sport.svg'],
            ['name' => 'tecnología', 'image' => '/img/categories/technology.svg'],
        ];

        foreach ($categories as $data) {
            $category = new Category();
            $category->name = $data['name'];
            $category->image = $data['image'];
            $category->save();
        }
    }
}
