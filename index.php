<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="eKarmakanda – Preserving Ancient Hindu Rituals with Technology. Explore pujas, book pandits, and view auspicious dates." />
    <title>eKarmakanda - Home</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/toast.css" />
</head>

<body>
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

    <section class="hero" id="hero">
        <div class="hero-text">
            <h1>Preserving Ancient Rituals with Technology</h1>
            <p>Explore, learn, and perform Karmakanda with ease — anytime, anywhere.</p>
            <a href="pujas.php" class="btn">Explore Rituals</a>
        </div>
    </section>

    <section class="about animate-on-scroll">
        <h2>About eKarmakanda</h2>
        <p>Our goal is to make Hindu rituals more accessible, authentic, and organized by leveraging modern tools.</p>
    </section>

    <section class="features">
        <h2>Main Offerings</h2>
        <div class="feature-cards">
            <div class="card animate-on-scroll">
                <h3>Ritual Guides</h3>
                <p>Step-by-step explanations of various pujas and karmakanda procedures.</p>
            </div>
            <div class="card animate-on-scroll">
                <h3>Book a Pandit</h3>
                <p>Schedule certified priests for ceremonies near you.</p>
            </div>
            <div class="card animate-on-scroll">
                <h3>Calendar</h3>
                <p>Get accurate tithis, festivals, and muhurat timings.</p>
            </div>
        </div>
    </section>

    <section class="quick-rituals">
        <h2>Popular Rituals</h2>
        <div class="feature-cards">
            <div class="card animate-on-scroll">
                <h3>Naamkaran</h3>
                <p>Naming ceremony for newborns. Performed on 11th or 12th day after birth.</p> <br>
                <a href="ritual.php?id=1" class="btn">Learn More</a>
            </div>
            <div class="card animate-on-scroll">
                <h3>Griha Pravesh</h3>
                <p>Auspicious ceremony when entering a new home for the first time.</p> <br>
                <a href="ritual.php?id=2" class="btn">Learn More</a>
            </div>
            <div class="card animate-on-scroll">
                <h3>Antyeshti</h3>
                <p>Final rites (funeral). Helps guide the soul’s journey according to dharma.</p> <br>
                <a href="ritual.php?id=3" class="btn">Learn More</a>
            </div>
        </div>
    </section>

    <section class="newsletter animate-on-scroll">
        <h2>Subscribe for Updates</h2>
        <form id="newsletter-form">
            <input type="email" placeholder="Enter your email" required />
            <button type="submit" class="btn">Subscribe</button>
        </form>
    </section>

    <footer class="animate-on-scroll">
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


    <script src="js/toast.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/script.js"></script>
</body>

</html>