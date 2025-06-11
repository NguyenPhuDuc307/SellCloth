# Technical Context - SellCloth

## Technologies Used

### Core Framework
- **Laravel 12.x**: Latest LTS version với PHP 8.2+ requirement
- **Filament 3.3**: Modern admin panel with Livewire backend
- **MySQL**: Primary database với full ACID compliance

### Development Dependencies
```json
{
  "php": "^8.2",
  "laravel/framework": "^12.0",
  "filament/filament": "^3.3",
  "laravel/tinker": "^2.10.1"
}
```

### Dev Tools
- **Composer**: Dependency management
- **Laravel Artisan**: CLI commands
- **Laravel Pint**: Code formatting
- **PHPUnit**: Testing framework
- **Faker**: Test data generation

## Development Setup

### Environment Configuration
```env
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sell_cloth
DB_USERNAME=root
DB_PASSWORD=root
```

### Local Development
```bash
# Start development server
php artisan serve  # Runs on http://127.0.0.1:8000

# Admin panel access
http://127.0.0.1:8000/admin
```

### Database Setup
- **Host**: 127.0.0.1:3306
- **Database**: sell_cloth
- **Credentials**: root/root
- **Charset**: utf8mb4
- **Collation**: utf8mb4_unicode_ci

## Technical Constraints

### Performance Considerations
- JSON fields cho arrays (efficient storage, moderate query performance)
- No caching layer yet (future consideration)
- Single database connection (suitable for small-medium scale)

### Scalability Limitations
- No CDN integration for images
- No search optimization (basic SQL LIKE queries)
- No Redis/queue system (synchronous processing)

### Browser Support
- Modern browsers only (ES6+ support required for Filament)
- Mobile responsive admin interface

## Dependencies Architecture

### Filament Integration
- Extends default Laravel authentication
- Uses Livewire for reactive UI components
- AlpineJS for frontend interactions
- TailwindCSS for styling

### File Structure Integration
```
app/Filament/
├── Resources/           # CRUD interfaces
│   ├── CategoryResource.php
│   ├── ProductResource.php
│   └── OrderResource.php
```

## Future Technical Considerations
- **Image Storage**: Move to cloud storage (AWS S3, etc.)
- **Search**: Implement Elasticsearch/Algolia
- **Caching**: Add Redis for session và query caching
- **Queue System**: Async processing for emails, notifications
- **API**: REST API cho mobile app hoặc third-party integrations
