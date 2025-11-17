# Book Review Application

A Laravel-based book review application that allows users to review books and manage their reading lists.

## About

This application is built with Laravel and provides functionality for:
- Managing books
- Creating and managing book reviews
- User authentication and management

## Architecture

The application follows Laravel's MVC architecture. For a detailed view of the request flow, see the [Request Flow Diagram](docs/diagrams/book-review-request-flow.mmd).

## Getting Started

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js and npm
- SQLite (or MySQL/PostgreSQL)

### Installation

1. Clone the repository
2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install Node.js dependencies:
   ```bash
   npm install
   ```

4. Copy the environment file:
   ```bash
   cp .env.example .env
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations:
   ```bash
   php artisan migrate
   ```

7. (Optional) Seed the database:
   ```bash
   php artisan db:seed
   ```

### Development

Start the development server:
```bash
php artisan serve
```

In another terminal, start Vite for asset compilation:
```bash
npm run dev
```

## Documentation

- [Request Flow Diagram](docs/diagrams/book-review-request-flow.mmd) - Visual representation of the application's request flow

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
