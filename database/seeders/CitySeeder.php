<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Load data from cities.json and insert into the cities table in batches of 1000 records.
         */
        $json = file_get_contents(database_path('data/cities.json'));
        $cities = json_decode($json, true);
        $cities = $cities['RECORDS'];
        $chunks = array_chunk($cities, 1000);

        foreach ($chunks as $chunk) {
            DB::table('cities')->insert($chunk);
        }
    }
}
