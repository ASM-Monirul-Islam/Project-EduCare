const menu = document.querySelector(".menu");
const menuCard = document.querySelector(".menu-bg");

menu.addEventListener("click", ()=>{
	menuCard.classList.toggle("menu-card-hidden")
})