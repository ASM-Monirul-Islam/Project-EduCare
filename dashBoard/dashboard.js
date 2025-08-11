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

// Main code starts from here..

// 1. Update time and date, and greeting according to time of day
function updateTime() {
  const timeEl = document.getElementById("time");
  const now = new Date();
  const options = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  timeEl.textContent =
    now.toLocaleDateString("en-US", options) + " — " + now.toLocaleTimeString();

  // Greeting based on time
  const greetingMsg = document.getElementById("daytime-greeting");
  const hour = now.getHours();
  let greet = "";
  if (hour >= 5 && hour < 12) greet = "Good Morning";
  else if (hour >= 12 && hour < 17) greet = "Good Afternoon";
  else if (hour >= 17 && hour < 21) greet = "Good Evening";
  else greet = "Good Night";
  greetingMsg.textContent = greet;
}

// 2. Mark attendance button toggle (Present / Absent)
function markAttendance(btn) {
  if (btn.textContent === "Present") {
    btn.textContent = "Absent";
    btn.style.backgroundColor = "#e57373"; // red-ish
    btn.style.color = "white";
  } else {
    btn.textContent = "Present";
    btn.style.backgroundColor = "#388e3c"; // green
    btn.style.color = "white";
  }
}

// 3. Move checked tasks to completed and unchecked back to pending
function handleTaskToggle(e) {
  if (!e.target.classList.contains("task-checkbox")) return;

  const li = e.target.closest("li");
  const pendingList = document.getElementById("pending-tasks-list");
  const completedList = document.getElementById("completed-tasks-list");

  if (e.target.checked) {
    li.classList.add("completed");
    completedList.appendChild(li);
  } else {
    li.classList.remove("completed");
    pendingList.appendChild(li);
  }
}

// 4. Add new task from input box
function addNewTask() {
  const input = document.getElementById("new-task-input");
  const val = input.value.trim();
  if (val === "") {
    alert("Please enter a task!");
    return;
  }
  const ul = document.getElementById("pending-tasks-list");
  const li = document.createElement("li");
  li.innerHTML = `<label><input type="checkbox" class="task-checkbox"> ${val}</label>`;
  ul.appendChild(li);
  input.value = "";
}

// 5. Add new upcoming event
function addNewEvent() {
  const input = document.getElementById("new-event-input");
  const val = input.value.trim();
  if (val === "") {
    alert("Please enter an event!");
    return;
  }
  const ul = document.getElementById("events-list");
  const li = document.createElement("li");
  li.innerHTML = `${val} <button onclick="removeEvent(this)">Done</button>`;
  ul.appendChild(li);
  input.value = "";
}

// Remove event (when done)
function removeEvent(btn) {
  const li = btn.closest("li");
  li.remove();
}

// 6. Weather display (demo static data for Dhaka)
function updateWeather() {
  // Normally you'd call an API here. For demo, static info:
  const weatherInfo = document.getElementById("weather-info");
  const tempC = 32;
  const condition = "Sunny";
  weatherInfo.textContent = `Dhaka, Bangladesh — ${tempC}°C, ${condition}`;
}

// 7. Rotate quotes every 7 seconds
const quotes = [
  {
    text: "Education is the most powerful weapon which you can use to change the world.",
    author: "Nelson Mandela",
  },
  {
    text: "The future belongs to those who believe in the beauty of their dreams.",
    author: "Eleanor Roosevelt",
  },
  {
    text: "Don't watch the clock; do what it does. Keep going.",
    author: "Sam Levenson",
  },
  {
    text: "The expert in anything was once a beginner.",
    author: "Helen Hayes",
  },
  {
    text: "Success is not final, failure is not fatal: It is the courage to continue that counts.",
    author: "Winston Churchill",
  },
  {
    text: "The beautiful thing about learning is that nobody can take it away from you.",
    author: "B.B. King",
  },
  { text: "Strive for progress, not perfection.", author: "Unknown" },
  { text: "Learning never exhausts the mind.", author: "Leonardo da Vinci" },
];

let currentQuoteIndex = 0;
function showQuote() {
  const quoteText = document.getElementById("quote-text");
  const quoteAuthor = document.getElementById("quote-author");

  const q = quotes[currentQuoteIndex];
  quoteText.textContent = `"${q.text}"`;
  quoteAuthor.textContent = `— ${q.author}`;

  currentQuoteIndex++;
  if (currentQuoteIndex >= quotes.length) currentQuoteIndex = 0;
}

// Event listener for tasks checkbox toggle
document
  .getElementById("pending-tasks-list")
  .addEventListener("change", handleTaskToggle);
document
  .getElementById("completed-tasks-list")
  .addEventListener("change", handleTaskToggle);

// Initial setup
updateTime();
setInterval(updateTime, 1000);
updateWeather();
showQuote();
setInterval(showQuote, 7000);
