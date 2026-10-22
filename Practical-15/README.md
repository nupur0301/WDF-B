# 🎓 StudentHub Portal

A full-stack web-based **Student Management System** developed using **HTML, CSS, JavaScript, PHP, and MySQL**. The portal provides separate interfaces for **Students** and **Administrators**, enabling secure login, student management, event management, event registration, and REST API-based CRUD operations.

---

# 📌 Project Overview

StudentHub Portal is designed to simplify academic and administrative activities within a college environment. Students can access their academic information, register for events, and view their event registrations, while administrators can efficiently manage students and events through a secure dashboard.

---

# 🚀 Features

## 👨‍🎓 Student Module

- Student Registration (Signup)
- Student Login
- Dynamic Student Dashboard
- Dynamic Student Profile
- View Attendance
- View Timetable
- View Academic Performance
- View College Events
- Register for Events
- View My Event Registrations
- Logout

---

## 👨‍💼 Admin Module

- Secure Admin Login
- Admin Dashboard
- Student Management (CRUD)
- Event Management (CRUD)
- Student API CRUD
- Event API CRUD
- Export Students to CSV
- Audit Log Management
- Logout

---

## 🌐 Website Features

- Responsive Design
- Light/Dark Theme Toggle
- Mobile Hamburger Menu
- Notification Banner
- Campus Gallery
- About Page
- Contact Page
- FAQ Section

---

# 🛠 Technologies Used

### Frontend

- HTML5
- CSS3
- JavaScript

### Backend

- PHP

### Database

- MySQL

### Development Environment

- XAMPP
- phpMyAdmin
- Visual Studio Code

---

# 📂 Project Structure

```text
projectfinal/
│
├── api/
│
├── uploads/
│
├── json/
│
├── index.html
├── about.html
├── contact.html
├── attendance.html
├── timetable.html
├── performance.html
├── faq.html
│
├── student_login.php
├── admin_login.php
├── login_process.php
├── logout.php
│
├── signup.php
├── signup_process.php
│
├── dashboard.php
├── admin_dashboard.php
│
├── students.php
├── events.php
├── event_registration.php
├── my_registrations.php
│
├── db.php
├── db_mysqli.php
│
├── style.css
├── dashboard.css
├── index.css
│
└── Images
```

---

# 🗄 Database Tables

The project uses the following MySQL tables:

- users
- students
- events
- registrations
- audit_logs

---

# 🔑 User Roles

## Student

Students can:

- Login securely
- View dashboard
- View profile
- Register for events
- View registered events
- Access attendance
- Access timetable
- Access performance

---

## Admin

Administrators can:

- Login securely
- Manage students
- Manage events
- Perform CRUD operations
- Access REST APIs
- Export student data
- View audit logs

---

# 🔒 Authentication

The project implements:

- Role-Based Authentication
- Secure Password Hashing
- PHP Sessions
- Protected Pages
- Login Validation
- Logout Functionality

---

# 🌐 REST APIs

### Student API

- Add Student
- Update Student
- Delete Student
- List Students

### Event API

- Add Event
- Update Event
- Delete Event
- List Events

---

# 📤 CSV Export

Administrators can export the student database into CSV format.

---

# 📋 Prerequisites

Install the following software before running the project:

- XAMPP
- PHP 8.x or later
- MySQL
- Visual Studio Code (Recommended)

---

# ⚙ Installation

## Step 1

Clone the repository

```bash
git clone https://github.com/yourusername/studenthub-portal.git
```

---

## Step 2

Move the project folder to:

```text
C:\xampp\htdocs\
```

---

## Step 3

Start:

- Apache
- MySQL

from the XAMPP Control Panel.

---

## Step 4

Open phpMyAdmin

```
http://localhost/phpmyadmin
```

---

## Step 5

Create a database:

```text
studenthub
```

---

## Step 6

Import the provided SQL file into the database.

---

## Step 7

Run the project:

```text
http://localhost/projectfinal/
```

---


# 👩‍💻 Developer

**Name:** Nupur Padaria
---


