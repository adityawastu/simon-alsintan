<?php

namespace Database\Seeders;

use App\Models\Admin\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Traktor Roda Dua',
            'Traktor Roda Empat',
            'Pompa Air',
            'Hand Sprayer',
            'Cultivator',
            'Power Thresher',
            'Rice Transplanter',
            'Combine Harvester',
            'Corn Sheller',
            'Mesin Penggiling Padi',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
