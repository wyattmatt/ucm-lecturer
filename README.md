# UCM Management System

A comprehensive web application for managing university lecturers, events, and administrative users. Built with Laravel 12 and Tailwind CSS, this system provides a public-facing directory of lecturers and upcoming events, along with a secure admin panel for content management.

## Features

### Public Features

-   **Lecturer Directory**: Browse and search through university lecturers with their profiles, including photos, titles, room numbers, and department affiliations
-   **Events Calendar**: View upcoming university events with detailed information (title, description, dates, times, and images)
-   **Real-time Updates**: Automatic polling for new data without page refresh
-   **Responsive Design**: Mobile-friendly interface built with Tailwind CSS

### Admin Features

-   **Dashboard**: Overview statistics showing total events, upcoming events, lecturers, and users
-   **Lecturer Management**: Full CRUD operations for lecturer profiles
    -   Add/edit/delete lecturers
    -   Upload and manage lecturer photos
    -   Manage multiple department affiliations
-   **Event Management**: Complete event lifecycle management
    -   Create and schedule events with date/time ranges
    -   Upload event images
    -   Track modification history
-   **User Management**: Manage admin users and roles
-   **Session-based Authentication**: Secure login system with role-based access control

### API Endpoints

-   Public API for lecturers and events data
-   Protected API endpoints for authenticated operations
-   RESTful resource controllers

## Tech Stack

-   **Backend**: Laravel 12 (PHP 8.2+)
-   **Frontend**: Tailwind CSS 4.0, Vite, Axios
-   **Database**: SQLite (default) / MySQL / PostgreSQL
-   **Authentication**: Laravel's built-in authentication
-   **Asset Pipeline**: Vite with Laravel integration

## Requirements

-   PHP 8.2 or higher
-   Composer
-   Node.js 18+ and npm
-   SQLite extension (or MySQL/PostgreSQL)

## Installation

### Quick Setup

The project includes a convenient setup script:

```bash
composer setup
```

This command will:

1. Install PHP dependencies
2. Create `.env` file from `.env.example`
3. Generate application key
4. Run database migrations
5. Install Node.js dependencies
6. Build frontend assets

### Manual Setup

If you prefer to set up manually:

1. **Clone the repository**

    ```bash
    git clone https://github.com/wyattmatt/ucm-lecturer.git
    cd ucm-lecturer
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Environment configuration**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Database setup**

    ```bash
    # Create SQLite database (if using SQLite)
    touch database/database.sqlite

    # Run migrations
    php artisan migrate
    ```

5. **Seed the database** (optional)

    ```bash
    php artisan db:seed
    ```

    This creates default admin users:

    - **Super Admin**: superadmin@gmail.com / superadmin
    - **Admin**: admin@gmail.com / admin

6. **Install Node.js dependencies and build assets**
    ```bash
    npm install
    npm run build
    ```

## Development

### Running the Development Server

Use the convenient dev script that starts all necessary services:

```bash
composer dev
```

This command runs:

-   Laravel development server (http://localhost:8000)
-   Queue worker
-   Log viewer (Laravel Pail)
-   Vite dev server (for hot module replacement)

### Manual Development Commands

Alternatively, run services individually:

```bash
# Start Laravel server
php artisan serve

# Watch and compile assets
npm run dev

# Run queue worker (if needed)
php artisan queue:listen
```

## Database Structure

### Tables

**lecturers**

-   `id`: Primary key
-   `name`: Lecturer's full name
-   `title`: Academic title/position
-   `room`: Office/room number
-   `departments`: JSON array of department affiliations
-   `image`: Lecturer photo filename
-   `timestamps`: Created and updated timestamps

**events**

-   `id`: Primary key
-   `title`: Event title
-   `image`: Event image filename
-   `description`: Event description (text)
-   `start_date` / `start_time`: Event start datetime
-   `end_date` / `end_time`: Event end datetime
-   `modified_by`: Foreign key to users table
-   `timestamps`: Created and updated timestamps

**users**

-   `id`: Primary key
-   `name`: User's full name
-   `email`: Login email (unique)
-   `password`: Hashed password
-   `role`: User role (admin, superadmin)
-   `remember_token`: For "remember me" functionality
-   `timestamps`: Created and updated timestamps

## File Upload Structure

Images are stored in the `public/images/` directory:

-   `public/images/lecturers/`: Lecturer profile photos
-   `public/images/events/`: Event images
-   `public/images/building/`: Building/location photos

Image filenames are automatically generated based on the lecturer name or event title (sanitized, lowercase, with underscores).

## Routes

### Web Routes

-   `GET /` - Public lecturer directory
-   `GET /login` - Login page
-   `POST /login` - Handle login
-   `POST /logout` - Handle logout

### Admin Routes (Protected)

-   `GET /admin/dashboard` - Admin dashboard
-   `GET /admin/events` - Events management
-   `GET /admin/lecturers` - Lecturers management
-   `GET /admin/users` - Users management

### API Routes

-   `GET /api/public/events` - Get all events (public)
-   `GET /api/public/lecturers` - Get all lecturers (public)
-   `GET /api/public/data` - Get both lecturers and events (public)
-   Protected API resources for authenticated operations:
    -   `/api/events` - Event CRUD operations
    -   `/api/lecturers` - Lecturer CRUD operations
    -   `/api/users` - User CRUD operations

## Testing

Run the test suite:

```bash
composer test
```

Or manually:

```bash
php artisan test
```

## Artisan Commands

### Custom Commands

**List Lecturer Images**

```bash
php artisan lecturers:list-images
```

Lists all lecturer images in the public directory.

## Configuration

### Database

Edit `.env` to configure your database:

```env
DB_CONNECTION=sqlite  # or mysql, pgsql
```

### Session and Cache

The application uses database-backed sessions and cache by default:

```env
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

## Production Deployment

1. Set environment to production in `.env`:

    ```env
    APP_ENV=production
    APP_DEBUG=false
    ```

2. Optimize the application:

    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    composer install --optimize-autoloader --no-dev
    ```

3. Build production assets:

    ```bash
    npm run build
    ```

4. Set proper permissions:
    ```bash
    chmod -R 755 storage bootstrap/cache
    ```

## Security

-   All admin routes are protected by authentication middleware
-   Passwords are hashed using Laravel's bcrypt implementation
-   CSRF protection enabled on all forms
-   File upload validation for images
-   Session-based authentication with secure token regeneration

## License

This project is open-sourced software licensed under the [MIT license](https://github.com/wyattmatt/ucm-lecturer/blob/docs/LICENSE).
