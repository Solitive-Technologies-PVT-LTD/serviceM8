@echo off
echo ========================================
echo Tom's Pest Control - Client Portal
echo ========================================
echo.
echo Starting development servers...
echo.
echo Opening in browser: http://localhost:8000
echo.
echo Press Ctrl+C to stop the servers
echo ========================================
echo.

REM Start Laravel server in a new window
start "Laravel Server" cmd /k "php artisan serve"

REM Wait a moment for Laravel to start
timeout /t 3 /nobreak > nul

REM Start Vite dev server in a new window
start "Vite Dev Server" cmd /k "npm run dev"

REM Wait a moment for Vite to start
timeout /t 5 /nobreak > nul

REM Open browser
start http://localhost:8000

echo.
echo ========================================
echo Both servers are running!
echo Laravel: http://localhost:8000
echo.
echo Close the server windows to stop.
echo ========================================


