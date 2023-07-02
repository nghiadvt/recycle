<?php

namespace Database\Seeders;

use App\Models\ServiceArticle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceArticle::factory()->count(20)->create();
    }
}
