<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceGarbageType;

class ServiceGarbageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceGarbageTypes = [
            [
                'name' => 'In Garbage'
            ],
            [
                'name' => 'Drop-off Options'
            ],
            [
                'name' => 'In Recycling'
            ],
            [
                'name' => 'In Food & Yard Waste'
            ],
            [
                'name' => 'Transfer Station'
            ],
            [
                'name' => 'Hazardous'
            ],
            [
                'name' => 'Special Item Pickup'
            ],
            [
                'name' => 'Reuse, Repair, and Donate'
            ],
        ];

        foreach ($serviceGarbageTypes as $serviceGarbageType) {
            ServiceGarbageType::create($serviceGarbageType);
        }
    }
}
