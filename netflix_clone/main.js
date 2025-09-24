document.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelectorAll(".slide");
    let current = 0;
    
    function showSlide(index) {
      slides.forEach((s, i) => s.style.display = (i === index ? "block" : "none"));
    }
    
    showSlide(current);
    
    setInterval(() => {
      current = (current + 1) % slides.length;
      showSlide(current);
    }, 4000);
  });
  