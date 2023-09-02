<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Furniture',
            ],
            [
                'name' => 'Fashon',
            ],
            [
                'name' => 'Pet Products',
            ],
            [
                'name' => 'Baby Products',
            ],
            [
                'name' => 'Work Clothing',
            ],
        ];

        foreach ($categories as $key => $value) {
            Category::create($value);
        }
    }
}
