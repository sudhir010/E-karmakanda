document.addEventListener("DOMContentLoaded", function () {
  // Hero background swiping
  const images = [
    "assets/images/hero1.jpeg",
    "assets/images/hero2.jpg",
    "assets/images/hero3.jpg",
  ];
  let currentIndex = 0;
  const hero = document.getElementById("hero");

  function changeBackground() {
    hero.style.backgroundImage = `url('${images[currentIndex]}')`;
    currentIndex = (currentIndex + 1) % images.length;
  }

  changeBackground();
  setInterval(changeBackground, 5000);

  // Mobile nav toggle
  const menuToggle = document.getElementById("menu-toggle");
  const navLinks = document.getElementById("nav-links");

  menuToggle.addEventListener("click", () => {
    navLinks.classList.toggle("show");

    if (navLinks.classList.contains("show")) {
      menuToggle.innerHTML = "✖";
    } else {
      menuToggle.innerHTML = "☰";
    }
  });
  // Close mobile nav on link click
  document.querySelectorAll("#nav-links a").forEach((link) => {
    link.addEventListener("click", () => {
      if (window.innerWidth <= 768) {
        navLinks.classList.remove("show");
        menuToggle.innerHTML = "☰";
      }
    });
  });

  // Newsletter form submission
  document
    .getElementById("newsletter-form")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      alert("Subscribed! You'll get updates soon.");
      this.reset();
    });

  // Scroll-triggered animations
  const scrollElements = document.querySelectorAll(".animate-on-scroll");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("show");
          observer.unobserve(entry.target); // Animate only once
        }
      });
    },
    {
      threshold: 0.5,
    }
  );

  scrollElements.forEach((el) => observer.observe(el));
});

// Sidebar profile icon functionality

document.addEventListener("DOMContentLoaded", () => {
  const profileIcon = document.getElementById("profile-icon");
  const sidebar = document.getElementById("profile-sidebar");
  const closeBtn = document.getElementById("close-sidebar");

  if (profileIcon && sidebar && closeBtn) {
    profileIcon.addEventListener("click", () => {
      sidebar.classList.add("active");
    });

    closeBtn.addEventListener("click", () => {
      sidebar.classList.remove("active");
    });

    // Close sidebar when clicking outside
    document.addEventListener("click", (e) => {
      if (
        !sidebar.contains(e.target) &&
        !profileIcon.contains(e.target) &&
        sidebar.classList.contains("active")
      ) {
        sidebar.classList.remove("active");
      }
    });
  }
});
