# CONTROL_NEXUS — Laravel Portfolio CMS (Laravel 12)

Thank you for purchasing **CONTROL_NEXUS**.

A modern portfolio CMS built with **Laravel 12**, featuring:
- Frontend portfolio website
- Admin panel (Projects + Homepage Settings)
- Fixed homepage sections editable from admin
- Demo content via seeders
- Clean MVC architecture (CodeCanyon-ready)

---

## 1. Server Requirements

- PHP 8.2+
- MySQL 8+ or MariaDB 10.5+
- Composer 2.x
- Node.js 18+ (optional)
- PHP extensions:
  - OpenSSL, PDO, Mbstring, Tokenizer, JSON, Ctype, BCMath, Fileinfo

---

## 2. Installation

### 2.1 Upload Files
Upload the project to your server root or extract locally.

### 2.2 Install Dependencies
```bash
composer install
```

---

## 3. Environment Setup

### 3.1 Create Environment File
```bash
cp .env.example .env
```

### 3.2 Generate App Key
```bash
php artisan key:generate
```

---

## 4. Database Configuration

### 4.1 Create Database
Create a new MySQL database.

### 4.2 Update `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=control_nexus
DB_USERNAME=root
DB_PASSWORD=
```

---

## 5. Migrate & Seed Demo Data

```bash
php artisan migrate --seed
```

This will:
- Create all tables
- Insert demo admin user
- Insert demo projects
- Insert homepage settings (single row: id = 1)

---

## 6. Storage Setup

### 6.1 Create Storage Symlink
```bash
php artisan storage:link
```

### Upload Paths
- Homepage hero image: `storage/app/public/homepage`
- Project images & galleries: `storage/app/public/projects`

---

## 7. Frontend Assets (Optional)

If assets are already built, skip this step.

```bash
npm install
npm run build
```

---

## 8. Admin Login (Demo)

- URL: `/admin`
- Email: `admin@example.com`
- Password: `password`

> Change the password after login.

---

## 9. Admin Panel Usage

### 9.1 Homepage Settings
Menu: **Homepage Settings**

Manage:
- Hero (text, buttons, tags, status, image)
- Services (repeatable)
- Why Choose Me (repeatable)
- Process / Workflow (repeatable)
- Tech Stack (comma-separated)
- Stats Counter (repeatable)
- Testimonials (repeatable)
- FAQ (repeatable)
- CTA sections
- Featured Projects configuration

All homepage content is stored in:
- Table: `home_page_settings`
- Row: `id = 1`

---

### 9.2 Projects
Menu: **Projects**

Features:
- Create / Update projects
- Upload main image & gallery
- Select tech stack (multiple)
- Visibility toggle
- Featured toggle (shown on homepage)

---

## 10. Reset / Re-seed

### Re-seed Homepage Settings Only
```bash
php artisan db:seed --class=HomePageSettingSeeder
```

### Full Reset
```bash
php artisan migrate:fresh --seed
```

---

## 11. Common Issues

### Images Not Showing
```bash
php artisan storage:link
```

### Permission Issues (Linux)
```bash
chmod -R 775 storage bootstrap/cache
```

### 500 / Blank Page
```bash
php artisan config:clear
php artisan cache:clear
```

Check logs:
```bash
storage/logs/laravel.log
```

---

## 12. Security Notes

- Change admin password after first login
- Keep `.env` file private
- Use HTTPS on production

---

## 13. Support

For support, provide:
- PHP version
- Laravel version
- Error logs (`storage/logs/laravel.log`)
- Steps to reproduce the issue

Thank you for using **CONTROL_NEXUS** 🚀
