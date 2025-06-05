<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Áo nam
            [
                'name' => 'Áo thun nam cổ tròn',
                'description' => 'Áo thun nam chất liệu cotton mềm mại, thoáng mát',
                'price' => 150000,
                'sale_price' => 120000,
                'stock_quantity' => 50,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'colors' => ['Đen', 'Trắng', 'Xám', 'Navy'],
                'category' => 'Áo nam',
                'is_featured' => true
            ],
            [
                'name' => 'Áo sơ mi nam',
                'description' => 'Áo sơ mi nam công sở, chất liệu cao cấp',
                'price' => 300000,
                'stock_quantity' => 30,
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'colors' => ['Trắng', 'Xanh nhạt', 'Hồng nhạt'],
                'category' => 'Áo nam'
            ],

            // Áo nữ
            [
                'name' => 'Áo thun nữ crop top',
                'description' => 'Áo thun nữ phom crop, phong cách trẻ trung',
                'price' => 120000,
                'sale_price' => 99000,
                'stock_quantity' => 40,
                'sizes' => ['S', 'M', 'L'],
                'colors' => ['Hồng', 'Trắng', 'Đen', 'Vàng'],
                'category' => 'Áo nữ',
                'is_featured' => true
            ],
            [
                'name' => 'Áo kiểu nữ tay dài',
                'description' => 'Áo kiểu nữ elegant, phù hợp đi làm',
                'price' => 250000,
                'stock_quantity' => 25,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'colors' => ['Đen', 'Trắng', 'Xanh'],
                'category' => 'Áo nữ'
            ],

            // Quần nam
            [
                'name' => 'Quần jean nam slim fit',
                'description' => 'Quần jean nam phom slim, chất liệu denim cao cấp',
                'price' => 400000,
                'sale_price' => 350000,
                'stock_quantity' => 35,
                'sizes' => ['29', '30', '31', '32', '33', '34'],
                'colors' => ['Xanh đậm', 'Xanh nhạt', 'Đen'],
                'category' => 'Quần nam',
                'is_featured' => true
            ],

            // Quần nữ
            [
                'name' => 'Quần jean nữ skinny',
                'description' => 'Quần jean nữ ôm body, tôn dáng',
                'price' => 350000,
                'stock_quantity' => 30,
                'sizes' => ['25', '26', '27', '28', '29', '30'],
                'colors' => ['Xanh đậm', 'Đen', 'Trắng'],
                'category' => 'Quần nữ'
            ]
        ];

        foreach ($products as $productData) {
            $category = Category::where('name', $productData['category'])->first();

            if ($category) {
                Product::create([
                    'name' => $productData['name'],
                    'slug' => Str::slug($productData['name']),
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'sale_price' => $productData['sale_price'] ?? null,
                    'stock_quantity' => $productData['stock_quantity'],
                    'sizes' => $productData['sizes'],
                    'colors' => $productData['colors'],
                    'category_id' => $category->id,
                    'is_active' => true,
                    'is_featured' => $productData['is_featured'] ?? false
                ]);
            }
        }
    }
}
