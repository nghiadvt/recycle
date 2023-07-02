<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContainerGarbageType;

class ContainerGarbageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $garbages = [
            [
                'garbage_type_id' => '1',
                'bin_size' => '1',
                'image' => 'https://bit.ly/3W30oPS'
            ],
            [
                'garbage_type_id' => '1',
                'bin_size' => '2',
                'image' => 'https://bit.ly/3MsMrYc'
            ],
            [
                'garbage_type_id' => '2',
                'bin_size' => '13',
                'image' => 'https://bit.ly/452mbv0'
            ],
            [
                'garbage_type_id' => '2',
                'bin_size' => '32',
                'image' => 'https://bit.ly/3pHwjcI'

            ], [
                'garbage_type_id' => '2',
                'bin_size' => '96',
                'image' => 'https://bit.ly/3W0YShi'
            ], [
                'garbage_type_id' => '3',
                'bin_size' => '12',
                'image' => 'https://bit.ly/3I6X qUM'
            ], [
                'garbage_type_id' => '3',
                'bin_size' => '20',
                'image' => 'https://bit.ly/42UH0a5'
            ], [
                'garbage_type_id' => '3',
                'bin_size' => '32',
                'image' => 'https://bit.ly/3I9tqaO'
            ], [
                'garbage_type_id' => '3',
                'bin_size' => '64',
                'image' => 'https://bit.ly/3Moo91J'
            ], [
                'garbage_type_id' => '3',
                'bin_size' => '96',
                'image' => 'https://bit.ly/3pAoTb3'
            ],
        ];

        foreach ($garbages as $garbage) {
            ContainerGarbageType::withoutEvents(function () use ($garbage) {
                ContainerGarbageType::create($garbage);
            });
        }
    }
}
