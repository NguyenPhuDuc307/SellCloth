# Project Brief - SellCloth

## Overview
SellCloth là một website bán quần áo đơn giản được xây dựng bằng PHP Laravel framework với Filament admin panel. Dự án nhằm mục đích tạo ra một hệ thống e-commerce cơ bản để bán các sản phẩm quần áo với giao diện đẹp và dễ sử dụng.

## Core Requirements
- **Framework**: Laravel 12.x với PHP 8.2+
- **Admin Panel**: Filament 3.3+ để quản lý dữ liệu
- **Database**: MySQL với tên database `sell_cloth`
- **Language**: Vietnamese interface với English codebase
- **Target**: Website bán quần áo đơn giản nhưng đầy đủ chức năng

## Key Features
1. **Product Management**
   - Quản lý sản phẩm quần áo
   - Hỗ trợ multiple sizes (S, M, L, XL, etc.)
   - Hỗ trợ multiple colors
   - Hình ảnh sản phẩm (JSON array)
   - Giá gốc và giá khuyến mãi
   - Quản lý tồn kho

2. **Category Management**
   - Phân loại sản phẩm (Áo nam, Áo nữ, Quần nam, Quần nữ, Phụ kiện)
   - Slug system cho SEO
   - Active/inactive status

3. **Order Management**
   - Quản lý đơn hàng
   - Thông tin khách hàng
   - Trạng thái đơn hàng và thanh toán
   - Order number tự động

4. **User Management**
   - Admin users với Filament authentication
   - User roles và permissions

## Technical Stack
- **Backend**: Laravel 12.x
- **Admin Interface**: Filament 3.3
- **Database**: MySQL
- **Development Tools**: Composer, Artisan CLI
- **Frontend**: Blade templates (for future public website)

## Project Goals
- Tạo một hệ thống quản lý bán hàng hoàn chính
- Giao diện admin đẹp và dễ sử dụng
- Cấu trúc code clean và maintainable
- Có thể mở rộng thêm tính năng trong tương lai
- Hỗ trợ đa ngôn ngữ (Vietnamese)
