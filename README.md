# 🛍️ prelovedU

> **A modern, sustainable marketplace for buying and selling pre-loved items**

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Built with Laravel](https://img.shields.io/badge/Built_with-Laravel%2012-FF2D20.svg)](https://laravel.com)
[![Built with Vite](https://img.shields.io/badge/Built_with-Vite-646CFF.svg)](https://vitejs.dev)
[![PHP Version](https://img.shields.io/badge/PHP-%5E8.2-777BB4.svg)](https://www.php.net/)

---

## 🌟 About prelovedU

**prelovedU** is a user-friendly e-commerce platform designed to promote sustainable consumption by enabling individuals to buy and sell pre-loved (second-hand) items with confidence. Whether you're looking to declutter your closet, find great deals, or contribute to a circular economy, prelovedU makes it simple.

### Why prelovedU?
- 🌱 **Sustainable**: Extend the life of items and reduce waste
- 💰 **Affordable**: Buy quality items at fraction of retail price
- 🔒 **Secure**: Safe transactions with buyer & seller protection
- 🚀 **Fast**: List items and connect with buyers instantly
- 👥 **Community-Driven**: Join thousands of conscious shoppers

---

## ✨ Key Features

- **User Authentication**: Secure registration and login with Sanctum
- **Product Listings**: Easy-to-create product posts with images and descriptions
- **Search & Filter**: Advanced search capabilities to find exactly what you need
- **Messaging System**: Direct communication between buyers and sellers
- **Ratings & Reviews**: Build trust through user feedback and reviews
- **Category Management**: Organized product categories
- **Responsive Design**: Works seamlessly on desktop, tablet, and mobile
- **Modern UI**: Built with Tailwind CSS for a beautiful experience
- **Real-time Updates**: Queue-based notifications for activity updates

---

## 🛠️ Tech Stack

### Backend
- **Framework**: [Laravel 12](https://laravel.com/) - Elegant PHP web framework
- **Authentication**: [Laravel Sanctum](https://laravel.com/docs/sanctum) - Token-based API auth
- **Database**: SQLite (development) / MySQL (production)
- **Queue**: Database-driven job queue
- **Cache**: Database-driven caching
- **Mail**: Log-based (configurable for SMTP/Mailgun)

### Frontend
- **Build Tool**: [Vite 7](https://vitejs.dev/) - Next generation bundler
- **Styling**: [Tailwind CSS 4](https://tailwindcss.com/) - Utility-first CSS
- **JavaScript**: ES6 modules with Axios for HTTP
- **Template Engine**: Blade (Laravel)

### Development Tools
- **Testing**: PHPUnit for backend testing
- **Code Quality**: Laravel Pint for PHP code style
- **Linting**: Concurrently for running multiple commands
- **Local Development**: Laravel Sail (Docker integration)

---

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- **PHP** 8.2 or higher
- **Composer** (for PHP dependencies)
- **Node.js** 16+ and **npm** (for frontend)
- **Git** (for version control)
- **SQLite** or **MySQL** (database)

### Optional
- **Docker** (recommended for consistent development environment)
- **Laravel Sail** (Docker wrapper for Laravel)

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/Adeliaswa/prelovedU.git
cd prelovedU
```

### 2. Install Dependencies

#### Using Composer Script (Recommended)
```bash
composer run setup
```

This will automatically:
- Install PHP dependencies
- Create `.env` file
- Generate application key
- Run database migrations
- Install Node dependencies
- Build frontend assets

#### Or Manual Setup

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Create environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Build frontend assets
npm run build
```

### 3. Configure Environment

Edit `.env` file with your configuration:

```env
APP_NAME=prelovedU
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database (SQLite for development)
DB_CONNECTION=sqlite

# Or use MySQL
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=prelovedU
# DB_USERNAME=root
# DB_PASSWORD=
```

### 4. Start Development Server

```bash
# Run all services concurrently (recommended)
composer run dev
```

This starts:
- PHP development server (port 8000)
- Laravel queue listener
- Laravel Pail (log viewer)
- Vite dev server (auto-rebuilds assets)

Or run individually:

```bash
# Terminal 1 - PHP server
php artisan serve

# Terminal 2 - Queue listener
php artisan queue:listen

# Terminal 3 - Vite dev server
npm run dev
```

### 5. Access the Application

Open your browser and navigate to:
- **Application**: [http://localhost:8000](http://localhost:8000)
- **Log Viewer**: Available in Laravel Pail output

---

## 📦 Available Commands

### Backend Commands

```bash
# Run tests
composer run test

# Code quality check
./vendor/bin/pint

# Database reset (development only)
php artisan migrate:refresh

# View logs in real-time
php artisan pail

# Create new migration
php artisan make:migration create_table_name

# Seed database
php artisan db:seed
```

### Frontend Commands

```bash
# Build assets for production
npm run build

# Watch and rebuild on changes
npm run dev
```

---

## 📁 Project Structure

```
prelovedU/
├── app/                 # Application code
│   ├── Models/         # Database models
│   ├── Http/           # Controllers and requests
│   └── Jobs/           # Queued jobs
├── resources/          # Frontend assets
│   ├── views/          # Blade templates
│   ├── css/            # Tailwind styles
│   └── js/             # JavaScript modules
├── routes/             # API and web routes
├── database/           # Migrations and seeds
├── config/             # Application configuration
├── storage/            # File uploads and logs
├── public/             # Web server root
├── tests/              # Test suites
└── vite.config.js      # Vite configuration
```

---

## 🔐 Authentication

prelovedU uses **Laravel Sanctum** for token-based API authentication:

- Users receive unique API tokens upon login
- Tokens are required for authenticated endpoints
- Sessions are managed securely with database storage
- CSRF protection enabled for form submissions

### Sample Authentication Flow

```bash
# Register
POST /register
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123"
}

# Login
POST /login
{
  "email": "john@example.com",
  "password": "password123"
}

# Response includes auth token
{
  "token": "abc123xyz...",
  "user": { ... }
}
```

---

## 🧪 Testing

Run the test suite:

```bash
composer run test
```

Write tests in the `tests/` directory:

```php
// tests/Feature/ProductTest.php
test('users can list products', function () {
    $response = $this->get('/api/products');
    $response->assertStatus(200);
});
```

---

## 📊 Database

### Migrations

Create and run database migrations:

```bash
# Create new migration
php artisan make:migration create_products_table

# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback
```

### Seeding

Populate database with sample data:

```bash
# Run all seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=ProductSeeder
```

---

## 🚢 Deployment

### Prepare for Production

```bash
# Set environment to production
APP_ENV=production
APP_DEBUG=false

# Generate optimized autoloader
composer install --optimize-autoloader --no-dev

# Clear application cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Build frontend assets for production
npm run build
```

### Hosting Requirements

- PHP 8.2+ with required extensions
- Composer installed
- Database (MySQL recommended)
- Web server (Nginx/Apache)
- HTTPS enabled
- SSH access for deployment

### Popular Hosting Options

- [Laravel Forge](https://forge.laravel.com/) - Recommended for Laravel
- [Vercel](https://vercel.com/)
- [Heroku](https://www.heroku.com/)
- [DigitalOcean](https://www.digitalocean.com/)
- [AWS](https://aws.amazon.com/)

---

## 🤝 Contributing

We welcome contributions! Here's how you can help:

1. **Fork** the repository
2. **Create** a feature branch (`git checkout -b feature/amazing-feature`)
3. **Make** your changes
4. **Commit** your changes (`git commit -m 'Add amazing feature'`)
5. **Push** to the branch (`git push origin feature/amazing-feature`)
6. **Open** a Pull Request

### Development Guidelines

- Follow PSR-12 coding standards (checked with Pint)
- Write tests for new features
- Update documentation as needed
- Keep commits atomic and well-described
- Be respectful and constructive in reviews

---

## 🐛 Bug Reports

Found a bug? Please help us by reporting it:

1. Check if the issue already exists
2. [Create a new issue](https://github.com/Adeliaswa/prelovedU/issues/new)
3. Include:
   - Clear description
   - Steps to reproduce
   - Expected vs actual behavior
   - PHP/Node versions
   - Screenshots if applicable

---

## 📝 License

This project is open-source software licensed under the [MIT License](LICENSE).

You are free to use, modify, and distribute this project as long as you include the license notice.

---

## 💬 Support & Community

- 📖 **Documentation**: Check the [Wiki](https://github.com/Adeliaswa/prelovedU/wiki)
- 💡 **Discussions**: Join our [GitHub Discussions](https://github.com/Adeliaswa/prelovedU/discussions)
- 🐛 **Issues**: [Report bugs here](https://github.com/Adeliaswa/prelovedU/issues)
- 📧 **Contact**: Reach out via GitHub issues

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com/) - Amazing PHP framework
- [Tailwind CSS](https://tailwindcss.com/) - Utility-first CSS framework
- [Vite](https://vitejs.dev/) - Lightning-fast frontend tooling
- Our amazing contributors and community

---

## 📈 Roadmap

Future features we're planning:

- [ ] Advanced search with filters (price, condition, location)
- [ ] Wishlist functionality
- [ ] Social features (follow sellers, share items)
- [ ] Payment integration (Stripe, PayPal)
- [ ] Shipping integration (automatic labels)
- [ ] Mobile app (React Native)
- [ ] AI-powered recommendations
- [ ] Analytics dashboard for sellers
- [ ] Multi-language support
- [ ] Admin panel

Have a feature request? [Let us know!](https://github.com/Adeliaswa/prelovedU/discussions)

---

## 📞 Quick Links

- [GitHub Repository](https://github.com/Adeliaswa/prelovedU)
- [Issues Tracker](https://github.com/Adeliaswa/prelovedU/issues)
- [Discussions](https://github.com/Adeliaswa/prelovedU/discussions)
- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Docs](https://tailwindcss.com/docs)

---

<div align="center">

**Made with ❤️ by the prelovedU community**

If you find this project helpful, please consider giving it a ⭐

</div>
