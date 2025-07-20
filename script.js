const menu = document.querySelector(".menu");
const menuCard = document.querySelector(".menu-bg");

menu.addEventListener("click", ()=>{
	menuCard.classList.toggle("menu-card-hidden")
})

const navLogin = document.querySelector("#nav-login");
const menuLogin = document.querySelector(".menu-Login");
const loginPop = document.querySelector(".login-popup");

// navLogin.addEventListener("click", ()=> {
// 	loginPop.classList.toggle("login-panel-hidden");
// })

// menuLogin.addEventListener("click", ()=> {
// 	loginPop.classList.toggle("login-panel-hidden");
// })
	
let login = {
	l1 : document.querySelector("#nav-login"),
	l2 : document.querySelector(".menu-Login")
}

for(const key in login) {
	login[key].addEventListener("click", ()=>{
		loginPop.classList.toggle("login-panel-hidden");
	})
}