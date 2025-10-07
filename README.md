# Customer Management System

A comprehensive customer relationship management (CRM) system built with Laravel, designed to help businesses manage their customer interactions, track conversations, and maintain customer data efficiently.

## Features

- **Customer Management**
  - Create, view, edit, and delete customer records
  - Track customer details including contact information and status
  - View customer activity and history

- **Conversation Tracking**
  - Record and manage customer interactions
  - Track conversation history and notes
  - Associate conversations with specific customers

- **User Authentication**
  - Secure login and registration system
  - Password reset functionality
  - Protected routes for authorized users only

- **Responsive Design**
  - Mobile-friendly interface
  - Clean and intuitive user interface

## Tech Stack

- **Backend**: Laravel 12.x
- **Frontend**: Blade Templates, Tailwind CSS
- **Database**: MySQL
- **Authentication**: Laravel Breeze

## Project Flow

1. **Authentication Flow**
   - Users can register a new account or log in with existing credentials
   - After successful authentication, users are redirected to the customers dashboard
   - Unauthenticated users are redirected to the login page

2. **Customer Management**
   - View all customers in a paginated list
   - Add new customers with relevant details
   - Edit existing customer information
   - Delete customers when needed
   - View detailed customer profiles

3. **Conversation Management**
   - Add new conversations related to specific customers
   - View conversation history
   - Track important customer interactions

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/customer-management-system.git
   cd customer-management-system
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure Database**
   - Create a MySQL database
   - Update `.env` file with your database credentials

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Start the Development Server**
   ```bash
   php artisan serve
   ```

8. **Access the Application**
   Open your browser and visit: `http://localhost:8000`

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-source and available under the [MIT License](LICENSE).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
