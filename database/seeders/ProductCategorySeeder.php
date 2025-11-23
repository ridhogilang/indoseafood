<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Demersal',
            'Pelagic',
            'Cephalophodae',
            'Arthopodae',
        ];

        foreach ($categories as $name) {
            ProductCategory::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        }
    }
}
