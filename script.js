const menu = document.querySelector(".menu");
const menuCard = document.querySelector(".menu-bg");

menu.addEventListener("click", ()=>{
	menuCard.classList.toggle("menu-card-hidden")
})


// Login Pop Up Menu...

const navLogin = document.querySelector("#nav-login");
const menuLogin = document.querySelector(".menu-Login");
const getStarted = document.querySelector(".menu-left-button");
const loginPop = document.querySelector(".login-popup");
const regiLogin = document.querySelector("#register-login");

	
let login = {
	l1 : navLogin,
	l2 : menuLogin,
	l3 : getStarted,
	l4: regiLogin
}

for(const key in login) {
	login[key].addEventListener("click", ()=>{
		loginPop.classList.toggle("login-panel-hidden");
	})
}

const loginClose = document.querySelector("#login-close");
const loginClose2 = document.querySelector("#login-register");

loginClose.addEventListener("click", ()=>{
	loginPop.classList.toggle("login-panel-hidden");
})

loginClose2.addEventListener("click", ()=>{
	loginPop.classList.toggle("login-panel-hidden");
})

// Register button

const registerPopup = document.querySelector(".register-popup");

const navRegister = document.querySelector("#nav-register");
const menuRegister =  document.querySelector(".menu-Register");
const loginRegister = document.querySelector("#login-register");

let register = {
	r1 : navRegister,
	r2 : menuRegister,
	r3 : loginRegister
};

for(const key in register) {
	register[key].addEventListener("click", ()=> {
		registerPopup.classList.toggle("register-panel-hidden");
	})
}


const registerClose1 = document.querySelector("#register-close");
const registerClose2 = document.querySelector("#register-login");

let registerClose = {
	rc1 : registerClose1,
	rc2 : registerClose2
}

for(const key in registerClose) {
	registerClose[key].addEventListener("click", ()=>{
		registerPopup.classList.toggle("register-panel-hidden");
	})
}