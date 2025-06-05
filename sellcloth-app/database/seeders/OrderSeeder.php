<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'customer_name' => 'Nguyễn Văn Minh',
                'customer_email' => 'minhnv@example.com',
                'customer_phone' => '0987654321',
                'shipping_address' => '123 Đường ABC, Quận 1, TP.HCM',
                'status' => 'delivered',
                'payment_status' => 'paid',
                'items' => [
                    ['product_name' => 'Áo thun nam cổ tròn', 'quantity' => 2, 'size' => 'L', 'color' => 'Đen'],
                    ['product_name' => 'Quần jean nam slim fit', 'quantity' => 1, 'size' => '32', 'color' => 'Xanh đậm']
                ]
            ],
            [
                'customer_name' => 'Trần Thị Lan',
                'customer_email' => 'lantran@example.com',
                'customer_phone' => '0912345678',
                'shipping_address' => '456 Đường DEF, Quận 3, TP.HCM',
                'status' => 'processing',
                'payment_status' => 'paid',
                'items' => [
                    ['product_name' => 'Áo thun nữ crop top', 'quantity' => 1, 'size' => 'M', 'color' => 'Hồng'],
                    ['product_name' => 'Quần jean nữ skinny', 'quantity' => 1, 'size' => '27', 'color' => 'Đen']
                ]
            ],
            [
                'customer_name' => 'Lê Văn Đức',
                'customer_email' => 'ducle@example.com',
                'customer_phone' => '0909876543',
                'shipping_address' => '789 Đường GHI, Quận 5, TP.HCM',
                'status' => 'pending',
                'payment_status' => 'pending',
                'items' => [
                    ['product_name' => 'Áo sơ mi nam', 'quantity' => 2, 'size' => 'L', 'color' => 'Trắng']
                ]
            ]
        ];

        foreach ($orders as $orderData) {
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => $orderData['customer_name'],
                'customer_email' => $orderData['customer_email'],
                'customer_phone' => $orderData['customer_phone'],
                'shipping_address' => $orderData['shipping_address'],
                'total_amount' => 0, // Sẽ tính sau
                'status' => $orderData['status'],
                'payment_status' => $orderData['payment_status'],
            ]);

            $totalAmount = 0;

            foreach ($orderData['items'] as $itemData) {
                $product = Product::where('name', $itemData['product_name'])->first();
                
                if ($product) {
                    $price = $product->sale_price ?? $product->price;
                    $totalPrice = $price * $itemData['quantity'];
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'product_price' => $price,
                        'quantity' => $itemData['quantity'],
                        'size' => $itemData['size'],
                        'color' => $itemData['color'],
                        'total_price' => $totalPrice
                    ]);

                    $totalAmount += $totalPrice;
                }
            }

            // Cập nhật tổng tiền cho đơn hàng
            $order->update(['total_amount' => $totalAmount]);
        }
    }
}
