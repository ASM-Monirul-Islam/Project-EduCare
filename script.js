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

// Registration form validation
function check_validation() {
  const nameInput = document.querySelector(".name");
  const userNameInput = document.querySelector(".userName");
  const emailInput = document.querySelector(".email");
  const passwordInput = document.querySelector(".password");
  const confirmPasswordInput = document.querySelector(".confirmPassword");
  const checkbox = document.querySelector(".checkbox");
  const error = document.querySelectorAll(".error");

  error.forEach((e) => {
    e.textContent = "";
  });

  const nameErr = document.querySelector(".nameErr");
  const emailErr = document.querySelector(".emailErr");
  const passwordErr = document.querySelector(".passwordErr");
  const confirmPasswordErr = document.querySelector(".confirmPasswordErr");
  const checkboxErr = document.querySelector(".checkboxErr");
  const userNameErr = document.querySelector(".userNameErr");
  const finalErr = document.querySelector(".finalMsg");

  let valid = true;

  nameInput.addEventListener("input", (e) => {
    const name = nameInput.value.trim();
    if (!name) {
      nameErr.textContent = "Enter your name";
      valid = false;
    } else if (name.length < 3) {
      nameErr.textContent = "Your name must contain at least 3 letters!";
      valid = false;
    } else {
      nameErr.textContent = "";
    }
  });

  userNameInput.addEventListener("input", (e) => {
    const userName = userNameInput.value.trim();
    if (!userName) {
      userNameErr.textContent = "Enter a user name";
      valid = false;
    } else if (userName.length < 2) {
      userNameErr.textContent = "User name must contain at least 2 letters!";
      valid = false;
    } else {
      userNameErr.textContent = "";
    }
  });

  emailInput.addEventListener("input", (e) => {
    const email = emailInput.value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email) {
      emailErr.textContent = "Enter your email";
      valid = false;
    } else if (!emailPattern.test(email)) {
      emailErr.textContent = "Invalid email format!";
      valid = false;
    } else {
      emailErr.textContent = "";
    }
  });

  passwordInput.addEventListener("input", (e) => {
    const password = passwordInput.value.trim();
    const uppercase = /[A-Z]/.test(password);
    const lowercase = /[a-z]/.test(password);
    const specialcharacter = /[!@#$%^&*]/.test(password);
    const number = /[0-9]/.test(password);

    if (!password) {
      passwordErr.textContent = "Enter a password";
      valid = false;
    } else if (!uppercase) {
      passwordErr.textContent =
        "Your password must contain an uppercase character!";
      valid = false;
    } else if (!lowercase) {
      passwordErr.textContent =
        "Your password must contain a lowercase character!";
      valid = false;
    } else if (!specialcharacter) {
      passwordErr.textContent =
        "Your password must contain a special character!";
      valid = false;
    } else if (!number) {
      passwordErr.textContent =
        "Your password must contain a numerical character!";
      valid = false;
    } else if (password.length < 8) {
      passwordErr.textContent =
        "Your password must contain at least 8 characters!";
      valid = false;
    } else {
      passwordErr.textContent = "";
    }
  });

  confirmPasswordInput.addEventListener("input", (e) => {
    const confirmPassword = confirmPasswordInput.value.trim();
    const password = passwordInput.value.trim();
    if (!confirmPassword) {
      confirmPasswordErr.textContent = "Retype your password!";
      valid = false;
    } else if (password !== confirmPassword) {
      confirmPasswordErr.textContent = "Passwords do not match!";
      valid = false;
    } else {
      confirmPasswordErr.textContent = "";
    }
  });
}

check_validation();

registerPopup.addEventListener("submit", (e) => {
  alert("Registration successful!");
});

// Feature buttons

const future = document.querySelectorAll(".future");
const loginFirst = document.querySelectorAll(".login-first");

future.forEach((e) => {
  e.addEventListener("click", () => {
    alert("This feature is still under development! Stay tuned!!!");
  });
});

loginFirst.forEach((e) => {
  e.addEventListener("click", () => {
    alert("You need to login first!!!");
  });
});
