@echo off
echo ========================================
echo   ServiceM8 Database Import Script
echo ========================================
echo.

REM Check if SQL file exists
if not exist "servicem8.sql" (
    echo ERROR: servicem8.sql not found in current directory!
    echo Please make sure servicem8.sql is in the serviceM8 folder.
    pause
    exit /b 1
)

echo SQL file found: servicem8.sql
echo.

REM Get MySQL credentials
set /p MYSQL_USER="MySQL Username (default: root): "
if "%MYSQL_USER%"=="" set MYSQL_USER=root

set /p MYSQL_PASS="MySQL Password: "

echo.
echo Creating database 'servicem8'...
mysql -u %MYSQL_USER% -p%MYSQL_PASS% -e "CREATE DATABASE IF NOT EXISTS servicem8 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

if errorlevel 1 (
    echo Warning: Database creation had issues, but continuing...
)

echo.
echo Importing SQL file...
mysql -u %MYSQL_USER% -p%MYSQL_PASS% servicem8 < servicem8.sql

if errorlevel 1 (
    echo.
    echo ERROR: Database import failed!
    echo Please check your MySQL credentials and try again.
    pause
    exit /b 1
)

echo.
echo ========================================
echo   Database Import Complete!
echo ========================================
echo.
echo Next steps:
echo 1. Copy .env.example to .env (if not done)
echo 2. Update .env with your database credentials
echo 3. Run: php artisan key:generate
echo 4. Test connection: php artisan migrate:status
echo.
pause

