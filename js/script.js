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
