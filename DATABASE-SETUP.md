# Database Setup Guide

This guide will help you import the `servicem8.sql` file into your MySQL database.

## Prerequisites

- MySQL Server installed and running
- MySQL command-line tools or phpMyAdmin
- Database credentials (username and password)

## Method 1: Using MySQL Command Line (Recommended)

### Step 1: Create the Database

Open Command Prompt or PowerShell and run:

```bash
mysql -u root -p
```

Then in MySQL prompt, create the database:

```sql
CREATE DATABASE servicem8 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Step 2: Import the SQL File

From the command line (outside MySQL), run:

```bash
mysql -u root -p servicem8 < servicem8.sql
```

Or if you're in the project directory:

```bash
mysql -u root -p servicem8 < D:\Project\cms\serviceM8\servicem8.sql
```

**Note:** Replace `root` with your MySQL username if different.

## Method 2: Using phpMyAdmin

1. Open phpMyAdmin in your browser (usually `http://localhost/phpmyadmin`)
2. Click on "New" to create a new database
3. Enter database name: `servicem8`
4. Select collation: `utf8mb4_unicode_ci`
5. Click "Create"
6. Select the `servicem8` database from the left sidebar
7. Click on the "Import" tab
8. Click "Choose File" and select `servicem8.sql`
9. Click "Go" to import

## Method 3: Using MySQL Workbench

1. Open MySQL Workbench
2. Connect to your MySQL server
3. Create a new schema named `servicem8`
4. Right-click on the schema → "Set as Default Schema"
5. Go to File → Run SQL Script
6. Select `servicem8.sql`
7. Click "Run" to execute

## Configure Laravel Environment

After importing the database, you need to configure Laravel to connect to it:

### Step 1: Create .env file

```bash
cd serviceM8
copy .env.example .env
```

### Step 2: Update Database Settings

Open `.env` file and update these lines:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=servicem8
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

**Important:** Replace `your_password_here` with your actual MySQL password.

### Step 3: Generate Application Key

```bash
php artisan key:generate
```

### Step 4: Test Database Connection

```bash
php artisan migrate:status
```

If you see no errors, your database is connected successfully!

## Default Login Credentials

Based on the SQL file, you can use these credentials to login:

**Admin User:**
- Username: `admin`
- Email: `admin@admin.com`
- Password: Check with your team or reset it

**Alternative Admin:**
- Username: `admin@example.com`
- Email: `admin@example.com`
- Password: Check with your team or reset it

## Troubleshooting

### Error: "Access denied for user"
- Check your MySQL username and password in `.env`
- Make sure the MySQL user has privileges to access the `servicem8` database

### Error: "Unknown database 'servicem8'"
- Make sure you created the database first
- Check the database name in `.env` matches the created database

### Error: "Table already exists"
- The database might already have tables
- You can drop the database and recreate it:
  ```sql
  DROP DATABASE servicem8;
  CREATE DATABASE servicem8 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
  ```
  Then import again

### Error: "Connection refused"
- Make sure MySQL server is running
- Check if MySQL is running on port 3306
- Verify `DB_HOST` in `.env` is correct (usually `127.0.0.1` or `localhost`)

## Next Steps

After successfully importing the database:

1. Install PHP dependencies: `composer install`
2. Install Node dependencies: `npm install`
3. Run migrations (if needed): `php artisan migrate`
4. Start the development server: `php artisan serve`

