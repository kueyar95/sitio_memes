<h1>Continuación registro</h1>
<?php
require_once __DIR__ . '/../../includes/app.php';
?>
<main class="container-xl d-flex justify-content-center flex-column px-0 mx-0">
    <?php foreach ($errores as $error) : ?>
        <div class="container w-25 mt-4 alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form id="formRegister" action="/usuarios/crear" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="usuarioRegister">Usuario</label>
            <input type="text" class="form-control" id="usuarioRegister" name="usuario[nombreUsuario]" value="<?php echo sanitizar($usuario->nombreUsuario); ?>">
        </div>
        <div class="form-group">
            <label for="imagenPerfil">Seleccionar archivo</label>
            <input type="file" class="form-control-file" id="imagenPerfil" name="usuario[imagenPerfil]" accept="image/png, .jpeg, .jpg, image/gif">
            <?php if ($usuario->imagenPerfil) : ?>
                <img class="img-fluid" src="<?php echo '../../imagenPerfil/' . sanitizar($publicacion->imagenPerfil); ?>" alt="">
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="usuario[email]" value="<?php echo sanitizar($usuario->email); ?>">
            <small id="emailHelp" class="form-text text-muted">Nosotros no compartiremos tu correo con nadie.</small>
        </div>
        <div class="form-group">
            <label for="claveUsuario">Contraseña</label>
            <input type="password" class="form-control" id="passwordRegister" name="usuario[claveUsuario]" value="<?php echo sanitizar($usuario->claveUsuario); ?>">
        </div>
        <br>
        <button type="submit" class="btn btn-primary" id="btnRegister">Registrarse</button>
    </form>
</main>