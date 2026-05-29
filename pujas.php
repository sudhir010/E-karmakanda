<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Browse our complete list of Hindu rituals and pujas with detailed guides, requirements, and benefits." />
    <title>Rituals – eKarmakanda</title>
    <link rel="stylesheet" href="./css/navbar.css" />
    <link rel="stylesheet" href="./css/pujas.css" />
    <link rel="stylesheet" href="./css/toast.css" />
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

    <main class="rituals-page animate-on-scroll">
        <h2>Our Ritual Offerings</h2>
        <p>Explore the most sacred rituals with proper guidance and meaning.</p>

        <div class="rituals-toolbar">
            <input type="text" id="ritual-search" class="search-input" placeholder="Search rituals..." />
            <div class="filter-chips" id="filter-chips"></div>
        </div>

        <div id="rituals-container" class="rituals-grid">
            <div class="loading-overlay">
                <div class="spinner spinner-lg"></div>
            </div>
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
                <h4>Contact</h4>
                <ul>
                    <li><a href="contact.php">Get in Touch</a></li>
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
        document.addEventListener("DOMContentLoaded", () => {
            const container = document.getElementById("rituals-container");
            const searchInput = document.getElementById("ritual-search");
            const chipsContainer = document.getElementById("filter-chips");

            fetch("./data/pujas.json")
                .then((res) => res.json())
                .then((pujas) => {
                    const names = [...new Set(pujas.map(p => p.name))];
                    renderChips(names);

                    function renderChips(allNames) {
                        chipsContainer.innerHTML = '';
                        const allChip = document.createElement('button');
                        allChip.className = 'chip chip-active';
                        allChip.textContent = 'All';
                        allChip.dataset.filter = '';
                        allChip.addEventListener('click', () => {
                            document.querySelectorAll('.chip').forEach(c => c.classList.remove('chip-active'));
                            allChip.classList.add('chip-active');
                            renderCards(pujas);
                            searchInput.value = '';
                        });
                        chipsContainer.appendChild(allChip);
                    }

                    function getFiltered() {
                        const query = searchInput.value.toLowerCase().trim();
                        return pujas.filter(p =>
                            p.name.toLowerCase().includes(query) ||
                            p.description.toLowerCase().includes(query)
                        );
                    }

                    function renderCards(data) {
                        if (data.length === 0) {
                            container.innerHTML = '<p class="no-results">No rituals match your search.</p>';
                            return;
                        }
                        container.innerHTML = '';
                        data.forEach((puja) => {
                            const card = document.createElement("div");
                            card.classList.add("ritual-card");
                            card.innerHTML = `
                                <img src="${puja.image}" alt="${puja.name}" onerror="this.onerror=null; this.src='./assets/images/default.jpg';" />
                                <div class="ritual-card-content">
                                    <h3>${puja.name}</h3>
                                    <p>${puja.description.slice(0, 100)}...</p>
                                    <a href="ritual.php?id=${puja.id}">Learn More</a>
                                </div>
                            `;
                            container.appendChild(card);
                        });
                        // Re-trigger scroll animations
                        document.querySelectorAll('.animate-on-scroll').forEach(el => el.classList.add('show'));
                    }

                    renderCards(pujas);
                    searchInput.addEventListener('input', () => renderCards(getFiltered()));
                })
                .catch((err) => {
                    console.error("Error loading pujas.json:", err);
                    container.innerHTML = "<p>Unable to load rituals at the moment.</p>";
                });
        });
    </script>
</body>
</html>
