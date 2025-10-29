document.addEventListener("DOMContentLoaded", () => {
  // Année auto
  document.querySelectorAll("#year").forEach(el => el.textContent = new Date().getFullYear());

  // Apparition progressive (scroll)
  const faders = document.querySelectorAll('.fade-up');
  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('show');
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.2 });
  faders.forEach(el => observer.observe(el));

  // Navbar effet scroll
  const navbar = document.querySelector('.navbar');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 40) {
      navbar.style.background = 'rgba(10,15,31,0.98)';
      navbar.style.boxShadow = '0 6px 18px rgba(0,0,0,0.3)';
    } else {
      navbar.style.background = 'rgba(10,15,31,0.9)';
      navbar.style.boxShadow = 'none';
    }
  });

  // Logos animés (léger mouvement vertical)
  const logos = document.querySelectorAll('.tech-logos img');
  setInterval(() => {
    logos.forEach((logo, i) => {
      const offset = Math.sin(Date.now() / 1000 + i) * 3;
      logo.style.transform = `translateY(${offset}px)`;
    });
  }, 50);

  // Formulaire contact (simulation)
  const form = document.getElementById("contactForm");
  if (form) {
    form.addEventListener("submit", e => {
      e.preventDefault();
      alert("Merci, ton message est bien enregistré !");
      form.reset();
    });
  }
});
