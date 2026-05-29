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
