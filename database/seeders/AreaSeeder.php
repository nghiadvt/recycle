<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Load data from areas.json and insert into the areas table in batches of 1000 records.
         */
        $json = file_get_contents(database_path('data/areas.json'));
        $areas = json_decode($json, true);
        $areas = $areas['RECORDS'];
        $chunks = array_chunk($areas, 1000);

        foreach ($chunks as $chunk) {
            DB::table('areas')->insert($chunk);
        }
    }
}
