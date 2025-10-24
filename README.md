# Events Management System

A comprehensive event management application built with Laravel 12 and Tailwind CSS. This system allows users to create, manage, and track events with features like event scheduling, capacity management, and status tracking.

## Features

- **Event Management**: Create, read, update, and delete events
- **Event Scheduling**: Set start and end dates/times for events
- **Capacity Tracking**: Monitor event capacity and attendance
- **Status Management**: Track event status (upcoming, ongoing, completed, cancelled)
- **Auto-generated Event Codes**: Unique event codes automatically generated
- **User Authentication**: Secure user login and registration
- **Responsive Design**: Modern UI with Tailwind CSS

## Tech Stack

- **Backend**: Laravel 12 (PHP 8.4)
- **Frontend**: Tailwind CSS v4, Vite
- **Database**: MySQL
- **Authentication**: Laravel Breeze/Sanctum

## Requirements

Before you begin, ensure you have the following installed on your system:

- **PHP**: >= 8.4
- **Composer**: Latest version
- **Node.js**: >= 18.x
- **npm**: >= 9.x
- **MySQL**: >= 8.0 or MariaDB >= 10.3
- **Git**: Latest version

## Installation

Follow these steps to get the application up and running:

### 1. Clone the Repository

```bash
git clone https://github.com/emnv/events.git
cd events
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the `.env.example` file to `.env`:

```bash
# Windows (PowerShell)
copy .env.example .env

# Linux/Mac
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Configure Database

Open the `.env` file and update the database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=events_mgmt_db
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

### 7. Create Database

Create the database in MySQL:

```sql
CREATE DATABASE events_mgmt_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Or use the command line:

```bash
# Windows (if MySQL is in PATH)
mysql -u root -p -e "CREATE DATABASE events_mgmt_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Linux/Mac
mysql -u root -p -e "CREATE DATABASE events_mgmt_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 8. Run Database Migrations

Run the migrations to create the necessary database tables:

```bash
php artisan migrate
```

This will create the following tables:
- `users` - User accounts
- `events` - Event information
- `cache` - Application cache
- `jobs` - Queue jobs
- `sessions` - User sessions

### 9. Seed Database (Optional)

Populate the database with sample data:

```bash
php artisan db:seed
```

This will create:
- A test user with email: `test@example.com` and password: `password`

### 10. Build Frontend Assets

Build the Tailwind CSS and JavaScript assets:

```bash
# For production
npm run build

# For development (with hot reload)
npm run dev
```

## Running the Application

### Development Server

Start the Laravel development server:

```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

If you're using `npm run dev`, open a second terminal and run:

```bash
npm run dev
```

This provides hot module replacement for faster development.

### Access the Application

1. **Home Page**: `http://localhost:8000`
2. **Login**: `http://localhost:8000/login`
3. **Register**: `http://localhost:8000/register`
4. **Events**: `http://localhost:8000/events` (requires authentication)

### Default Test Account

If you ran the seeder:
- **Email**: test@example.com
- **Password**: password

## Common Commands

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Clear All Caches at Once

```bash
php artisan optimize:clear
```

### Run Tests

```bash
php artisan test
```

### Code Formatting

```bash
./vendor/bin/pint
```

### Create New Migration

```bash
php artisan make:migration create_table_name
```

### Create New Model

```bash
php artisan make:model ModelName -mfc
# -m: migration
# -f: factory
# -c: controller
```

## Project Structure

```
events/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── EventController.php
│   └── Models/
│       ├── Event.php
│       └── User.php
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── css/
│   │   └── app.css          # Tailwind CSS
│   ├── js/
│   │   └── app.js
│   └── views/
│       ├── events/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       └── layouts/
│           └── app.blade.php
├── routes/
│   └── web.php
└── tests/
```

## Troubleshooting

### Issue: "Vite manifest not found"

**Solution**: Run `npm run build` or `npm run dev`

### Issue: "Access denied for user"

**Solution**: Check your database credentials in `.env`

### Issue: "Class not found"

**Solution**: Run `composer dump-autoload`

### Issue: Styles not applying

**Solution**: 
1. Make sure Vite is running: `npm run dev`
2. Or build assets: `npm run build`
3. Clear browser cache

### Issue: "No application encryption key has been specified"

**Solution**: Run `php artisan key:generate`

## Development Workflow

1. Start the development server: `php artisan serve`
2. Start Vite for hot reload: `npm run dev`
3. Make your changes
4. Test your changes
5. Run code formatter: `./vendor/bin/pint`
6. Run tests: `php artisan test`
7. Commit your changes

## Deployment

For production deployment:

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Run `composer install --optimize-autoloader --no-dev`
4. Run `npm run build`
5. Run `php artisan config:cache`
6. Run `php artisan route:cache`
7. Run `php artisan view:cache`
8. Set proper file permissions

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
