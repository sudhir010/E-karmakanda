<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact – eKarmakanda</title>
    <link rel="stylesheet" href="./css/navbar.css" />
    <link rel="stylesheet" href="./css/contact.css" />
</head>

<body>
    <!-- Navbar -->
  
        <header>
            <nav class="navbar">
                <div class="logo">eKarmakanda</div>
                <div class="menu-toggle" id="menu-toggle">☰</div>

                <ul class="nav-links" id="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="pujas.php">Rituals</a></li>
                    <li><a href="book.php">Book a Pandit</a></li>
                    <li><a href="calendar.php">Calendar</a></li>
                    <li><a href="contact.php">Contact</a></li>

                    <?php if ($isLoggedIn): ?>
                        <li class="nav-profile">
                            <div class="profile-wrapper">
                                <img src="assets/images/Profile.png" alt="Profile" id="profile-icon" class="profile-icon" />
                            </div>
                        </li>
                        <li>
                            <form action="logout.php" method="post" style="display: inline;">
                                <button type="submit" class="btn">Logout</button>
                            </form>
                        </li>
                    <?php else: ?>
                        <li><a href="signup.html" class="btn">Sign Up</a></li>
                    <?php endif; ?>


                </ul>
            </nav>
        </header>
   

    <!-- Contact Section -->
    <main class="contact-section animate-on-scroll">
        <h2>Get in Touch</h2>
        <p>Have questions or inquiries? We'd love to hear from you.</p>

        <form id="contact-form" class="contact-form" method="post" action="./database/contact.php">
            <div class="form-group">
                <label for="name">Full Name*</label>
                <input type="text" id="name" name="name" required />
            </div>

            <div class="form-group">
                <label for="email">Email Address*</label>
                <input type="email" id="email" name="email" required />
            </div>

            <div class="form-group">
                <label for="message">Your Message*</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn">Send Message</button>
            <p id="form-message" class="success-message" style="display: none;">✅ Thank you! We'll get back to you soon.
            </p>
        </form>
    </main>

    <footer class="footer">
        <p>&copy; 2025 eKarmakanda. All rights reserved.</p>
    </footer>

     <?php if ($isLoggedIn): ?>
        <div class="profile-sidebar" id="profile-sidebar">
            <div class="sidebar-header">
                <span id="close-sidebar">&times;</span>
            </div>
            <div class="sidebar-content">
                <img src="assets/images/Profile.png" alt="Profile" class="sidebar-profile-icon" />
                <h2>Hello, <?php echo htmlspecialchars($_SESSION['fullname']); ?></h2>
                <form action="./database/update_name.php" method="post" class="edit-name-form">
                    <input type="text" name="new_name" placeholder="Edit your name" required>
                    <button type="submit" class="btn">Update</button>
                </form>
            </div>
        </div>
    <?php endif; ?>



    <script src="./js/navbar.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('status') === 'success') {
                document.getElementById("form-message").style.display = "block";
                // Clean the URL
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });
    </script>
</body>

</html>