# 🚀 Hostinger Deployment Guide for Treasurer System

## Step 1: Prepare Files for Production

### 1.1 Create Production Environment File

Create a new `.env` file for production with these settings:

```env
APP_NAME="Treasurer System"
APP_ENV=production
APP_KEY=base64:P3lHe+QNVrege2xqp/aQ8bX3lt5AjOpYuQYsrQiZEL0=
APP_DEBUG=false
APP_URL=https://mistyrose-dinosaur-546099.hostingersite.com/

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

# Database - Update with your Hostinger database details
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u273881202_treasurer_sys
DB_USERNAME=u273881202_reshzy
DB_PASSWORD=P00pyjo3!

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

# Mail Configuration (update with your Hostinger email settings)
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=your_email@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="treasurer@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"

VITE_APP_NAME="${APP_NAME}"
```

### 1.2 Optimize for Production

Run these commands before uploading:

```bash
# Clear all caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Install production dependencies
composer install --optimize-autoloader --no-dev

# Build assets
npm run build
```

## Step 2: Upload Files to Hostinger

### 2.1 Via File Manager (Recommended for beginners)

1. Log into your Hostinger control panel
2. Go to **File Manager**
3. Navigate to `public_html` folder
4. Upload ALL Laravel files EXCEPT:
    - `node_modules/` folder
    - `.env` file (create new one on server)
    - `storage/logs/` contents
    - `.git/` folder

### 2.2 Via FTP/SFTP

Use FileZilla or similar:

-   Host: your-domain.com
-   Username: your hosting username
-   Password: your hosting password
-   Port: 21 (FTP) or 22 (SFTP)

### 2.3 File Structure on Hostinger

Your files should be organized like this:

```
public_html/
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
├── vendor/
├── public/ (contents go to public_html root)
│   ├── index.php → move to public_html/
│   ├── build/ → move to public_html/build/
│   │   ├── assets/
│   │   │   ├── app-C0G0cght.js
│   │   │   └── app-CFdeTTOB.css
│   │   └── manifest.json
│   ├── favicon.ico → move to public_html/
│   └── .htaccess → move to public_html/
├── composer.json
└── artisan
```

**Important**: The `build/` folder contains your compiled Vite assets and must be moved to `public_html/build/` exactly as is.

## Step 3: Configure Database

### 3.1 Create Database in Hostinger

1. Go to **Databases** → **MySQL Databases**
2. Create new database: `u123456789_treasurer`
3. Create database user with full privileges
4. Note down: database name, username, password

### 3.2 Update .env File

Create `.env` file in your public_html folder with production settings.

## Step 4: Configure Laravel on Server

### 4.1 Update index.php (Important!)

Edit `public_html/index.php` and update paths:

```php
<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
```

### 4.2 Set Proper Permissions

Via SSH or File Manager, set these permissions:

```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env
```

### 4.3 Create .htaccess (if not exists)

Create `.htaccess` in public_html:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On

    # Handle Angular and Laravel routes
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

# Security headers
<IfModule mod_headers.c>
    Header always set X-Frame-Options DENY
    Header always set X-Content-Type-Options nosniff
    Header always set X-XSS-Protection "1; mode=block"
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
</IfModule>

# Hide sensitive files
<Files .env>
    Order allow,deny
    Deny from all
</Files>

<Files composer.json>
    Order allow,deny
    Deny from all
</Files>
```

## Step 5: Run Database Migrations

### 5.1 Via SSH (if available)

```bash
cd public_html
php artisan migrate --force
php artisan db:seed --force
```

### 5.2 Via Web-based Terminal (if no SSH)

Some hosting panels provide web terminals. Use same commands.

### 5.3 Manual Database Import (Alternative)

1. Export your local database
2. Import via phpMyAdmin in Hostinger
3. Update any localhost URLs to your domain

## Step 6: Configure SSL Certificate

### 6.1 Enable SSL in Hostinger

1. Go to **SSL** section in control panel
2. Enable **Free SSL** or upload your certificate
3. Force HTTPS redirect

### 6.2 Update APP_URL

Make sure your `.env` has:

```env
APP_URL=https://yourdomain.com
```

## Step 7: Final Configuration

### 7.1 Clear Caches on Server

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 7.2 Test Your Application

Visit your domain and test:

-   ✅ Homepage loads
-   ✅ Admin dashboard works
-   ✅ Database connections work
-   ✅ SSL certificate is active
-   ✅ Forms work properly

## Step 8: Post-Deployment Security

### 8.1 Secure File Permissions

```bash
find /path/to/your/laravel/root/ -type f -exec chmod 644 {} \;
find /path/to/your/laravel/root/ -type d -exec chmod 755 {} \;
chmod -R 755 storage bootstrap/cache
```

### 8.2 Hide Laravel Files

Add to `.htaccess`:

```apache
# Block access to Laravel files
<FilesMatch "^(artisan|composer\.(json|lock)|package\.json|\.env)">
    Order Allow,Deny
    Deny from all
</FilesMatch>
```

## Troubleshooting Common Issues

### Issue 1: 500 Internal Server Error

-   Check `.env` file exists and is readable
-   Verify database credentials
-   Check file permissions
-   Review error logs in control panel

### Issue 2: CSS/JS Not Loading

-   Ensure `public/build/` folder is moved to `public_html/build/` with all assets intact
-   Verify `public/build/manifest.json` is in `public_html/build/manifest.json`
-   Check `APP_URL` in `.env` matches your domain exactly
-   Run `php artisan config:cache`
-   Ensure Vite manifest file is accessible

### Issue 3: Database Connection Failed

-   Verify database credentials in `.env`
-   Check if database exists
-   Ensure database user has proper privileges

### Issue 4: Routes Not Working

-   Check `.htaccess` file exists
-   Verify mod_rewrite is enabled
-   Clear route cache: `php artisan route:clear`

## Quick Commands Reference

```bash
# Production optimization
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Clear everything
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Database operations
php artisan migrate --force
php artisan db:seed --force

# Check application status
php artisan about
```

## Support

-   Hostinger Support: Available 24/7 via live chat
-   Laravel Documentation: https://laravel.com/docs
-   Check server error logs in control panel for debugging
