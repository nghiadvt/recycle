<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Area;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get default limit (10 item) areas
        $areas = Area::limit(config('define.limit.default'))->get();
        $schedules = [
            [
                'date_start_at' => '2023-04-05',
                'date_end_at' => '2023-04-06',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-06',
                'date_end_at' => '2023-04-07',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-08',
                'date_end_at' => '2023-05-24',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-05-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-06-09',
                'date_end_at' => '2023-06-30',
                'time_start_at' => '09:12:13',
                'time_end_at' => '09:16:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-03',
                'date_end_at' => '2023-03-30',
                'time_start_at' => '09:02:1',
                'time_end_at' => '09:09:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
            [
                'date_start_at' => '2023-04-09',
                'date_end_at' => '2023-05-30',
                'time_start_at' => '09:02:13',
                'time_end_at' => '09:02:17',
                'active' => 1,
                'day_of_week' => rand(1, 7),
                'is_repeat' => rand(0, 1),
                'area_id' => $areas->random()->id,
            ],
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}
