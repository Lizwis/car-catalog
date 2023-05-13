<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [1, 2, 3]; // assuming you have 3 categories in the database
        $makes = ['Toyota', 'Honda', 'Ford', 'Tesla', 'Chevrolet'];
        $models = ['Corolla', 'Accord', 'Mustang', 'Model S', 'Camaro'];

        for ($i = 0; $i < 30; $i++) {
            $car = [
                'make' => $makes[array_rand($makes)],
                'model' => $models[array_rand($models)],
                'image' => 'https://via.placeholder.com/300',
                'year' => rand(2020, 2023),
                'price' => rand(20000, 80000),
                'category_id' => $categories[array_rand($categories)]
            ];
            Car::create($car);
        }
    }
}
