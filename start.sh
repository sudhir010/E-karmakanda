#!/usr/bin/env bash
# eKarmakanda - Development Server Starter
# Usage: bash start.sh

set -e

if command -v php &> /dev/null; then
    echo "[eKarmakanda] Starting PHP development server..."
    echo "[eKarmakanda] Open http://localhost:8000 in your browser"
    echo "[eKarmakanda] Press Ctrl+C to stop."
    php -S localhost:8000
    exit 0
fi

if command -v npx &> /dev/null; then
    echo "[eKarmakanda] PHP not found — using static server (PHP pages won't render)."
    echo "[eKarmakanda] Install PHP 8+ for full functionality."
    echo "[eKarmakanda] Open http://127.0.0.1:8000 in your browser"
    echo "[eKarmakanda] Press Ctrl+C to stop."
    echo ""
    npx --yes http-server -p 8000 -c-1 --index index.php -a 127.0.0.1
    exit 0
fi

echo "[eKarmakanda] ERROR: Neither PHP nor Node.js is installed."
echo "[eKarmakanda] Install PHP 8+ from https://php.net/downloads"
exit 1
