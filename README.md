# Leona Trans

Leona Trans is a web-based car rental management system built with Laravel 12 and MySQL. The application is designed to simplify vehicle rental operations, booking management, payment verification, rental tracking, and business reporting through a centralized administrative dashboard.

## Overview

The system provides a streamlined rental workflow where customers can browse available vehicles, submit booking requests, communicate through WhatsApp, and complete payments. Administrators can manage vehicles, verify payments, monitor rental status, and track business performance.

## Features

### Public Features

* Browse available vehicles
* View vehicle details and specifications
* Submit rental booking requests
* WhatsApp integration for customer communication

### Administration Features

* Secure authentication system
* Vehicle management (CRUD)
* Vehicle gallery management
* Booking management
* Payment verification
* Rental lifecycle management
* Rental history tracking
* Revenue and profit reporting

## Rental Workflow

1. Customer visits the website
2. Customer browses available vehicles
3. Customer selects a vehicle
4. Customer submits a booking request
5. Customer is redirected to WhatsApp with a pre-filled message
6. Customer completes payment (DP or full payment)
7. Administrator verifies payment
8. Booking status is updated
9. Vehicle rental begins
10. Rental is completed
11. Revenue and profit are recorded

## Technology Stack

### Backend

* Laravel 12
* PHP 8.2+
* MySQL

### Frontend

* Blade Template Engine
* Bootstrap
* Design inspired by Design.MD

### Deployment

* Domainesia Hosting
* Apache / Nginx
* MySQL Database

## Database Structure

Core entities:

* users
* cars
* car_images
* bookings
* payments
* expenses

Relationships:

* One Car has many Car Images
* One Car has many Bookings
* One Car has many Expenses
* One Booking has many Payments
* One Payment is verified by one User

## Installation

Clone the repository:

```bash
git clone https://github.com/yourusername/leona-trans.git
cd leona-trans
```

Install dependencies:

```bash
composer install
```

Create environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure database settings in `.env` and run migrations:

```bash
php artisan migrate
```

Create storage symlink:

```bash
php artisan storage:link
```

Start development server:

```bash
php artisan serve
```

## Development Status

Current progress:

* [x] Project initialization
* [x] Database design
* [x] Migrations
* [x] Models and relationships
* [x] Vehicle management backend
* [x] Vehicle gallery management
* [ ] Booking management
* [ ] Payment management
* [ ] Rental lifecycle
* [ ] Dashboard and reporting
* [ ] Production deployment

## License

This project is developed for Leona Trans and is intended for educational and business purposes.
