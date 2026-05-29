<?php
session_start();
include 'database/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Log in to your eKarmakanda account to manage bookings and profile." />
    <title>eKarmakanda - Log in</title>
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/toast.css">
</head>

<body>
    <form action="database/login.php" method="post">
        <?php echo csrf_field(); ?>
        <h1>Log in</h1>

        <div class="input-field">
            <input type="email" name="email" id="email" placeholder="" required>
            <label for="email">Email</label>
        </div>

        <div class="input-field">
            <input type="password" name="password" id="password" placeholder="" required>
            <label for="password">Password</label>
        </div>
        <button type="submit" class="btn">Login</button>
        <p>Don't have an account? <a href="signup.php">Sign Up </a></p>
    </form>
    <script src="./js/toast.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const error = urlParams.get('error');
            if (error === 'invalid_credentials') {
                window.showToast('Invalid email or password.', 'error');
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });
    </script>
</body>

</html>
