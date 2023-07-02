<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [

                'email' => 'anvnt@kozo-japan.com',
                'password' => \Hash::make('password'),
                'first_name' => 'an',
                'last_name' => 'vnt',
                'role' => 'Admin'
            ],
            [
                'name' => 'nghiadvt',
                'email_login' => 'nghiadvt@kozo-japan.com',
            ],
            [
                'name' => 'thienpv',
                'email_login' => 'thienpv@kozo-japan.com',
            ],
            [
                'name' => 'trungnk',
                'email_login' => 'trungnk@kozo-japan.com',
            ],
            [
                'name' => 'phuochq',
                'email_login' => 'phuochq@kozo-japan.com',
            ],
            [
                'name' => 'vannt',
                'email_login' => 'ngo_van@kozo-japan.com',
            ]
        ];
    }
}
