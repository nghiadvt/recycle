<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Education',
                'icon' => 'https://w7.pngwing.com/pngs/213/244/png-transparent-school-graduation-ceremony-computer-icons-higher-education-school-angle-logo-graduation-ceremony-thumbnail.png',
                'is_active' => 1
            ], [
                'name' => 'Entertainment',
                'icon' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0-pQq6G_lGM-LUAAF-0XK-HaguTyCVavmTQ&usqp=CAU',
                'is_active' => 1
            ], [
                'name' => 'Fashion',
                'icon' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQi8uh70rDtr15dO3YU2NWmpHXrnZ9ai2kMDA&usqp=CAU',
                'is_active' => 1
            ], [
                'name' => 'fashion accessories',
                'icon' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5bJfPp-5-ZcMvNkyj2NUxNq_vqn1emIZSsA&usqp=CAU',
                'is_active' => 1,
                'parent_id' => 3
            ], [
                'name' => 'Movie',
                'icon' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRESTZo0HcrNCF65UCh-7DhHLb8WYvl5S02Q&usqp=CAU',
                'is_active' => 1,
                'parent_id' => 1
            ]
        ];
        foreach ($categories as $category) {
            Category::withoutEvents(function () use ($category) {
                Category::create($category);
            });
        }
    }
}
