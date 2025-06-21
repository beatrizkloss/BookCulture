document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.querySelector(".hamburger-menu");
  if (hamburger) {
    const navMenu = document.querySelector(".nav-menu");
    hamburger.addEventListener("click", () => {
      navMenu.classList.toggle("active");
    });
  }

  const loginForm = document.getElementById("login-form");
  if (loginForm) {
    const cadastroForm = document.getElementById("cadastro-form");
    const showRegisterLink = document.getElementById("show-register");
    const showLoginLink = document.getElementById("show-login");

    showRegisterLink.addEventListener("click", (e) => {
      e.preventDefault();
      loginForm.style.display = "none";
      cadastroForm.style.display = "block";
    });

    showLoginLink.addEventListener("click", (e) => {
      e.preventDefault();
      cadastroForm.style.display = "none";
      loginForm.style.display = "block";
    });
  }
});
