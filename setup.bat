@echo off
echo ========================================
echo CodeIgniter 4 Invoicing System Setup
echo ========================================
echo.

echo Step 1: Installing Composer Dependencies...
call composer install
if %errorlevel% neq 0 (
    echo ERROR: Composer install failed!
    pause
    exit /b 1
)
echo.

echo Step 2: Running Database Migrations...
call php spark migrate
if %errorlevel% neq 0 (
    echo ERROR: Migration failed! Make sure database exists.
    pause
    exit /b 1
)
echo.

echo Step 3: Seeding Admin User...
call php spark db:seed AdminSeeder
if %errorlevel% neq 0 (
    echo ERROR: Seeding failed!
    pause
    exit /b 1
)
echo.

echo ========================================
echo Setup Complete!
echo ========================================
echo.
echo Admin Login Credentials:
echo Username: hanzala
echo Email: hanzala@gmail.com
echo Password: admin123
echo.
echo To start the development server, run:
echo php spark serve
echo.
echo Then access:
echo Public Form: http://localhost:8080/form
echo Admin Panel: http://localhost:8080/admin/login
echo.
pause
