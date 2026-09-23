<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Prozessor (CPU)', 'slug' => 'cpu'],
            ['name' => 'Mainboard', 'slug' => 'mainboard'],
            ['name' => 'Arbeitsspeicher (RAM)', 'slug' => 'ram'],
            ['name' => 'Grafikkarte (GPU)', 'slug' => 'gpu'],
            ['name' => 'Netzteil (PSU)', 'slug' => 'netzteil'],
            ['name' => 'SSD', 'slug' => 'ssd'],
            ['name' => 'Gehäuse', 'slug' => 'gehaeuse'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
