@echo off
title eKarmakanda Server

REM Try PHP built-in server first (full functionality)
where php >nul 2>nul
if %errorlevel%==0 (
    echo [eKarmakanda] Starting PHP development server...
    echo [eKarmakanda] Open http://localhost:8000 in your browser
    echo [eKarmakanda] Press Ctrl+C to stop.
    php -S localhost:8000
    goto :eof
)

REM Fallback to Node.js http-server (static files only)
where npx >nul 2>nul
if %errorlevel%==0 (
    echo [eKarmakanda] PHP not found — using static server (PHP pages won't render).
    echo [eKarmakanda] Install PHP 8+ for full functionality.
    echo [eKarmakanda] Open http://127.0.0.1:8000 in your browser
    echo [eKarmakanda] Press Ctrl+C to stop.
    echo.
    npx --yes http-server -p 8000 -c-1 --index index.php -a 127.0.0.1
    goto :eof
)

echo [eKarmakanda] ERROR: Neither PHP nor Node.js is installed.
echo [eKarmakanda] Install PHP 8+ from https://windows.php.net/download
pause
