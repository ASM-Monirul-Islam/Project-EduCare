const navBar = document.querySelector(".nav-bar");
const menu = document.querySelector(".nav-menu");
const bar = '<i class="fa-solid fa-bars"></i>';
const cross = '<i class="fa-solid fa-xmark fa-2xl"></i>';
const menuBar = document.querySelector(".menu-bar");

let isBar = true;

function menuBartoggle() {
  if (isBar) {
    menu.innerHTML = cross;
    navBar.classList.add("nav-bar-hidden");
    menuBar.classList.remove("hidden-menu-bar");
  } else {
    menu.innerHTML = bar;
    navBar.classList.remove("nav-bar-hidden");
    menuBar.classList.add("hidden-menu-bar");
  }
  isBar = !isBar;
}

menu.addEventListener("click", () => {
  menuBartoggle();
});

// Theme Changer - need to improve more

const light = '<i class="fas fa-sun"></i>';
const dark = '<i class="fa-solid fa-moon"></i>';
const themeChanger = document.querySelectorAll(".theme-changer");
const blackColor = document.querySelectorAll(".black-color");
const navBtnTheme = document.querySelectorAll(".nav-btn-theme");

function Light_to_dark() {
  //	Light to dark function
  themeChanger.innerHTML = dark;
  blackColor.forEach((e) => {
    e.style.backgroundColor = "black";
    e.style.color = "white";
  });
  navBtnTheme.forEach((e) => {
    e.style.color = "white";
  });
}

function Dark_to_light() {
  //   Dark to Light Function

  blackColor.forEach((e) => {
    e.style.backgroundColor = "#cce7fc";
    e.style.color = "black";
  });
  navBtnTheme.forEach((e) => {
    e.style.color = "black";
  });
}

let isLight = true;

themeChanger.forEach((e) => {
  e.addEventListener("click", () => {
    if (isLight) {
      Light_to_dark();
      e.innerHTML = dark;
    } else {
      e.innerHTML = light;
      Dark_to_light();
    }
    isLight = !isLight;
  });
});

// Theme changer ends here...

// Navigator button

const btn = document.querySelectorAll("#menu-btn");
btn.forEach((e) => {
  e.addEventListener("click", () => {
    menuBartoggle();
  });
});

// Login - Register Pop Up Menu...

const login = document.querySelectorAll(".login");
const loginPop = document.querySelector(".login-popup");
const loginClose = document.querySelectorAll(".login-close");

login.forEach((e) => {
  e.addEventListener("click", () => {
    loginPop.classList.toggle("login-panel-hidden");
  });
});

loginClose.forEach((e) => {
  e.addEventListener("click", () => {
    loginPop.classList.toggle("login-panel-hidden");
  });
});

const register = document.querySelectorAll(".register");
const registerClose = document.querySelectorAll(".register-close");
const registerPopup = document.querySelector(".register-popup");

register.forEach((e) => {
  e.addEventListener("click", () => {
    registerPopup.classList.toggle("register-panel-hidden");
  });
});

registerClose.forEach((e) => {
  e.addEventListener("click", () => {
    registerPopup.classList.toggle("register-panel-hidden");
  });
});
