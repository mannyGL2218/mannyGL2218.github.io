const SOBRE = document.getElementById("sobre");
const BTN_ABRIR = document.getElementById("abrir");
const BTN_REINICIAR = document.getElementById("reset");

const texto = document.getElementsByClassName("texto");
texto[0].innerHTML = `Para:`;
texto[1].innerHTML = `Cecilia Garcia Reyes`;
texto[2].innerHTML = `------ Tamo :D ------`;
texto[3].innerHTML = `-------- <3 --------`;

const fnAbrirSobre = () => {
    console.log("abrir");
    SOBRE.classList.add("abierto");
    SOBRE.classList.remove("cerrado");
}
const fnCerrarSobre = () => {
    console.log("cerrar");
    SOBRE.classList.add("cerrado");
    SOBRE.classList.remove("abierto");
}

SOBRE.addEventListener("click", fnAbrirSobre);
BTN_ABRIR.addEventListener("click", fnAbrirSobre);
BTN_REINICIAR.addEventListener("click", fnCerrarSobre);
