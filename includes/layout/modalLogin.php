<?php
  use Models\Usuario;
  $usuario = new Usuario;
?>

<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Iniciar Sesión</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario Login -->
        <form id="formLogin" action="./login.php">
          <div class="form-group">
            <label for="usuarioLogin">Usuario</label>
            <input type="text" class="form-control" id="usuarioLogin" name="usuarioLogin">
          </div>
          <br>
          <div class="form-group">
            <label for="passwordLogin">Contraseña</label>
            <input type="text" class="form-control" id="passwordLogin" name="passwordLogin">
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">No olvidar</label>
            <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#registerModal">Registrarse</a>
          </div>
          <br>
          <button type="submit" class="btn btn-primary" id="btnLogin">Entrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Register -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario Register -->
        <form id="formRegister" action="./register.php">
          <div class="form-group">
            <label for="usuarioRegister">Usuario</label>
            <input type="text" class="form-control" id="usuarioRegister" name="usuario[nombreUsuario]" value="<?php echo sanitizar($usuario->nombreUsuario); ?>">
          </div>
          <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" class="form-control" id="emailRegister" aria-describedby="emailHelp" name="usuario[email]" value="<?php echo sanitizar($usuario->email); ?>">
            <small id="emailHelp" class="form-text text-muted">Nosotros no compartiremos tu correo con nadie.</small>
          </div>
          <div class="form-group">
            <label for="claveUsuario">Contraseña</label>
            <input type="password" class="form-control" id="passwordRegister" name="usuario[claveUsuario]" value="<?php echo sanitizar($usuario->claveUsuario); ?>">
          </div>
          <div class="form-group">
            <label for="passwordConf">Confirmar contraseña</label>
            <input type="password" class="form-control" id="passwordConf" name="passwordConf">
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="CheckTerm" name="CheckTerm">
            <label class="form-check-label" for="CheckTerm">
              Acepto las condiciones de uso y privacidad
            </label>
          </div>
          <br>
          <button type="submit" class="btn btn-primary" id="btnRegister">Registrarse</button>
        </form>
      </div>
    </div>
  </div>
</div>