<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GarbageTypeSchedule;

class GarbageTypeScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $garbageTypeSchedules = [
            [
                'schedule_id' => 2,
                'garbage_type_id' => 1,
            ],
            [
                'schedule_id' => 1,
                'garbage_type_id' => 1,
            ],
            [
                'schedule_id' => 2,
                'garbage_type_id' => 3,
            ],
            [
                'schedule_id' => 1,
                'garbage_type_id' => 1,
            ],
            [
                'schedule_id' => 1,
                'garbage_type_id' => 3,
            ],
            [
                'schedule_id' => 3,
                'garbage_type_id' => 2,
            ],
            [
                'schedule_id' => 4,
                'garbage_type_id' => 3,
            ],
            [
                'schedule_id' => 4,
                'garbage_type_id' => 2,
            ],
            [
                'schedule_id' => 5,
                'garbage_type_id' => 2,
            ],
            [
                'schedule_id' => 6,
                'garbage_type_id' => 3,
            ],
            [
                'schedule_id' => 6,
                'garbage_type_id' => 2,
            ],
            [
                'schedule_id' => 7,
                'garbage_type_id' => 1,
            ],
            [
                'schedule_id' => 8,
                'garbage_type_id' => 1,
            ],
            [
                'schedule_id' => 9,
                'garbage_type_id' => 1,
            ],
            [
                'schedule_id' => 8,
                'garbage_type_id' => 3,
            ],
            [
                'schedule_id' => 10,
                'garbage_type_id' => 3,
            ], [
                'schedule_id' => 11,
                'garbage_type_id' => 3,
            ], [
                'schedule_id' => 12,
                'garbage_type_id' => 3,
            ],
            [
                'schedule_id' => 13,
                'garbage_type_id' => 2,
            ],
            [
                'schedule_id' => 13,
                'garbage_type_id' => 1,
            ],
            [
                'schedule_id' => 14,
                'garbage_type_id' => 2,
            ],
            [
                'schedule_id' => 15,
                'garbage_type_id' => 2,
            ],
            [
                'schedule_id' => 16,
                'garbage_type_id' => 3,
            ],
            [
                'schedule_id' => 17,
                'garbage_type_id' => 1,
            ],
            [
                'schedule_id' => 17,
                'garbage_type_id' => 2,
            ],
            [
                'schedule_id' => 18,
                'garbage_type_id' => 1,
            ],
            [
                'schedule_id' => 19,
                'garbage_type_id' => 1,
            ],
            [
                'schedule_id' => 20,
                'garbage_type_id' => 2,
            ],
            [
                'schedule_id' => 20,
                'garbage_type_id' => 3,
            ],
        ];

        foreach ($garbageTypeSchedules as $garbageTypeSchedule) {
            GarbageTypeSchedule::create($garbageTypeSchedule);
        }
    }
}
