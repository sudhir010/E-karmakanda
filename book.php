<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Book a certified pandit for your desired Hindu ritual. Schedule pujas, homams, and ceremonies near you." />
    <title>Book a Pandit – eKarmakanda</title>
    <link rel="stylesheet" href="./css/navbar.css" />
    <link rel="stylesheet" href="./css/book.css" />
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
                <li><a href="book.php" class="active">Book a Pandit</a></li>
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

    <!-- Booking Form Section -->
    <main class="form-section animate-on-scroll">
        <h2>Book a Pandit</h2>
        <p>Fill in your details to schedule a ritual with a certified priest.</p>

        <form class="booking-form" id="booking-form" method="post" action="./database/submit_booking.php">
            <div class="form-group">
                <label for="fullName">Full Name*</label>
                <input type="text" id="fullName" name="fullName" required />
            </div>

            <div class="form-group">
                <label for="pujaType">Select Puja*</label>
                <select id="pujaType" name="pujaType" required>
                    <option value="">-- Choose a Ritual --</option>
                    <option value="naamkaran">Naamkaran</option>
                    <option value="grihapravesh">Griha Pravesh</option>
                    <option value="antyeshti">Antyeshti</option>
                    <option value="satyanarayan">Satyanarayan Katha</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Preferred Date*</label>
                <input type="date" id="date" name="date" required />
            </div>

            <div class="form-group">
                <label for="location">Location*</label>
                <input type="text" id="location" name="location" placeholder="City or Address" required />
            </div>

            <div class="form-group">
                <label for="contact">Contact Number*</label>
                <input type="tel" id="contact" name="contact" pattern="[0-9]{10}" required />
            </div>

            <div class="form-group">
                <label for="notes">Additional Notes (optional)</label>
                <textarea id="notes" name="notes" rows="4"></textarea>
            </div>

            <button type="submit" class="btn">Submit Booking</button>
        </form>
        <div class="success-message" id="success-message">
            <p>✅ Your booking request has been submitted successfully!</p>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Show success message if redirected after booking
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('status') === 'success') {
                document.getElementById("success-message").style.display = "block";
                setTimeout(() => {
                    document.getElementById("success-message").style.display = "none";
                }, 5000);
                // Clean the URL
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });
    </script>
</body>

</html>