# System Patterns - SellCloth Architecture

## Architecture Overview
SellCloth follows Laravel MVC pattern with Filament admin panel integration. The system is designed for simplicity and maintainability.

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   Filament      │    │    Laravel      │    │     MySQL       │
│  Admin Panel    │◄──►│   Application   │◄──►│   Database      │
│                 │    │                 │    │                 │
└─────────────────┘    └─────────────────┘    └─────────────────┘
```

## Key Technical Decisions

### 1. Database Design
- **Normalized structure** với proper foreign keys
- **JSON fields** cho arrays (sizes, colors, images)
- **Soft deletes** không sử dụng (hard delete cho simplicity)
- **Timestamps** trên tất cả tables

### 2. Model Relationships
```php
Category (1) ──► (n) Product
Product (1) ──► (n) OrderItem
Order (1) ──► (n) OrderItem
```

### 3. Data Storage Patterns
- **Images**: JSON array để store multiple image paths
- **Variants**: JSON arrays cho sizes và colors
- **Pricing**: Separate fields cho price và sale_price
- **Status tracking**: Enums cho order status và payment status

## Design Patterns in Use

### 1. Repository Pattern (Implicit via Eloquent)
- Models serve as repositories
- Eloquent relationships handle data access
- No separate repository layer (KISS principle)

### 2. Observer Pattern (Future)
- Event listeners cho order status changes
- Email notifications khi order status thay đổi

### 3. Factory Pattern
- Database seeders để tạo test data
- Consistent data structure across environments

## Component Relationships

### Core Models
1. **Category**
   - Primary entity cho product categorization
   - Has many Products
   - Includes slug cho SEO

2. **Product**
   - Central business entity
   - Belongs to Category
   - Has many OrderItems
   - Complex attributes (images, sizes, colors as JSON)

3. **Order**
   - Transaction entity
   - Has many OrderItems
   - Customer information embedded (no User relationship yet)
   - Auto-generated order numbers

4. **OrderItem**
   - Bridge entity between Order và Product
   - Stores snapshot data (name, price at time of order)
   - Includes variant selection (size, color)

### Filament Resources
- Auto-generated CRUD interfaces
- Custom form layouts for complex fields
- Table views với appropriate filters
- Form validation rules

## Code Organization
```
app/
├── Models/           # Eloquent models
├── Filament/
│   └── Resources/    # Admin interface definitions
database/
├── migrations/       # Database schema
└── seeders/         # Sample data generation
```

## Security Considerations
- Filament authentication cho admin access
- Mass assignment protection với $fillable
- Input validation through Filament forms
- SQL injection protection via Eloquent ORM
