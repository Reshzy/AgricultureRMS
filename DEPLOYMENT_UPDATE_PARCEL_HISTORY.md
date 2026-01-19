# 🚀 Deploying Parcel History Feature to Hostinger

This guide covers deploying the new parcel history/audit trail feature to your Hostinger production server.

## 📋 What's New

This update adds:
- Parcel history tracking (saves old parcel data before updates)
- History viewing on enrollment detail pages
- Change tracking (who changed what and when)
- Two new database tables: `farm_parcel_histories` and `farm_parcel_item_histories`

## 🎯 Quick Deployment Steps

### Step 1: Upload New/Modified Files

Upload these files to your Hostinger server (via FTP/SFTP or File Manager):

#### New Files:
```
database/migrations/
├── 2025_11_19_034141_create_farm_parcel_histories_table.php
└── 2025_11_19_034145_create_farm_parcel_item_histories_table.php

app/Models/
├── FarmParcelHistory.php
└── FarmParcelItemHistory.php
```

#### Modified Files:
```
app/Models/
├── FarmParcel.php (added histories() relationship)
└── Enrollment.php (added parcelHistories() relationship)

app/Http/Controllers/
└── EnrollmentController.php (added history tracking logic)

resources/views/admin/enrollments/
└── show.blade.php (added history display section)
```

### Step 2: Run Database Migrations

**Option A: Via SSH (Recommended)**
```bash
cd public_html
php artisan migrate --force
```

**Option B: Via Hostinger Terminal**
1. Log into Hostinger control panel
2. Go to **Advanced** → **Terminal** (or **SSH Access**)
3. Navigate to your project: `cd public_html`
4. Run: `php artisan migrate --force`

**Option C: Manual SQL Import (If no SSH)**
1. Export the migration SQL from your local database:
   ```bash
   php artisan migrate --pretend
   ```
2. Or manually create tables via phpMyAdmin using the migration files

### Step 3: Clear Application Cache

After uploading files, clear all caches:

```bash
cd public_html
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

Then rebuild caches for production:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 4: Verify Deployment

1. **Check Database Tables**
   - Log into phpMyAdmin
   - Verify these tables exist:
     - `farm_parcel_histories`
     - `farm_parcel_item_histories`

2. **Test the Feature**
   - Log into your admin panel
   - Go to an enrollment with parcels
   - Edit and update parcel data
   - View the enrollment detail page
   - Check if "Parcel History" section appears
   - Verify history is saved when you update parcels

## 🔍 Detailed File Upload Checklist

### Files to Upload:

✅ **Migrations** (2 new files)
- `database/migrations/2025_11_19_034141_create_farm_parcel_histories_table.php`
- `database/migrations/2025_11_19_034145_create_farm_parcel_item_histories_table.php`

✅ **Models** (2 new, 2 modified)
- `app/Models/FarmParcelHistory.php` (NEW)
- `app/Models/FarmParcelItemHistory.php` (NEW)
- `app/Models/FarmParcel.php` (MODIFIED - added relationship)
- `app/Models/Enrollment.php` (MODIFIED - added relationship)

✅ **Controller** (1 modified)
- `app/Http/Controllers/EnrollmentController.php` (MODIFIED - added history logic)

✅ **Views** (1 modified)
- `resources/views/admin/enrollments/show.blade.php` (MODIFIED - added history UI)

## 🛠️ Troubleshooting

### Issue: Migration Fails

**Error:** "Table already exists"
- Solution: Check if tables already exist in database. If they do, you can skip migration or drop and recreate.

**Error:** "Foreign key constraint fails"
- Solution: Ensure `users` table exists and has an `id` column.

### Issue: History Not Showing

1. Check if migrations ran successfully:
   ```bash
   php artisan migrate:status
   ```

2. Verify tables exist in database:
   ```sql
   SHOW TABLES LIKE 'farm_parcel%';
   ```

3. Check browser console for JavaScript errors (history accordion uses JS)

4. Clear view cache:
   ```bash
   php artisan view:clear
   ```

### Issue: "Class not found" Errors

1. Run composer autoload:
   ```bash
   composer dump-autoload
   ```

2. Clear all caches:
   ```bash
   php artisan optimize:clear
   ```

## 📝 Post-Deployment Notes

- **History is only created when parcel data changes** - not on every enrollment update
- **Old data is preserved** - you can view previous parcel states anytime
- **Change tracking** - shows who made changes and what changed
- **No data loss** - existing parcels are unaffected, history starts from next update

## 🔐 Security Reminder

After deployment, ensure:
- File permissions are correct (644 for files, 755 for directories)
- `.env` file is not publicly accessible
- Storage and cache directories are writable

## ✅ Verification Checklist

- [ ] All new files uploaded
- [ ] All modified files uploaded
- [ ] Migrations ran successfully
- [ ] Database tables created
- [ ] Caches cleared and rebuilt
- [ ] Tested updating a parcel
- [ ] History section appears on enrollment detail page
- [ ] History shows correct old data
- [ ] Change summary displays correctly

## 🆘 Need Help?

If you encounter issues:
1. Check Hostinger error logs in control panel
2. Check Laravel logs: `storage/logs/laravel.log`
3. Verify database connection in `.env`
4. Ensure PHP version is 8.1+ (required for Laravel 11)

---

**Deployment Date:** _______________
**Deployed By:** _______________
**Status:** ☐ Success  ☐ Issues Encountered

