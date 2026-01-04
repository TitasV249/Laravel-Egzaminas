<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Pajamos
            ['name' => 'Atlyginimas', 'type' => 'income'],
            ['name' => 'Kita', 'type' => 'income'],

            // Išlaidos
            ['name' => 'Maistas', 'type' => 'expense'],
            ['name' => 'Kuras', 'type' => 'expense'],
            ['name' => 'Būstas', 'type' => 'expense'],
            ['name' => 'Pramogos', 'type' => 'expense'],
            ['name' => 'Transportas', 'type' => 'expense'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate($category);
        }
    }
}
