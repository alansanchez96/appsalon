function iniciarAdmin(){clickServicio(),rotarFlecha(),seleccionarFecha()}function clickServicio(){document.querySelectorAll(".tab-servicio").forEach(e=>{e.addEventListener("click",e=>{const t=e.target.parentElement.parentElement.children;for(let e=0;e<t.length;e++)t[e].classList.toggle("visibility")})})}function rotarFlecha(){document.querySelectorAll(".service-title").forEach(e=>{e.addEventListener("click",e=>{e.target.children[1].classList.toggle("rotate")})})}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",e=>{const t=e.target.value;window.location="?fecha="+t})}document.addEventListener("DOMContentLoaded",()=>{iniciarAdmin()});