# HR Leave Management System

A modern HR Leave Management System built with **Laravel 12** that allows employees to submit leave requests and enables HR administrators to review, approve, or reject them while automatically managing leave balances.

---

## Features

### Employee Panel

- Secure Authentication
- Dashboard Overview
- View Annual Leave Allowance
- View Remaining Leave Balance
- Submit Leave Requests
- Request History
- Filter Requests by Status
- Responsive Dashboard

### Admin Panel

- Dashboard Overview
- View All Leave Requests
- Search Leave Requests
- Filter Requests
- Approve / Reject Requests
- Employee Management
- Update Employee Leave Balance
- Automatic Leave Balance Deduction After Approval

---

## Built With

- Laravel 12
- PHP 8.2
- MySQL
- Blade
- Tailwind CSS
- Laravel Breeze
- Service Layer Architecture
- Form Request Validation

---

## Project Structure

```
app
├── Http
│   ├── Controllers
│   ├── Middleware
│   └── Requests
├── Models
├── Services
└── Providers

resources
├── views
│   ├── admin
│   ├── employee
│   ├── auth
│   └── components
```

---

## Database

### Users

| Column | Description |
|---------|-------------|
| name | Employee Name |
| email | Email Address |
| password | Password |
| role | admin / employee |
| annual_leave_allowance | Total Annual Leave |
| annual_leave_balance | Remaining Leave |

### Leave Requests

| Column | Description |
|---------|-------------|
| user_id | Employee |
| start_date | Leave Start |
| end_date | Leave End |
| days | Total Days |
| reason | Leave Reason |
| status | pending / approved / rejected |

---

## Business Logic

### Employee

- Submit Leave Request
- Cannot request more than remaining balance
- View request history
- Track request status

### Admin

- Review all requests
- Search requests
- Filter requests
- Approve requests
- Reject requests
- Update employee leave allowance

When a request is approved:

- Leave status changes to **Approved**
- Employee remaining balance is updated automatically

---

## Installation

Clone the project

```bash
git clone https://github.com/ezzsoliman772/hr-management-system.git
```

Install dependencies

```bash
composer install
```

```bash
npm install
```

Create environment file

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Configure database inside

```
.env
```

Run migrations

```bash
php artisan migrate
```

Start server

```bash
php artisan serve
```

---

## Screenshots

### Login

(Add screenshot)

### Employee Dashboard

(Add screenshot)

### Submit Leave Request

(Add screenshot)

### Request History

(Add screenshot)

### Admin Dashboard

(Add screenshot)

### Employee Management

(Add screenshot)

---

## Future Improvements

- REST API
- Swagger Documentation
- Email Notifications
- Leave Types
- Calendar Integration
- Unit Tests
- Docker Support

---

## Author

**Ezz Soliman**

Laravel Backend Developer

GitHub:
https://github.com/ezzsoliman772
