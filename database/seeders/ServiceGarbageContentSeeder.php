<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceGarbageContent;

class ServiceGarbageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceGarbageContents = [
            [
                'service_garbage_type_id' => 5,
                'service_garbage_id' => 3,
                'content' => '<p>Bring gutters 8 feet or less in length to <a href="https://www.seattle.gov/utilities/your-services/collection-and-disposal/transfer-stations">city transfer stations</a>:</p>
                                <ul>
                                    <li>Fees apply for plastic gutters.</li>
                                    <li>There is no fee for aluminum gutters.</li>
                                </ul>',
            ],
            [
                'service_garbage_type_id' => 1,
                'service_garbage_id' => 4,
                'content' => '<p>Put small amounts of construction waste in the garbage. Do not exceed weight limits.</p>',
            ],
            [
                'service_garbage_type_id' => 5,
                'service_garbage_id' => 4,
                'content' => '<p>Bring mixed construction and demolition waste to
                                    <a href="https://www.seattle.gov/utilities/your-services/collection-and-disposal/transfer-stations">
                                        city transfer stations
                                    </a>.
                                        Fees apply.
                                    <a href="https://www.seattle.gov/utilities/your-services/collection-and-disposal/transfer-stations/rates">
                                        Check rates here
                                    </a>.
                                </p>',
            ],
            [
                'service_garbage_type_id' => 2,
                'service_garbage_id' => 4,
                'content' => '<p>For other disposal and recycling options</p>',
            ],
            [
                'service_garbage_type_id' => 4,
                'service_garbage_id' => 5,
                'content' => '<p>Plants and trees go in the food and yard waste. Remove pots and soil.
                                     All pieces must be less than 4 inches in diameter and under 4 feet long.</p>
                                <h3>Did you know?</h3>
                                <p>You can give your plant a new home through your neighborhood</p>',
            ],
            [
                'service_garbage_type_id' => 1,
                'service_garbage_id' => 7,
                'content' => '<p>Ceiling tiles that dont contain asbestos can go in the garbage:</p>
                                <ul>
                                    <li>Items must fit in your cart with the lid closed.</li>
                                    <li>Dont exceed the printed on your cart.</li>
                                </ul>',
            ],
            [
                'service_garbage_type_id' => 2,
                'service_garbage_id' => 7,
                'content' => '<p>Bring acoustic ceiling tiles that dont contain asbestos to</p>',
            ],
            [
                'service_garbage_type_id' => 6,
                'service_garbage_id' => 7,
                'content' => '<p>If you believe the ceiling tile contains asbestos</p>',
            ],
            [
                'service_garbage_type_id' => 6,
                'service_garbage_id' => 8,
                'content' => '<p>Asbestos is considered a hazardous material that does not belong in the garbage. Because asbestos is harmful to people, animals, and the environment,
                                    it must be disposed of at designated facilities.</p>
                                <h3>Did you know?</h3>
                                <p>Because asbestos is harmful to people, animals, and the environment, it must be disposed of at designated facilities.</p>',
            ],
            [
                'service_garbage_type_id' => 1,
                'service_garbage_id' => 9,
                'content' => '<p>Asphalt roofing that doesnt contain asbestos can go in the garbage:</p>
                                <ul>
                                    <li>Items must fit in your cart with the lid closed.</li>
                                </ul>',
            ],
            [
                'service_garbage_type_id' => 2,
                'service_garbage_id' => 9,
                'content' => '<p>Bring asphalt roofing shingles that dont contain asbestos.</p>',
            ],
            [
                'service_garbage_type_id' => 6,
                'service_garbage_id' => 9,
                'content' => '<p>If you believe the roofing contains asbestos.</p>',
            ],
            [
                'service_garbage_type_id' => 1,
                'service_garbage_id' => 10,
                'content' => '<p>Fees apply. Carpet and padding can go in the garbage. Cut into smaller pieces if carpet.</p>',
            ],
            [
                'service_garbage_type_id' => 1,
                'service_garbage_id' => 13,
                'content' => '<p>Non-rechargeable, household alkaline batteries (such as AAA, AA, C, D, or 9-volt) can go in the garbage.</p>',
            ],
            [
                'service_garbage_type_id' => 1,
                'service_garbage_id' => 14,
                'content' => '<p>Button cell batteries used in watches and some older camera models can go in the garbage.</p>
                                <p>Button cell batteries are also used for:</p>
                                <ul>
                                    <li>Digital thermometers</li>
                                    <li>Pocket calculators</li>
                                    <li>Hearing aids</li>
                                </ul>',
            ],
            [
                'service_garbage_type_id' => 6,
                'service_garbage_id' => 15,
                'content' => '<p>Bring vehicle batteries to
                                    <a href="https://www.seattle.gov/utilities/your-services/collection-and-disposal/transfer-stations">
                                            city transfer stations
                                    </a>.
                                    Fees apply.
                                </p>',
            ]
        ];

        foreach ($serviceGarbageContents as $serviceGarbageContent) {
            ServiceGarbageContent::create($serviceGarbageContent);
        }
    }
}
