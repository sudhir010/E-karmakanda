<?php
http_response_code(404);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Page not found" />
    <title>404 – eKarmakanda</title>
    <link rel="stylesheet" href="./css/navbar.css" />
    <style>
        .error-page { text-align: center; padding: 6rem 2rem; margin-top: 4rem; }
        .error-page h1 { font-size: 5rem; color: #46244c; margin-bottom: 0.5rem; }
        .error-page h2 { color: #555; margin-bottom: 1.5rem; }
        .error-page p { color: #777; margin-bottom: 2rem; }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">eKarmakanda</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="pujas.php">Rituals</a></li>
                <li><a href="book.php">Book a Pandit</a></li>
                <li><a href="calendar.php">Calendar</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main class="error-page">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <p>The page you are looking for does not exist or has been moved.</p>
        <a href="index.php" class="btn">Go Home</a>
    </main>

    <footer class="footer">
        <p class="footer-bottom">&copy; 2025 eKarmakanda. All rights reserved.</p>
    </footer>
</body>
</html>
