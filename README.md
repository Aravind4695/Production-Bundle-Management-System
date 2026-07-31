# Production Bundle Management System

## Description

The Production Bundle Management System is a Laravel 11 web application developed for apparel manufacturing to manage production bundles efficiently. It provides complete CRUD operations, real-time calculations, dashboard reporting, search, filtering, soft delete, and RESTful APIs.

---

## Features

* Create, View, Edit and Soft Delete Production Bundles
* AJAX-based form submission
* Client-side and Server-side Validation
* Real-time Balance, Efficiency and Rejection calculations
* Search and Filter functionality
* Dashboard with production summary
* RESTful API
* MySQL Database
* Responsive Bootstrap UI

---

## Technology Stack

* PHP 8+
* Laravel 13
* MySQL 
* Bootstrap 5
* jQuery
* AJAX
* Git
* Postman

---

## Prerequisites

* PHP 8+
* Composer
* MySQL
* Node.js & npm
* XAMPP (or any Apache/MySQL server)

---

## Installation

Clone the repository:

```bash
git clone https://github.com/Aravind4695/Production-Bundle-Management-System.git
```

Move into the project folder:

```bash
cd Production-Bundle-Management-System
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
copy .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

---

## Database Setup

1. Create a MySQL database named:

```text
bundle_management_system
```

2. Update the database credentials in the `.env` file.

3. Import the SQL dump:

```text
database/sql/bundle_management_system.sql
```

Alternatively, run migrations and seeders:

```bash
php artisan migrate
php artisan db:seed
```

---

## Run the Application

Start the Laravel development server:

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

---

## API Endpoints

| Method | Endpoint          |
| ------ | ----------------- |
| GET    | /api/bundles      |
| POST   | /api/bundles      |
| GET    | /api/bundles/{id} |
| PUT    | /api/bundles/{id} |
| DELETE | /api/bundles/{id} |
| GET    | /api/dashboard    |

---

## Project Structure

```text
app/
database/
resources/
routes/
public/
```

---

## Author

**Aravind G**

GitHub:
https://github.com/Aravind4695
