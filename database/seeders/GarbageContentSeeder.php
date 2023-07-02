<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GarbageContent;

class GarbageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foodAndYardTitle = ['What goes in my food and yard waste cart?', 'How to Set Out Food and Yard Waste!'];
        $hazardousTitle = 'How to Set Out Hazardous!';
        $recyclingTitle = ['How to Set Out Recycling', 'Additional recyclables'];
        $garbageTitle = 'How to Set Out Hazardous!';

        $contentForFoodAndYard = [
            '<ul>
                <li>Put all fruit and vegetables, yard trimmings, meat, dairy, and fish in the food and yard waste.</li>
                <li>Plastic bags, recyclables and garbage are not allowed in the food and yard waste.</li>
            </ul>',
            '<ul>
                <li>Put your food and yard waste out by 7 a.m on your collection day.</li>
                <li>Place extra yard waste at least three (3) feet from your garbage so that it is not mistaken for extra garbage. Extra yard waste is $6.55 for each bag, bundle or can. The maximum weight for extra yard waste is 60 pounds per unit.</li>
            </ul>'
        ];
        $contentHazardous = '<ul>
                                <li>Put all Hazardous, hazardous materials will be collected and recycled.</li>
                            </ul>';
        $contentGarbage = '<p>To ensure your garbage is pick up:</p>
                            <ul>
                                <li>Set on your garbage can(s) by 7 a.m on your collection day.</li>
                                <li>Put extra garbage in a plastic bag on your own garbage can (up to 32 gallons). Put it next to your regular garbage. Extra garbage is $12.70 for each extra bag, bundle or can. the maximum weigh for extra garbage is 60 pounds per unit.</li>
                            </ul>';
        $contentForRecycling = [
            '<ul>
                <li>Set your cart out by 7:00 a.m on your collection day.</li>
                <li>Place the cart (s) within 3 feet of the curb.</li>
            </ul>',
            '<ul>
                <li>There is no charge for setting out additional recyclavbles that do not fit in your cart.</li>
            </ul>'
        ];

        $garbageContents = [
            [
                'title' => $foodAndYardTitle[0],
                'content' => $contentForFoodAndYard[0],
                'garbage_title_id' => 1,
            ],
            [
                'title' => $foodAndYardTitle[1],
                'content' => $contentForFoodAndYard[1],
                'garbage_title_id' => 1,
            ],
            [
                'title' => $foodAndYardTitle[0],
                'content' => $contentForFoodAndYard[0],
                'garbage_title_id' => 2,
            ],
            [
                'title' => $foodAndYardTitle[1],
                'content' => $contentForFoodAndYard[1],
                'garbage_title_id' => 2,
            ],
            [
                'title' => $hazardousTitle,
                'content' => $contentHazardous,
                'garbage_title_id' => 3,
            ],
            [
                'title' => $recyclingTitle[0],
                'content' => $contentForRecycling[0],
                'garbage_title_id' => 4,
            ],
            [
                'title' => $recyclingTitle[1],
                'content' => $contentForRecycling[1],
                'garbage_title_id' => 4,
            ],
            [
                'title' => $garbageTitle,
                'content' => $contentGarbage,
                'garbage_title_id' => 5,
            ],
            [
                'title' => $recyclingTitle[0],
                'content' => $contentForRecycling[0],
                'garbage_title_id' => 6,
            ],
            [
                'title' => $recyclingTitle[1],
                'content' => $contentForRecycling[1],
                'garbage_title_id' => 6,
            ],
            [
                'title' => $hazardousTitle,
                'content' => $contentHazardous,
                'garbage_title_id' => 7,
            ],
            [
                'title' => $garbageTitle,
                'content' => $contentGarbage,
                'garbage_title_id' => 8,
            ],
            [
                'title' => $recyclingTitle[0],
                'content' => $contentForRecycling[0],
                'garbage_title_id' => 9,
            ],
            [
                'title' => $recyclingTitle[1],
                'content' => $contentForRecycling[1],
                'garbage_title_id' => 9,
            ],
            [
                'title' => $hazardousTitle,
                'content' => $contentHazardous,
                'garbage_title_id' => 10,
            ],
            [
                'title' => $hazardousTitle,
                'content' => $contentHazardous,
                'garbage_title_id' => 11,
            ],
            [
                'title' => $garbageTitle,
                'content' => $contentGarbage,
                'garbage_title_id' => 12,
            ],
            [
                'title' => $foodAndYardTitle[0],
                'content' => $contentForFoodAndYard[0],
                'garbage_title_id' => 13,
            ],
            [
                'title' => $foodAndYardTitle[1],
                'content' => $contentForFoodAndYard[1],
                'garbage_title_id' => 13,
            ],
            [
                'title' => $foodAndYardTitle[1],
                'content' => $contentForFoodAndYard[1],
                'garbage_title_id' => 14,
            ],
            [
                'title' => $foodAndYardTitle[1],
                'content' => $contentForFoodAndYard[1],
                'garbage_title_id' => 14,
            ],
            [
                'title' => $foodAndYardTitle[1],
                'content' => $contentForFoodAndYard[1],
                'garbage_title_id' => 15,
            ],
            [
                'title' => $foodAndYardTitle[1],
                'content' => $contentForFoodAndYard[1],
                'garbage_title_id' => 15,
            ],
            [
                'title' => $recyclingTitle[0],
                'content' => $contentForRecycling[0],
                'garbage_title_id' => 16,
            ],
            [
                'title' => $recyclingTitle[1],
                'content' => $contentForRecycling[1],
                'garbage_title_id' => 16,
            ],
            [
                'title' => $foodAndYardTitle[0],
                'content' => $contentForFoodAndYard[0],
                'garbage_title_id' => 17,
            ],
            [
                'title' => $foodAndYardTitle[1],
                'content' => $contentForFoodAndYard[1],
                'garbage_title_id' => 17,
            ],
            [
                'title' => $recyclingTitle[0],
                'content' => $contentForRecycling[0],
                'garbage_title_id' => 18,
            ],
            [
                'title' => $recyclingTitle[1],
                'content' => $contentForRecycling[1],
                'garbage_title_id' => 18,
            ],
            [
                'title' => $hazardousTitle,
                'content' => $contentHazardous,
                'garbage_title_id' => 19,
            ],
        ];

        foreach ($garbageContents as $garbageContent) {
            GarbageContent::create($garbageContent);
        }
    }
}
