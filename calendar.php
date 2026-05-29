<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Check the Nepali calendar with tithis, festivals, and auspicious muhurat timings for planning your rituals." />
    <title>Nepali Calendar – eKarmakanda</title>
    <link rel="stylesheet" href="./css/navbar.css" />
    <link rel="stylesheet" href="./css/calendar.css" />
    <link rel="stylesheet" href="./css/toast.css" />
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
                    <li><a href="signup.php" class="btn">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- Calendar Section -->
    <main class="calendar-wrapper animate-on-scroll">
        <h2>Nepali Calendar</h2>
        <p>Plan your rituals using the traditional Nepali Bikram Sambat calendar with Tithis and Festivals.</p>

        <div class="calendar-embed">
            <iframe src="https://www.hamropatro.com/widgets/calender-widget.php" width="100%" height="600"
                style="border:none; overflow:hidden;" loading="lazy" title="Nepali Calendar from Hamro Patro">
            </iframe>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>eKarmakanda</h4>
                <p>Preserving ancient rituals with modern technology.</p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="pujas.php">Rituals</a></li>
                    <li><a href="book.php">Book a Pandit</a></li>
                    <li><a href="calendar.php">Calendar</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Support</h4>
                <ul>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                </ul>
            </div>
        </div>
        <p class="footer-bottom">&copy; 2025 eKarmakanda. All rights reserved.</p>
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

    <script src="./js/toast.js"></script>
    <script src="./js/navbar.js"></script>
</body>

</html>
