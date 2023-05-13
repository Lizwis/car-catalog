<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Sedan'],
            ['name' => 'Coupe'],
            ['name' => 'Hatchback'],
            ['name' => 'SUV'],
            ['name' => 'Truck'],
            ['name' => 'Van'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
