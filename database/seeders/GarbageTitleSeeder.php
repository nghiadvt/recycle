<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GarbageTitle;

class GarbageTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titleFoodAndYard = 'Food & Yard waste are collected every week!';
        $titleRecycling = 'Recycling is collected every week, on the same day as your garbage.';
        $titleGarbage = 'Garbage is collected every week!';
        $titleHazardous = 'Hazardous is collected every week!';
        $descriptionTitleFoodAndYard = '<ul>
                                            <li>Collection and put all food and yard waste in the green Food &amp; Yard waste cart.</li>
                                            <li>Food &amp; Yard waste are not allowed in the garbage.</li>
                                            <li>All seattle residents, buildings and food business are required to have food waste.</li>
                                        </ul>';
        $descriptionHazardous = '<ul>
                                    <li>The hazardous material can cause fire and explosion.</li>
                                </ul>';
        $descriptionGarbage = '<ul>
                                    <li>Recylables, food and yard waste are not allowed in garbage.</li>
                                </ul>';
        $descriptionRecycling = '';

        $garbageTitles = [
            [
                'title' => $titleFoodAndYard,
                'description' => $descriptionTitleFoodAndYard,
                'schedule_id' => 1,
                'garbage_type_id' => 1,
            ],
            [
                'title' => $titleFoodAndYard,
                'description' => $descriptionTitleFoodAndYard,
                'schedule_id' => 2,
                'garbage_type_id' => 1,
            ],
            [
                'title' => $titleHazardous,
                'description' => $descriptionHazardous,
                'schedule_id' => 2,
                'garbage_type_id' => 4,
            ],
            [
                'title' => $titleRecycling,
                'description' => $descriptionRecycling,
                'schedule_id' => 3,
                'garbage_type_id' => 2,
            ],
            [
                'title' => $titleGarbage,
                'description' => $descriptionGarbage,
                'schedule_id' => 4,
                'garbage_type_id' => 3,
            ],
            [
                'title' => $titleRecycling,
                'description' => $descriptionRecycling,
                'schedule_id' => 4,
                'garbage_type_id' => 2,
            ],
            [
                'title' => $titleHazardous,
                'description' => $descriptionHazardous,
                'schedule_id' => 5,
                'garbage_type_id' => 4,
            ],
            [
                'title' => $titleGarbage,
                'description' => $descriptionGarbage,
                'schedule_id' => 6,
                'garbage_type_id' => 3,
            ],
            [
                'title' => $titleRecycling,
                'description' => $descriptionRecycling,
                'schedule_id' => 6,
                'garbage_type_id' => 2,
            ],
            [
                'title' => $titleHazardous,
                'description' => $descriptionHazardous,
                'schedule_id' => 8,
                'garbage_type_id' => 1,
            ],
            [
                'title' => $titleGarbage,
                'description' => $descriptionGarbage,
                'schedule_id' => 8,
                'garbage_type_id' => 3,
            ],
            [
                'title' => $titleFoodAndYard,
                'description' => $descriptionTitleFoodAndYard,
                'schedule_id' => 9,
                'garbage_type_id' => 1,
            ],
            [
                'title' => $titleFoodAndYard,
                'description' => $descriptionTitleFoodAndYard,
                'schedule_id' => 10,
                'garbage_type_id' => 3,
            ],
            [
                'title' => $titleFoodAndYard,
                'description' => $descriptionTitleFoodAndYard,
                'schedule_id' => 11,
                'garbage_type_id' => 3,
            ],
            [
                'title' => $titleFoodAndYard,
                'description' => $descriptionTitleFoodAndYard,
                'schedule_id' => 12,
                'garbage_type_id' => 3,
            ],
            [
                'title' => $titleRecycling,
                'description' => $descriptionRecycling,
                'schedule_id' => 13,
                'garbage_type_id' => 2,
            ],
            [
                'title' => $titleFoodAndYard,
                'description' => $descriptionTitleFoodAndYard,
                'schedule_id' => 13,
                'garbage_type_id' => 1,
            ],
            [
                'title' => $titleRecycling,
                'description' => $descriptionRecycling,
                'schedule_id' => 14,
                'garbage_type_id' => 2,
            ],
            [
                'title' => $titleHazardous,
                'description' => $descriptionHazardous,
                'schedule_id' => 15,
                'garbage_type_id' => 4,
            ],
        ];

        foreach ($garbageTitles as $garbageTitle) {
            GarbageTitle::create($garbageTitle);
        }
    }
}
