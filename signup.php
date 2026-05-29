<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Create an account on eKarmakanda to manage bookings, profile, and access all features." />
    <title>eKarmakanda - Sign Up</title>
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/toast.css">
</head>

<body>
    <form action="database/signup.php" method="post" id="signup-form">
        <?php $token = bin2hex(random_bytes(32)); $_SESSION['csrf_token'] = $token; ?>
        <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
        <h1>Sign Up</h1>
        <div class="input-field">
            <input type="text" name="fullname" id="fullname" placeholder="" required>
            <label for="fullname">Fullname</label>
        </div>
        <div class="input-field">
            <input type="email" name="email" id="email" placeholder="" required>
            <label for="email">Email</label>
        </div>
        <div class="input-field">
            <input type="text" name="phonenumber" id="phonenumber" placeholder="" pattern="[0-9]{10}" required>
            <label for="phonenumber">Phone Number (10 digits)</label>
        </div>
        <div class="input-field">
            <input type="password" name="password" id="password" placeholder="" minlength="6" required>
            <label for="password">Password (min 6 chars)</label>
        </div>
        <div class="input-field">
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="" required>
            <label for="confirmpassword">Confirm password</label>
            <span id="password-match" class="field-hint"></span>
        </div>
        <div class="strength-bar" id="strength-bar">
            <div class="strength-segment" id="seg-1"></div>
            <div class="strength-segment" id="seg-2"></div>
            <div class="strength-segment" id="seg-3"></div>
            <div class="strength-segment" id="seg-4"></div>
        </div>
        <span id="strength-text" class="field-hint"></span>
        <button type="submit" class="btn" id="signup-btn">Sign Up</button>
        <p>Already have an account? <a href="login.php">Login </a></p>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("signup-form");
            const password = document.getElementById("password");
            const confirm = document.getElementById("confirmpassword");
            const matchHint = document.getElementById("password-match");
            const strengthBar = document.getElementById("strength-bar");
            const strengthText = document.getElementById("strength-text");
            const segments = [
                document.getElementById("seg-1"),
                document.getElementById("seg-2"),
                document.getElementById("seg-3"),
                document.getElementById("seg-4")
            ];

            function getStrength(pw) {
                let score = 0;
                if (pw.length >= 6) score++;
                if (pw.length >= 10) score++;
                if (/[A-Z]/.test(pw) && /[a-z]/.test(pw)) score++;
                if (/\d/.test(pw) && /[^A-Za-z0-9]/.test(pw)) score++;
                return score;
            }

            const labels = ['Weak', 'Fair', 'Good', 'Strong'];
            const colors = ['#c62828', '#ef6c00', '#f9a825', '#2e7d32'];

            password.addEventListener("input", function() {
                const score = getStrength(this.value);
                const level = this.value.length === 0 ? -1 : score;
                segments.forEach((seg, i) => {
                    seg.style.background = i <= level ? colors[level] || '#ccc' : '#e0e0e0';
                });
                strengthText.textContent = level >= 0 ? labels[level] || '' : '';
                checkMatch();
            });

            confirm.addEventListener("input", checkMatch);

            function checkMatch() {
                if (!confirm.value) {
                    matchHint.textContent = '';
                    return;
                }
                if (password.value === confirm.value) {
                    matchHint.textContent = '✓ Passwords match';
                    matchHint.style.color = '#2e7d32';
                } else {
                    matchHint.textContent = '✗ Passwords do not match';
                    matchHint.style.color = '#c62828';
                }
            }

            form.addEventListener("submit", function(e) {
                if (password.value !== confirm.value) {
                    e.preventDefault();
                    alert("Passwords do not match.");
                    return;
                }
                if (password.value.length < 6) {
                    e.preventDefault();
                    alert("Password must be at least 6 characters.");
                    return;
                }
            });

            // Show toast for duplicate email
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('error') === 'duplicate_email') {
                if (window.showToast) {
                    window.showToast('Email already exists. Please try logging in.', 'error');
                }
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });
    </script>
</body>

</html>
