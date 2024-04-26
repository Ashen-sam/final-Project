const menu = document.querySelector(".menu");
const sidebar = document.querySelector(".nav-bar-mobile");

menu.addEventListener("click", function () {
  menu.classList.toggle("active");
  sidebar.classList.toggle("active");
});

AOS.init({
  duration: 1200,
});
