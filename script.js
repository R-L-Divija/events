// Add your JavaScript for interactive elements here

// Example: Animate elements on scroll
document.addEventListener('DOMContentLoaded', function () {
  window.addEventListener('scroll', function () {
    const elements = document.querySelectorAll('.animate__animated');
    elements.forEach(function (element) {
      if (element.getBoundingClientRect().top < window.innerHeight) {
        element.classList.add('animate__fadeInUp');
      }
    });
  });
});
