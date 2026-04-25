# cPanel Deployment Guide — Khademul Islam Portfolio

> Last updated: 2026-04-25 | Build verified ✅ | DB exported ✅

---

## Pre-Flight Checklist (Do On Your Local Machine First)

- [x] `npm run build` — production assets built inside `public/build/`
- [x] `portfolio_export.sql` — database dump created in project root
- [x] All bugs fixed (milestone toggle, gallery images, blog link, section visibility)
- [x] `public/hot` file **deleted** — ⚠️ CRITICAL: this file is created by `npm run dev` and tells Laravel to load assets from `localhost:5173`. If uploaded to cPanel, ALL JavaScript breaks (hero, skills, milestones stay invisible)
- [ ] Set `APP_DEBUG=false` and `APP_ENV=production` in `.env` before uploading

---

## Deployment Architecture (The "Split Method")

Your Laravel app must NEVER be placed entirely inside `public_html`.
The secure structure is:

```
/home/username/
  ├── portfolio_core/      ← Backend code (entire portfolio folder, minus node_modules/.git)
  └── public_html/         ← Only the contents of portfolio/public/ go here
```

---

## Step 1 — Prepare a ZIP for Upload

On your Windows machine, create a ZIP of the `portfolio` folder.
**Exclude** these folders to keep the ZIP small:
- `node_modules/`
- `.git/`
- `home.html` (temp file)

The `portfolio_export.sql` file in the root is your database — keep it.

---

## Step 2 — Upload Backend to cPanel

1. Log in to **cPanel → File Manager**
2. Navigate to your **home directory** (e.g., `/home/yourusername/`) — NOT inside `public_html`
3. Upload your ZIP file here and **Extract** it
4. Rename the extracted folder to: **`portfolio_core`**

---

## Step 3 — Deploy Public Files

Inside `portfolio_core/public/`, move ALL contents into your `public_html/`:
- `public/build/` → `public_html/build/`
- `public/storage/` → `public_html/storage/` (contains uploaded images)
- `public/index.php` → `public_html/index.php` (delete and replace with cpanel version)
- `public/cpanel_index.php` → rename to `index.php` in `public_html/`
- `public/.htaccess` → `public_html/.htaccess`
- `public/favicon.ico` → `public_html/favicon.ico`
- `public/robots.txt` → `public_html/robots.txt`

> **Important:** Delete the original `index.php` in `public_html`, then rename `cpanel_index.php` to `index.php`.

---

## Step 4 — Configure the cPanel Index File

Open `public_html/index.php` and verify/set:

```php
$core_folder = 'portfolio_core';  // must match the folder name from Step 2
```

---

## Step 5 — Database Setup

1. In cPanel → **MySQL® Databases**, create a new database (e.g., `yourusername_portfolio`)
2. Create a new database user with a strong password
3. Add the user to the database with **All Privileges**
4. Go to **phpMyAdmin** → select your new database → click **Import**
5. Import `portfolio_core/portfolio_export.sql`

---

## Step 6 — Configure `.env` for Production

Edit `/home/yourusername/portfolio_core/.env`:

```env
APP_NAME="Khademul Islam"
APP_ENV=production
APP_KEY=base64:EWz/PHwD57ycsLq1fbtzqsK4SPru1FajwHOUGmLFdG0=
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yourusername_portfolio
DB_USERNAME=yourusername_dbuser
DB_PASSWORD=your_strong_password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

> Leave `APP_KEY` as-is — it's already generated and tied to your session encryption.

---

## Step 7 — Fix Storage Symlink on Server

SSH into your server (or use cPanel Terminal) and run:

```bash
cd /home/yourusername/portfolio_core
php artisan storage:link
```

If you can't SSH, manually create a symlink in `public_html`:
- `public_html/storage` → `/home/yourusername/portfolio_core/storage/app/public`

Or just **copy** the contents of `portfolio_core/storage/app/public/` into `public_html/storage/`.

---

## Step 8 — Run Laravel Optimizations

Via SSH or cPanel Terminal:

```bash
cd /home/yourusername/portfolio_core
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## Step 9 — Set File Permissions

Ensure these directories are writable by the web server:

```bash
chmod -R 775 storage bootstrap/cache
```

---

## Step 10 — Verify Your Live Site

- **Homepage**: `https://yourdomain.com` — all sections visible
- **Admin Panel**: `https://yourdomain.com/admin` — login works
- **Project Page**: `https://yourdomain.com/projects/website-devolopment`
- **Blog Post**: `https://yourdomain.com/blog/learning-laravel new feature`
- **Contact Form**: Submit a test message, check Contact Submissions in admin

---

## Troubleshooting

| Problem | Solution |
|---------|----------|
| White screen / 500 error | Set `APP_DEBUG=true` temporarily, check `storage/logs/laravel.log` |
| Images not loading | Ensure `public_html/storage` folder/symlink exists and points correctly |
| "Class not found" errors | Run `composer dump-autoload` via SSH |
| Admin login fails | Run `php artisan cache:clear` |
| CSS/JS 404 | Verify `public_html/build/` folder was uploaded correctly |

---

## Admin Credentials

Your admin account was created during setup. To reset the password:

```bash
php artisan tinker
# Then: App\Models\User::first()->update(['password' => bcrypt('newpassword')]);
```
