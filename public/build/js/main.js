'use strict';
//constantes
const formLogin = document.getElementById("formLogin");
const formRegister = document.getElementById("formRegister");
//Funciones
window.addEventListener("DOMContentLoaded", () => {
  formRegister.addEventListener("submit", registerForm);
  formLogin.addEventListener("submit", loginForm);
});
function loginForm(e) {
  e.preventDefault();
  fetch(this.getAttribute('action'), {
    method: "POST",
    body: new FormData(this),
  }).then((res) => {
    console.log(res);
      if(res.ok){
        window.location.href = '/Sitio_memes/admin/';
      }
    })
}

function registerForm(e) {
  e.preventDefault();
  fetch(this.getAttribute('action'), {
    method: "POST",
    body: new FormData(this),
  }).then((res) => {
   if(res.ok){
     window.location.href = '/Sitio_memes/admin/index.php?resultado=1';
   }
  })
}

function imprimirAlerta(mensaje, tipo) {
  //Crear el div
  const divMensaje = document.createElement("div");
  divMensaje.classList.add("text-center", "alert", "d-block", "col-12");

  //Agregar clase en base al tipo de error
  if (tipo === "error") {
    divMensaje.classList.add("alert-danger");
  } else {
    divMensaje.classList.add("alert-success");
  }

  //Mensaje de error
  divMensaje.textContent = mensaje;

  //Agregar al DOM
  document.querySelector("#contenido").insertBefore(divMensaje, inputs);

  //Quitar la alerta después de 5 seg
  setTimeout(() => {
    divMensaje.remove();
  }, 5000);
}
