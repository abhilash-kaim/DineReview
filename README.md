<p align="center">
  <img src="assets/DineReview_Logo.png" alt="DineReview Logo" width="300">
</p>

<h1 align="center">DineReview</h1>

<p align="center">
  <strong>Discover, Review & Reserve — Your Complete Dining Companion</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/XAMPP-FB7A24?logo=xampp&logoColor=white" alt="XAMPP">
</p>

---

## 📖 About

**DineReview** is a full-stack web application that empowers diners to discover restaurants, read and write authentic reviews, and make table reservations — all from a single, intuitive platform. Built with **PHP**, **MySQL**, and **Bootstrap 5**, it delivers a responsive, modern dining experience.

> *"Finding and booking a table should be as enjoyable as the meal itself."*

---

## ✨ Features

| Feature | Description |
|---|---|
| 🔐 **User Authentication** | Register, log in, and manage your profile with session-based authentication and cookies |
| 🍽️ **Restaurant Discovery** | Browse Dublin-based restaurants with live average ratings and review counts |
| ⭐ **Reviews & Ratings** | Submit, edit, and delete reviews with a star-rating system |
| 📅 **Table Reservations** | Book tables by selecting date, time, and number of guests |
| 📰 **Blog / Culinary Compass** | Read curated articles on dining trends, hidden gems, and chef interviews |
| 📬 **Newsletter Sign-Up** | Subscribe to receive the latest dining offers and restaurant trends |
| 👤 **User Profiles** | View and update your personal profile information |
| 📋 **Reservation Management** | View, edit, and cancel your existing reservations |
| 💼 **Careers / Positions** | Browse open job positions at DineReview |
| 📞 **Contact Us** | Reach out via a contact form for feedback or inquiries |

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| **Frontend** | HTML5, CSS3, Bootstrap 5.3, Bootstrap Icons |
| **Backend** | PHP 8.x |
| **Database** | MySQL (via MySQLi with Prepared Statements) |
| **Server** | XAMPP (Apache + MySQL) |
| **Session Management** | PHP Sessions + Cookies |

---

## 📁 Project Structure

```
DineReview/
│
├── assets/                     # Images, logos, and team photos
│   ├── DineReview_Logo.png
│   ├── Home.png
│   └── ...
│
├── auth/                       # Authentication handlers
│   ├── login.php               # Processes user login
│   ├── register.php            # Processes user registration
│   └── logout.php              # Destroys session and logs out
│
├── config/                     # Database configuration
│   ├── db.example.php          # Example DB config (users/reservations)
│   └── db_reviews.example.php  # Example DB config (reviews)
│
├── newsletter/                 # Newsletter subscription
│   ├── newsletter_signup.php
│   └── signup.php
│
├── reservation/                # Reservation management
│   ├── edit_reservation.php
│   └── delete_reservation.php
│
├── reviews/                    # Review CRUD operations
│   ├── add_review.php
│   ├── add_review_form.php
│   ├── edit_review.php
│   ├── update_review.php
│   ├── delete_review.php
│   └── fetch_reviews.php
│
├── Style/                      # CSS stylesheets
│   ├── style.css               # Main global styles
│   ├── about.css
│   ├── blog.css
│   └── contact.css
│
├── user/                       # User profile management
│   └── update_profile.php
│
├── index.php                   # Homepage (hero, features, testimonials, team)
├── restaurants.php             # Restaurant listings with ratings
├── reviews.php                 # All reviews page
├── reserve.php                 # Reservation form
├── reservations.php            # User's reservations list
├── profile.php                 # User profile page
├── about.php                   # About Us page
├── blog.php                    # Blog / Culinary Compass
├── contact.php                 # Contact form
├── positions.php               # Careers / Open positions
├── login.html                  # Login form
├── signup.html                 # Registration form
├── dashboard.php               # Dashboard redirect
├── .gitignore                  # Excludes sensitive DB configs
└── README.md                   # You are here
```

---

## 🚀 Getting Started

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) (Apache + MySQL)
- PHP 8.x
- A modern web browser

### Installation

1. **Clone the repository** into your XAMPP `htdocs` directory:

   ```bash
   cd C:/xampp/htdocs
   git clone https://github.com/abhilash-kaim/DineReview.git
   ```

2. **Configure the database connections:**

   Copy the example config files and fill in your credentials:

   ```bash
   cp config/db.example.php config/db.php
   cp config/db_reviews.example.php config/db_reviews.php
   ```

   Edit each file with your MySQL credentials:

   ```php
   <?php
   $host     = "localhost";
   $user     = "root";          // your MySQL username
   $password = "";              // your MySQL password
   $database = "dinereview";    // your database name
   ?>
   ```

3. **Create the MySQL databases and tables:**

   Open **phpMyAdmin** (`http://localhost/phpmyadmin`) and create the required database(s). Then create the following tables:

   **`users` table:**
   ```sql
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100) NOT NULL,
       email VARCHAR(100) UNIQUE NOT NULL,
       password VARCHAR(255) NOT NULL
   );
   ```

   **`reviews` table:**
   ```sql
   CREATE TABLE reviews (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT NOT NULL,
       restaurant_name VARCHAR(150) NOT NULL,
       rating INT NOT NULL,
       review_text TEXT NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

   **`reservations` table:**
   ```sql
   CREATE TABLE reservations (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT NOT NULL,
       restaurant_name VARCHAR(150) NOT NULL,
       reservation_date DATE NOT NULL,
       reservation_time TIME NOT NULL,
       guests INT NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

4. **Start XAMPP** and ensure both **Apache** and **MySQL** are running.

5. **Open the app** in your browser:

   ```
   http://localhost/DineReview/
   ```

---

## 🖥️ Pages Overview

| Page | URL | Description |
|---|---|---|
| **Home** | `index.php` | Hero section, feature cards, customer testimonials, team showcase, and newsletter sign-up |
| **Restaurants** | `restaurants.php` | Accordion-style restaurant listings with live ratings pulled from the database |
| **Reviews** | `reviews.php` | Browse all user-submitted reviews |
| **Reserve** | `reserve.php` | Reservation form (login required) |
| **My Reservations** | `reservations.php` | View, edit, and delete your bookings |
| **Profile** | `profile.php` | View and update your account details |
| **Blog** | `blog.php` | Culinary articles and dining insights |
| **About** | `about.php` | Our vision and mission |
| **Contact** | `contact.php` | Send feedback or inquiries |
| **Careers** | `positions.php` | Open job opportunities |

---

## 👥 Team

| Name | Role |
|---|---|
| **Syed Faiz** | Project Manager |
| **Abhilash Kaim** | Design Lead |
| **Khaja Akrama Jasser** | Lead Data Engineer / Analyst |
| **Nithin Kumar Bomma** | Lead Developer |

---

## 🔒 Security Notes

- Database credentials (`config/db.php`, `config/db_reviews.php`) are excluded from version control via `.gitignore`.
- User authentication is handled through PHP sessions and cookies.
- SQL injection is mitigated using **MySQLi prepared statements** across all database queries.
- Output is sanitized with `htmlspecialchars()` to prevent XSS attacks.

---

## 📄 License

This project was developed as part of the **SEWA (Software Engineering for Web Applications)** module at **Griffith College Dublin**.

© 2025 DineReview. All rights reserved.
