
//constantes
const formLogin = document.getElementById('formLogin');


//Funciones
window.addEventListener("DOMContentLoaded", () => {
  formLogin.addEventListener("submit", enviarForm);
});

function enviarForm(e) {
  e.preventDefault();

  console.log(e.target);
  console.log(new FormData(e.target));
  //console.log(datos.get('passwordLogin'));

  fetch('./login.php',{
    method: 'POST',
    body: new FormData(e.target),
    
  })
    .then(res => res)
    .then(data =>{
      console.log(data)
    })
}


function imprimirAlerta(mensaje,tipo){
  //Crear el div
  const divMensaje = document.createElement('div');
  divMensaje.classList.add('text-center','alert','d-block','col-12');

  //Agregar clase en base al tipo de error
  if(tipo === 'error'){
      divMensaje.classList.add('alert-danger');
  }else{
      divMensaje.classList.add('alert-success');
  }
  
  //Mensaje de error
  divMensaje.textContent = mensaje;

  //Agregar al DOM
  document.querySelector('#contenido').insertBefore(divMensaje, inputs);

  //Quitar la alerta después de 5 seg
  setTimeout(() => {
      divMensaje.remove();
  }, 5000);

}

