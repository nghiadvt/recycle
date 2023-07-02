<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceCategory::factory()->count(20)->create();
        $serviceCategories = ServiceCategory::all();
        foreach ($serviceCategories as $serviceCategory) {
            $serviceCategory->parent_id = $serviceCategory->id;
            $serviceCategory->save();
        }
    }
}
