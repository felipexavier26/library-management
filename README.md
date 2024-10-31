# Library Management System

A Library Management System (LMS) is a web application designed to manage library operations efficiently. This application allows users to borrow and return books, while keeping track of their availability and user information.

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Running Tests](#running-tests)
- [Contributing](#contributing)
- [License](#license)

## Features

- User registration and management
- Book borrowing and returning functionality
- Tracking of currently borrowed books
- Responsive user interface

## Technologies Used

- PHP 8.x
- MySQL
- HTML/CSS
- JavaScript (jQuery)
- Bootstrap 4
- PHPUnit for unit testing

## Requirements

- PHP 8.x or higher
- Composer
- MySQL 
- Web server (Apache or Nginx)

## Installation

1. **Clone the repository**:
    ```bash
    git clone https://github.com/felipexavier26/library-management.git
    ```

2. **Navigate to the project directory**:
    ```bash
    cd library-management
    ```

3. **Install dependencies**:
    ```bash
    composer install
    ```

4. **Set up the database**:
    - Create a MySQL database and import the provided SQL scripts located in the `database` directory.

5. **Configure the database connection**:
    - Update the database configuration in the `.env` file or the respective configuration file as per your setup.

## Usage

To start using the Library Management System, open your web browser and navigate to `http://localhost/library-management/public`.

### User Roles
- **Admin**: Can manage users and books.
- **User**: Can borrow and return books.

## Running Tests

To run the unit tests, use the following command:

```bash
vendor/bin/phpunit
