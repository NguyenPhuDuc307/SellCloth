<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Áo nam',
                'description' => 'Các loại áo dành cho nam giới'
            ],
            [
                'name' => 'Áo nữ',
                'description' => 'Các loại áo dành cho nữ giới'
            ],
            [
                'name' => 'Quần nam',
                'description' => 'Các loại quần dành cho nam giới'
            ],
            [
                'name' => 'Quần nữ',
                'description' => 'Các loại quần dành cho nữ giới'
            ],
            [
                'name' => 'Phụ kiện',
                'description' => 'Các phụ kiện thời trang'
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'is_active' => true
            ]);
        }
    }
}
