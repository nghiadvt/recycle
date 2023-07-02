<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GarbageType;

class GarbageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $garbageTypes = [
            [
                'name' => 'Food & Yard',
                'description' => '<p>
                <br><strong>Food &amp; Yard wates are collected every week.
                </strong></p><ul>
                <li>Collect and put all food and yard waste in the green Food &amp; Yard Waste cart.</li>
                <li>Food and Yard waste are not allowed in the garbage</li>
                <li>All Seattle residents, buildings and food businesses are required to have food waste
                 collection service.</li></ul><p><strong>What goes in my food and yard waste cart?</strong></p><ul>
                <li>Put all frit and vegetables, yard trimmings, meat, dairy and fish in the food and yard waste.</li><li>Plastic bags.
                 recyclables and garbage are not allowed in the food and yard waste.<br>&nbsp;</li>
                </ul><p><strong>How to Set Out Food and Yard waste</strong></p><ul>
                <li>Put your food and yard waste out by 7 a.m. on your collection day.</li>
                <li>Place extra yard waste at least three (3)
                 feet from your garbage so that it is not mistaken for extra garbage. Extra yard waste is $6.55 &nbsp;for each bag,
                  bundle or can. the maximum weight for extra yard waste is 69 pounds per unit.
                <br>&nbsp;</li></ul>',
                'active' => 1,
                'price' => 123,
                'icon' => 'https://cdn-icons-png.flaticon.com/512/3057/3057236.png',
                'unit' => 'gal'
            ],
            [
                'name' => 'Recycling',
                'description' => '<p><br><strong>Recycling &nbsp;is collected every other week, on the same day as your garbage.</strong>
                </p><p><strong>How to Set Out Recycling?</strong></p>
                <ul><li>Set your cart out by 7:00 a.m. on your collection day.</li>
                <li>Place the cart(s) within 3 feet of the curb.<br>&nbsp;</li>
                </ul><p><strong>Additional recyclables</strong></p><ul>
                <li>There is no charge for setting out additional recyclables that do not fit in your cart.<br>&nbsp;</li>
                </ul>',
                'active' => 1,
                'price' => 456,
                'icon' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Recycle001.svg/1200px-Recycle001.svg.png',
                'unit' => 'gal'
            ],
            [
                'name' => 'Garbage',
                'description' => '<p><br><strong>Garbage is collected &nbsp;every week.</strong></p>
                <ul><li>Recyclables, food and yard waste are not allowed in the garbage.</li>
                </ul><p><strong>How to Set Out Garbage?</strong></p>
                <p><strong>&nbsp; &nbsp; &nbsp;</strong>To ensure your garbage is picked up:</p><ul>
                <li>Set your garbage can(s) by 7:00 a.m. on your collection day.</li>
                <li>Put extra garbage in a plastic bag or your own garbage can (up to 32 gallons).
                 Put it next to your regular garbage. Extra garbage is $12.70 for each extra bag,
                  bundle or can. The maximum weight for extra garbage is 60 pounds per unit.
                  <br>&nbsp;</li></ul>',
                'active' => 1,
                'price' => 789,
                'icon' => 'https://static.vecteezy.com/system/resources/previews/000/649/132/original/vector-trash-icon-symbol-sign.jpg',
                'unit' => 'cart'
            ],
        ];

        foreach ($garbageTypes as $garbageType) {
            GarbageType::withoutEvents(function () use ($garbageType) {
                GarbageType::create($garbageType);
            });
        }
    }
}
