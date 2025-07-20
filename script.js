const menu = document.querySelector(".menu");
const menuCard = document.querySelector(".menu-bg");

menu.addEventListener("click", ()=>{
	menuCard.classList.toggle("menu-card-hidden");
})

const menuClose = document.querySelectorAll(".menu-close");

menuClose.forEach(e=>{
	e.addEventListener("click", ()=>{
		menuCard.classList.toggle("menu-card-hidden");
	})
})


// Login - Register Pop Up Menu...

const login = document.querySelectorAll(".login");
const loginPop = document.querySelector(".login-popup");
const loginClose = document.querySelectorAll(".login-close");

login.forEach(e=>{
	e.addEventListener("click", ()=>{
		loginPop.classList.toggle("login-panel-hidden");
	})
})

loginClose.forEach(e=>{
	e.addEventListener("click", ()=>{
		loginPop.classList.toggle("login-panel-hidden");
	})
})

const register = document.querySelectorAll(".register");
const registerClose = document.querySelectorAll(".register-close");
const registerPopup = document.querySelector(".register-popup");

register.forEach(e=> {
	e.addEventListener("click", ()=>{
		registerPopup.classList.toggle("register-panel-hidden");
	})
})

registerClose.forEach(e=> {
	e.addEventListener("click", ()=>{
		registerPopup.classList.toggle("register-panel-hidden");
	})
})