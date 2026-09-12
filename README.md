# AJH Consulting

A PHP + MySQL business/consulting website with a built-in admin panel, built on top of the **Finbiz** HTML template (business consultant theme).

> This work by **[nikhilworks.com](https://nikhilworks.com)**

---

## ✨ Features

- Public website (PHP, MySQL-backed):
  - Home, About Us, Services, Service Details, Team, Portfolio, Pricing, Blog List, Blog Details, Appointment, Contact, 404
  - Services, Team members and Blog posts are all pulled from the database, so they can be managed from the admin panel without touching code
  - Contact form and Appointment form save every submission into the database as a "lead"
- Admin panel (`/admin`) protected by login:
  - Dashboard with quick stats
  - Leads inbox (contact + appointment form submissions) with status tracking (New / Read / Resolved)
  - Blog posts CRUD (with image upload)
  - Team members CRUD (with photo + social links)
  - Services CRUD (with image upload)
- Security basics: CSRF tokens on every form, password hashing (`password_hash`/`password_verify`), prepared statements (PDO) everywhere, `.env` for secrets, `.htaccess` hardening, upload folder locked against script execution.

---

## 🧱 Tech Stack

- PHP 8+ (no framework, no Composer dependency required)
- MySQL / MariaDB (via XAMPP)
- Apache (`.htaccess` powered clean URLs)
- Original template assets: HTML/CSS/JS (Finbiz business-consultant theme)

---

## 📁 Project Structure

```
ajh-accounting/
├── admin/                # Admin panel (login required)
│   ├── includes/         # Shared admin layout (denied from direct access)
│   ├── assets/css/       # Admin panel styling
│   ├── login.php / logout.php
│   ├── index.php         # Dashboard
│   ├── leads.php         # Contact + appointment leads
│   ├── blog.php / blog-form.php
│   ├── team.php / team-form.php
│   └── services.php / services-form.php
├── assets/               # Template CSS/JS/images/fonts
├── config/
│   ├── env.php           # .env loader
│   ├── config.php        # App bootstrap (session, constants, includes)
│   └── database.php      # PDO connection (db())
├── database/
│   ├── schema.sql        # Tables + sample seed data
│   └── seed.php          # Creates the admin account from .env
├── includes/
│   ├── header.php        # Shared <head> + site header/nav
│   ├── footer.php        # Shared footer + scripts
│   └── functions.php     # Helpers: e(), csrf_*, flash_*, uploads, slugify, auth
├── uploads/               # User-uploaded images (git-ignored, script execution blocked)
├── .env.example           # Copy to .env and fill in your values
├── .htaccess               # Clean URLs, security headers, blocks .env/.sql
├── index.php, about-us.php, our-service.php, service-details.php,
│   team.php, project.php, pricing.php, blog-list.php, blog-details.php,
│   contactus.php, appoinment.php, 404.php, newsletter.php
```

---

## 🚀 Setup (local, XAMPP)

1. **Clone into your XAMPP `htdocs`** (or clone directly there):
   ```bash
   git clone https://github.com/nikhilgupta-9/ajh-consulting.git ajh-accounting
   ```

2. **Start Apache + MySQL** from the XAMPP Control Panel.

3. **Create the database & import the schema**, either via phpMyAdmin or CLI:
   ```bash
   mysql -u root -e "CREATE DATABASE ajh_consulting CHARACTER SET utf8mb4;"
   mysql -u root ajh_consulting < database/schema.sql
   ```

4. **Create your `.env` file**:
   ```bash
   cp .env.example .env
   ```
   Edit `.env` and set `DB_USER` / `DB_PASS` to match your MySQL setup (defaults `root` / empty password work for a fresh XAMPP install).

5. **Create the admin login** (reads `ADMIN_EMAIL` / `ADMIN_PASSWORD` from `.env`):
   ```bash
   php database/seed.php
   ```

6. Visit **`http://localhost/ajh-accounting/`** for the site and **`http://localhost/ajh-accounting/admin/login.php`** for the admin panel.

> ⚠️ Change `ADMIN_PASSWORD` in `.env` (and re-run `database/seed.php`) before deploying anywhere public.

---

## 🔐 Environment variables (`.env`)

See [.env.example](.env.example) for the full list — database credentials, admin login, mail settings, business contact info (email/phone/address shown across the site), and the CSRF secret. **Never commit your real `.env` file** — it is already in `.gitignore`.

---

## 🌐 Deploying to a live server

1. Upload everything except `.env`, `uploads/*` (create empty folders with the same names) and any local files ignored by `.gitignore`.
2. Create the database on your host and import `database/schema.sql`.
3. Create `.env` on the server (copy from `.env.example`) with production DB credentials and a strong `ADMIN_PASSWORD` / `CSRF_SECRET`.
4. Run `php database/seed.php` once (via SSH, or temporarily via a browser-accessible script) to create the admin account.
5. Make sure `mod_rewrite`, `mod_headers`, `mod_deflate` and `mod_expires` are enabled on Apache (the root `.htaccess` uses all four).
6. Set `APP_DEBUG=false` and `APP_ENV=production` in `.env`.

---

## 🗒️ Notes

- The site started life as the **Finbiz** business-consultant HTML template; the original template ships with 70+ demo/homepage-style pages (multiple homepage layouts, one-page layouts, and a UI "elements" showcase). Only the pages relevant to a real consulting business were converted to PHP and wired to the database; the rest were removed to keep the codebase focused.
- Secondary/decorative widgets (e.g. the small "team" teaser block on the Appointment page) remain static — only the primary Team, Services and Blog pages are database-driven, matching the admin panel's scope.

---

## 📄 License / Credits

Built for **AJH Consulting**.

This work by **[nikhilworks.com](https://nikhilworks.com)**
