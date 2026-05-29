<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Frequently asked questions about eKarmakanda rituals, pandit booking, and platform usage." />
    <title>FAQ – eKarmakanda</title>
    <link rel="stylesheet" href="./css/navbar.css" />
    <link rel="stylesheet" href="./css/toast.css" />
    <style>
        .faq-page { max-width: 800px; margin: 6rem auto 2rem; padding: 0 2rem; }
        .faq-page h1 { color: #46244c; margin-bottom: 0.5rem; }
        .faq-page > p { color: #666; margin-bottom: 2.5rem; }
        .faq-item { background: #fff; border-radius: 10px; margin-bottom: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
        .faq-question { padding: 1.2rem 1.5rem; cursor: pointer; font-weight: 600; color: #46244c; display: flex; justify-content: space-between; align-items: center; transition: background 0.2s; }
        .faq-question:hover { background: #f8f4f9; }
        .faq-question::after { content: '+'; font-size: 1.4rem; color: #a63860; }
        .faq-question.open::after { content: '−'; }
        .faq-answer { padding: 0 1.5rem; max-height: 0; overflow: hidden; transition: max-height 0.3s ease, padding 0.3s ease; }
        .faq-answer.open { max-height: 300px; padding: 0 1.5rem 1.2rem; }
        .faq-answer p { color: #555; line-height: 1.7; }
    </style>
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
                <li><a href="login.php" class="btn">Login</a></li>
            </ul>
        </nav>
    </header>

    <main class="faq-page">
        <h1>Frequently Asked Questions</h1>
        <p>Find answers to common questions about our platform and services.</p>

        <div class="faq-item">
            <div class="faq-question">What is eKarmakanda?</div>
            <div class="faq-answer"><p>eKarmakanda is a digital platform dedicated to preserving and promoting Hindu rituals (Karmakanda). We provide detailed guides, pandit booking services, and an auspicious calendar — all in one place.</p></div>
        </div>
        <div class="faq-item">
            <div class="faq-question">How do I book a pandit?</div>
            <div class="faq-answer"><p>Visit the <a href="book.php">Book a Pandit</a> page, fill in your details including ritual type, date, and location, then submit the form. We will connect you with a certified priest in your area.</p></div>
        </div>
        <div class="faq-item">
            <div class="faq-question">Is registration required?</div>
            <div class="faq-answer"><p>No, you can browse rituals and use the calendar without an account. However, registration lets you manage your profile and track bookings.</p></div>
        </div>
        <div class="faq-item">
            <div class="faq-question">Are the pandits certified?</div>
            <div class="faq-answer"><p>Yes, all pandits listed through our platform are verified and certified with proper credentials in Vedic rituals and ceremonies.</p></div>
        </div>
        <div class="faq-item">
            <div class="faq-question">How is the calendar different?</div>
            <div class="faq-answer"><p>Our calendar follows the traditional Nepali Bikram Sambat system and highlights tithis, ekadashis, purnimas, and festivals to help you plan auspicious events.</p></div>
        </div>
        <div class="faq-item">
            <div class="faq-question">Can I suggest a new ritual?</div>
            <div class="faq-answer"><p>Absolutely! Use the <a href="contact.php">Contact</a> page to send us your suggestions. We are always expanding our collection.</p></div>
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

    <script src="./js/toast.js"></script>
    <script src="./js/navbar.js"></script>
    <script>
        document.querySelectorAll('.faq-question').forEach(q => {
            q.addEventListener('click', () => {
                q.classList.toggle('open');
                q.nextElementSibling.classList.toggle('open');
            });
        });
    </script>
</body>
</html>
