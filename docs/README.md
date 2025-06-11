# SellCloth - UseCase Documentation

Thư mục này chứa các UseCase diagrams cho hệ thống SellCloth E-commerce được viết bằng PlantUML.

## 📁 Files Overview

### 1. `sellcloth-usecase.puml` - Tổng quan UseCase
**Mô tả**: Diagram tổng quan toàn bộ hệ thống với 3 actors chính
- **Admin**: Quản lý hệ thống thông qua Filament panel
- **Khách hàng**: Người dùng đã đăng ký (future feature)
- **Khách vãng lai**: Người dùng chưa đăng ký (future feature)

**Bao gồm**:
- Admin Management (✅ Đã hoàn thành)
- Customer Features (🚧 Tương lai phát triển)  
- Public Access (🚧 Tương lai phát triển)

### 2. `sellcloth-admin-detailed-usecase.puml` - Chi tiết Admin UseCase
**Mô tả**: Diagram chi tiết cho tất cả chức năng Admin đã được implement

**Packages bao gồm**:
- **Authentication**: Đăng nhập/đăng xuất ✅
- **Dashboard**: Tổng quan hệ thống 🚧
- **Category Management**: Quản lý danh mục ✅
- **Product Management**: Quản lý sản phẩm ✅
- **Order Management**: Quản lý đơn hàng ✅
- **User Management**: Quản lý người dùng ✅
- **Reports & Analytics**: Báo cáo thống kê 🚧

### 3. `sellcloth-customer-usecase.puml` - Customer UseCase (Future)
**Mô tả**: Diagram cho customer experience và shopping workflow

**Packages bao gồm**:
- **Public Access**: Xem sản phẩm không cần đăng nhập 🚧
- **Shopping Cart**: Giỏ hàng và quản lý 🚧
- **User Account**: Đăng ký/đăng nhập customer 🚧
- **Order Process**: Checkout và thanh toán 🚧
- **Order Management**: Theo dõi đơn hàng 🚧
- **Notification**: Email và thông báo 🚧

## 🔧 Cách sử dụng PlantUML files

### Prerequisites
1. **PlantUML extension** cho VS Code: `plantuml.plantuml`
2. **Java Runtime** (required cho PlantUML)
3. **Graphviz** (optional, để render tốt hơn)

### Viewing Diagrams
1. Mở file `.puml` trong VS Code
2. Sử dụng Command Palette: `PlantUML: Preview Current Diagram`
3. Hoặc nhấn `Alt + D` để preview

### Exporting Diagrams
1. Command Palette: `PlantUML: Export Current Diagram`
2. Chọn format: PNG, SVG, PDF
3. File sẽ được xuất cùng thư mục

## 📊 Development Status

### ✅ Completed (Phase 1)
- **Admin Authentication**: Filament login system
- **Category CRUD**: Full management với Vietnamese interface
- **Product CRUD**: Comprehensive product management
- **Order CRUD**: Basic order management
- **User Management**: Admin user creation và management

### 🚧 In Progress / Next Phase
- **Admin Dashboard**: Widgets và statistics
- **Public Website**: Customer-facing interface
- **Shopping Cart**: Session-based cart system
- **Product Catalog**: Category browsing và product listing

### 🎯 Future Features
- **Customer Authentication**: Registration và login system
- **Checkout Process**: Multi-step checkout với payment
- **Order Tracking**: Customer order history và tracking
- **Reviews & Ratings**: Product review system
- **Analytics**: Sales reports và inventory analytics

## 🏗️ Architecture Notes

### Current Implementation
- **Backend**: Laravel 12.x với Filament 3.3 admin panel
- **Database**: MySQL với normalized schema
- **Authentication**: Filament-based admin authentication
- **Data Storage**: JSON fields cho product variants (sizes, colors)

### Planned Architecture
- **Frontend**: Laravel Blade templates với TailwindCSS
- **Session Management**: Laravel sessions cho shopping cart
- **Payment**: Integration với Vietnamese payment gateways
- **Email**: Laravel Mail cho notifications

## 📈 Business Logic Flow

### Admin Workflow
```
Login → Dashboard → Manage (Categories/Products/Orders) → Logout
```

### Customer Workflow (Future)
```
Browse → View Product → Add to Cart → Checkout → Place Order → Track Order
```

### Order Processing Flow
```
Pending → Processing → Shipped → Delivered
         ↓
      Cancelled (any stage)
```

## 🔄 Updates và Maintenance

Khi có thay đổi trong requirements hoặc implementation:

1. **Update diagrams** để reflect changes
2. **Add status notes** (✅, 🚧, 🎯) cho features
3. **Update README** với new information
4. **Export new images** nếu cần thiết

---

**Last Updated**: June 11, 2025  
**Project Phase**: Phase 1 Complete (Admin Panel) → Phase 2 Starting (Frontend)  
**Maintained by**: SellCloth Development Team
