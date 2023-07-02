<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceGarbage;

class ServiceGarbageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceGarbages = [
            [
                'name' => 'Construction & Demolition',
                'slug' => 'construction-demolition',
                'id' => '1'
            ],
            [
                'name' => 'Exterior',
                'slug' => 'exterior',
                'parent_id' => 1,
            ],
            [
                'name' => 'Gutters',
                'slug' => 'gutters',
                'parent_id' => 2,
            ],
            [
                'name' => 'Mixed Construction Waste',
                'slug' => 'mixed-construction-waste',
                'parent_id' => 2,
            ],
            [
                'name' => 'Plant Or Tree',
                'slug' => 'plant-or-tree',
                'parent_id' => 2,
            ],
            [
                'name' => 'Floors & Ceiling',
                'slug' => 'floors-&-ceiling',
                'parent_id' => 1,
            ],
            [
                'name' => 'Acoustic Ceiling Tile',
                'slug' => 'acoustic-ceiling-tile',
                'parent_id' => 6,
            ],
            [
                'name' => 'Asbestos',
                'slug' => 'asbestos',
                'parent_id' => 6,
            ],
            [
                'name' => 'Asphalt Roofing',
                'slug' => 'asphalt-roofing',
                'parent_id' => 6,
            ],
            [
                'name' => 'Carpet Or Padding',
                'slug' => 'carpet-or-padding',
                'parent_id' => 6,
            ],
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
            ],
            [
                'name' => 'Batteries',
                'slug' => 'batteries',
                'parent_id' => 12,
            ],
            [
                'name' => 'Alkaline Batteries',
                'slug' => 'alkaline-batteries',
                'parent_id' => 13,
            ],
            [
                'name' => 'Button Batteries',
                'slug' => 'button-batteries',
                'parent_id' => 13,
            ],
            [
                'name' => 'Car Batteries',
                'slug' => 'car-batteries',
                'parent_id' => 13,
            ],
            [
                'name' => 'Cds, Dvds, Video Tapes, And Floppy Disks',
                'slug' => 'cds-dvds-video-tapes-and-floppy-disks',
                'parent_id' => 12,
            ],
            [
                'name' => 'Clock Radios',
                'slug' => 'clock-radios',
                'parent_id' => 12,
            ],
            [
                'name' => 'Copiers Or Fax Machines',
                'slug' => 'copiers-or-fax-machines',
                'parent_id' => 12,
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
            ],
            [
                'name' => 'Food Packaging',
                'slug' => 'food-packaging',
            ],
            [
                'name' => 'Glass & Ceramics',
                'slug' => 'glass-&-ceramics',
            ],
            [
                'name' => 'Hazardous Items',
                'slug' => 'hazardous-items',
            ],
            [
                'name' => 'Household Items',
                'slug' => 'household-items',
            ],
            [
                'name' => 'Metal & Metal Items',
                'slug' => 'metal-&-metal-items',
            ],
            [
                'name' => 'Fats, Cooking Oils, Grease',
                'slug' => 'fats-cooking-oils-grease',
                'parent_id' => 20,
            ],
            [
                'name' => 'Food Scraps',
                'slug' => 'food-scraps',
                'parent_id' => 20,
            ],
            [
                'name' => 'Auto & Window Glass',
                'slug' => 'auto-&-window-glass',
                'parent_id' => 22,
            ],
        ];

        foreach ($serviceGarbages as $serviceGarbage) {
            ServiceGarbage::create($serviceGarbage);
        }
    }
}
