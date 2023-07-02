<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\GarbageTypeSeeder;
use Database\Seeders\AccountSeeder;
use Database\Seeders\AreaSeeder;
use Database\Seeders\ServiceCategorySeeder;
use Database\Seeders\ScheduleSeeder;
use Database\Seeders\GarbageTypeScheduleSeeder;
use Database\Seeders\ServiceGarbageTypeSeeder;
use Database\Seeders\ServiceGarbageSeeder;
use Database\Seeders\ServiceGarbageContentSeeder;
use Database\Seeders\PageSeeder;
use Database\Seeders\UserGarbageTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        $this->call([
            PrefectureSeeder::class,
            CitySeeder::class,
            GarbageTypeSeeder::class,
            AccountSeeder::class,
            ServiceCategorySeeder::class,
            AreaSeeder::class,
            ServiceSeeder::class,
            ServiceArticleSeeder::class,
            ScheduleSeeder::class,
            GarbageTypeScheduleSeeder::class,
            ServiceGarbageTypeSeeder::class,
            ServiceGarbageSeeder::class,
            ServiceGarbageContentSeeder::class,
            ContainerGarbageTypeSeeder::class,
            PageSeeder::class,
            UserGarbageTypeSeeder::class,
            CategorySeeder::class
        ]);
    }
}
