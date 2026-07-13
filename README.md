# HR Leave Management System

> A modern HR Leave Management System built with **Laravel 12** that streamlines employee leave requests and HR approval workflows.

![Laravel](https://img.shields.io/badge/Laravel-12-red)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4-38BDF8)
![License](https://img.shields.io/badge/License-MIT-green)

---

## 📖 About

This project is a mini HR Leave Management System developed using **Laravel 12** following a clean layered architecture.

It provides two separate dashboards:

- Employee Dashboard
- Admin Dashboard

Employees can submit leave requests and track their status, while administrators can review, approve, reject requests, and manage employee leave balances.

---

# ✨ Features

## 👨‍💼 Employee Panel

- Secure Authentication
- Dashboard Overview
- Annual Leave Balance
- Remaining Leave Balance
- Submit Leave Request
- Request History
- Filter Requests
- Responsive UI

---

## 👨‍💻 Admin Panel

- Dashboard Overview
- View All Leave Requests
- Search Requests
- Filter by Status
- Approve Requests
- Reject Requests
- Employee Management
- Update Employee Leave Balance

---

# 🏗 Project Architecture

The project follows a layered architecture to separate responsibilities.

```
Controller
        │
        ▼
Form Request
        │
        ▼
Service Layer
        │
        ▼
Model
        │
        ▼
Database
```

### Layers

- Controllers
- Form Requests
- Services
- Models
- Blade Components
- Middleware

---

# 📂 Folder Structure

```text
app
├── Http
│   ├── Controllers
│   │   ├── Admin
│   │   ├── Employee
│   │   └── Auth
│   ├── Middleware
│   └── Requests
│
├── Models
├── Services
│
resources
├── views
│   ├── admin
│   ├── employee
│   ├── auth
│   ├── layouts
│   └── components
```

---

# 🗄 Database

## Users

| Column | Description |
|----------|-------------|
| id | User ID |
| name | Employee Name |
| email | Email |
| password | Password |
| role | Admin / Employee |
| annual_leave_allowance | Annual Leave |
| annual_leave_balance | Remaining Balance |

---

## Leave Requests

| Column | Description |
|----------|-------------|
| id | Request ID |
| user_id | Employee |
| start_date | Leave Start |
| end_date | Leave End |
| days | Total Days |
| reason | Leave Reason |
| status | Pending / Approved / Rejected |

---

# 🔄 Business Flow

Employee

```
Login
    ↓
Dashboard
    ↓
Create Leave Request
    ↓
Pending
```

Admin

```
View Requests
      ↓
Approve / Reject
      ↓
Employee Balance Updated
```

---

# 🛠 Tech Stack

- Laravel 12
- PHP 8.2
- MySQL
- Blade
- Tailwind CSS
- Laravel Breeze
- Service Layer Pattern
- Form Request Validation

---

# 📸 Screenshots

## Login

![Login](screenshots/login.png)

---

## Employee Dashboard

![Dashboard](screenshots/employee-dashboard.png)

---

## New Leave Request

![Create](screenshots/new-request.png)

---

## Request History

![History](screenshots/history.png)

---

## Admin Dashboard

![Admin](screenshots/admin-dashboard.png)

---

## Employee Management

![Employees](screenshots/employees.png)

---

# 🚀 Installation

Clone repository

```bash
git clone https://github.com/ezzsoliman772/hr-management-system.git
```

Install packages

```bash
composer install
```

```bash
npm install
```

Copy environment

```bash
cp .env.example .env
```

Generate key

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

Run application

```bash
npm run dev
```

```bash
php artisan serve
```

---

# 👥 Demo Accounts

## Employee

```
Email:
employee@example.com

Password:
password
```

---

## Admin

```
Email:
admin@example.com

Password:
password
```

> Update these credentials according to your seeded database.

---

# 📌 Future Improvements

- REST API
- Swagger Documentation
- Email Notifications
- Leave Types
- Calendar Integration
- Unit Testing
- Docker Support
- CI/CD Pipeline

---

# 👨‍💻 Author

**Ezz Soliman**

Laravel Backend Developer

GitHub:
https://github.com/ezzsoliman772

---

⭐ If you like this project, consider giving it a star.
