<?php

namespace Database\Seeders;

use App\Models\UserGarbageType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserGarbageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userGarbages = [
            [
                "garbage_type_id" => 1,
                "weight" => 32,
                "account_id" => 2
            ],
            [
                "garbage_type_id" => 2,
                "weight" => 60,
                "account_id" => 1
            ], [
                "garbage_type_id" => 3,
                "weight" => 90,
                "account_id" => 1
            ],
        ];

        foreach ($userGarbages as $userGarbage) {
            UserGarbageType::create($userGarbage);
        }
    }
}
