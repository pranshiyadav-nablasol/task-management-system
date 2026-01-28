<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



# Task Management System (Laravel)

A secure, multi-user task management application built with Laravel as part of a pre-interview technical assignment.  
Users can register, log in, and manage their personal tasks with full ownership-based authorization.

### Key Features
- User registration, login, logout (with secure password hashing)
- Protected dashboard
- Task CRUD operations:
  - Title (required)
  - Description (optional)
  - Status (Pending / In Progress / Completed)
  - Due Date (optional)
- Users can only view, edit, or delete **their own tasks** (via Laravel Policies)
- Task list with sorting, filtering (by status & search), and pagination
- Bonus: RESTful API for authentication and task management using Laravel Sanctum

### Tech Stack
- PHP 8.x
- Laravel 11.x (compatible with 9+ / 10+)
- MySQL (as required)
- Blade templating + Tailwind CSS (via Laravel Breeze)
- Laravel Sanctum (for token-based API authentication)

## Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/task-management-system.git
   cd task-management-system
2. Install dependencies
Bash
composer install
Install frontend assetsBashnpm install && npm run dev
# For production build use: npm run build
Copy environment fileBashcp .env.example .env
Generate application keyBashphp artisan key:generate
Configure database (see Database Configuration below)
Run migrationsBashphp artisan migrate
(Optional) Seed test data or create users manuallyBashphp artisan tinker
# Or use: php artisan db:seed if you add a seeder
Start the local serverBashphp artisan serve→ Open http://127.0.0.1:8000 in your browser
→ Register a new user and begin managing tasks

Database Configuration
The project uses MySQL as specified in the assignment requirements.

Create a MySQL database:SQLCREATE DATABASE task_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
Update .env with your database credentials:envDB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=(In local development with XAMPP/MAMP, username is usually root and password is empty.)
Clear config cache (if needed):Bashphp artisan config:clear
php artisan cache:clear
Run migrations:Bashphp artisan migrate

Note: For quick local testing, you can temporarily switch to SQLite by setting DB_CONNECTION=sqlite and removing other DB_* lines (file will be created in database/database.sqlite).
<!-- API Endpoints (Bonus) -->
    All API routes are prefixed with /api and use JSON format.
    Authentication

    <!-- POST/api/login -->
    Authenticate and receive access token
    Request Body (JSON):JSON{
    "email": "user@example.com",
    "password": "password"
    }Responses:
    200 OK → token and user data
    422 Unprocessable Entity → validation errors
    401 Unauthorized → invalid credentials

    <!-- POST/api/logout (authenticated) -->
    Revoke current token
    Headers: Authorization: Bearer {token}Response: 200 OK

    Tasks (all endpoints require authentication)

    <!-- GET/api/tasks -->
    List all tasks of the authenticated user
    → 200 OK
    POST/api/tasks
    Create a new task
    Request Body (JSON):JSON{
    "title": "Complete assignment",
    "description": "Laravel task manager",
    "status": "Pending",
    "due_date": "2026-02-20"
    }→ 201 Created, 422 (validation fail)
    GET/api/tasks/{id}
    Show a specific task
    → 200 OK, 403 Forbidden (not owner), 404 Not Found
    PUT/api/tasks/{id}
    Update task
    → 200 OK, 403, 422, 404
    DELETE/api/tasks/{id}
    Delete task
    → 204 No Content, 403, 404

    Authentication Header (for all protected routes):
    Authorization: Bearer {your-access-token}
    Security Notes

    Ownership authorization enforced via Laravel Policies — no user can access or modify another user's tasks
    API uses Sanctum personal access tokens
    All input is validated

