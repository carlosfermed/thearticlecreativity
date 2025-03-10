

const movimientoi = document.querySelector(".movimientoi");
const movimientoT = document.querySelector(".movimientoT");
const selectorCambioTamanio = document.querySelector(".cambioTamanio");

const letrasi = document.querySelectorAll(".letrai");
const letrasT = document.querySelectorAll(".letraT");
const letrasTitulo = document.querySelectorAll(".espacio");

movimientoi.addEventListener("mouseover", () => {
    letrasi.forEach(letra => letra.classList.add("accion"));
});

movimientoi.addEventListener("mouseout", () => {
    letrasi.forEach(letra => letra.classList.remove("accion"));
});

movimientoT.addEventListener("mouseover", () => {
    letrasT.forEach(letra => letra.classList.add("accion"));
});

movimientoT.addEventListener("mouseout", () => {
    letrasT.forEach(letra => letra.classList.remove("accion"));
});

selectorCambioTamanio.addEventListener("mouseover", () => {
    letrasTitulo.forEach(letra => letra.classList.add("cambiarTamanio")); 
});

selectorCambioTamanio.addEventListener("mouseout", () => {
    letrasTitulo.forEach(letra => letra.classList.remove("cambiarTamanio"));
});