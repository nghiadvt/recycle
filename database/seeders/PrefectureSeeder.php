<?php

namespace Database\Seeders;

use App\Models\Prefecture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrefectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Load data from prefectures.json and insert into the prefectures table in batches of 1000 records.
         */
        $json = file_get_contents(database_path('data/prefectures.json'));
        $prefectures = json_decode($json, true);
        $prefectures = $prefectures['RECORDS'];
        foreach ($prefectures as $item) {
            $prefectures = new Prefecture();
            $prefectures->pref_no = $item['pref_no'];
            $prefectures->name = $item['name'];
            $prefectures->active = $item['active'];
            $prefectures->order = $item['order'];
            $prefectures->save();
        }
    }
}
