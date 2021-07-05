<?php include_once './inc/layout/header.php' ?>
<main class="d-flex justify-content-center">
    <form >
    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">Nosotros no compartiremos tu correo con nadie.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Contraseña</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Cerrar sesión al salir</label>
        <br>
        <a href="register.php">Crear cuenta</a>
    </div>
    <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</main>
<?php include_once './inc/layout/footer.php' ?>