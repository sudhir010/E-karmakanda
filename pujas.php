<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rituals – eKarmakanda</title>
    <link rel="stylesheet" href="./css/navbar.css" />
    <link rel="stylesheet" href="./css/pujas.css" />
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
 

    <!-- Main Content -->
    <main class="rituals-page animate-on-scroll">
        <h2>Our Ritual Offerings</h2>
        <p>Explore the most sacred rituals with proper guidance and meaning.</p>

        <div id="rituals-container" class="rituals-grid"></div>
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
        document.addEventListener("DOMContentLoaded", () => {
            fetch("./data/pujas.json")
                .then((res) => res.json())
                .then((pujas) => {
                    const container = document.getElementById("rituals-container");

                    pujas.forEach((puja) => {
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
                })
                .catch((err) => {
                    console.error("Error loading pujas.json:", err);
                    document.getElementById("rituals-container").innerHTML =
                        "<p>Unable to load rituals at the moment.</p>";
                });
        });

    </script>
</body>

</html>