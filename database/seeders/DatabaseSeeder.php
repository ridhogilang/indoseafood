<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\EmailCampaignSeeder;
use Database\Seeders\ProductCategorySeeder;
use Database\Seeders\ProductProcessingSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProductCategorySeeder::class,
            ProductSeeder::class,
            ArticleSeeder::class,
            ProductProcessingSeeder::class,
            UserSeeder::class,
            EmailCampaignSeeder::class,
        ]);
    }
}
