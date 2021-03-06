<!--Este el es layout principal -->
<?php

use Models\Usuario;

if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;

    if(!isset($inicio)){
        $inicio = false;
    }
    $usuario = new Usuario;
?>
<!DOCTYPE html>
<html lang="es" class="container mw-100 mx-0 px-0">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <link rel="stylesheet" href="./build/css/normalize.css" />
    <link rel="stylesheet" href="./build/css/style.css" />
    <script src="https://kit.fontawesome.com/7fb5970158.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Sitio memes</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md justify-content-between navbar-light bg-light">
            <div class="container d-flex justify-content-between">
                <a class="navbar-brand mx-xl-5" href="index.php">
                    Pag. Memes
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#firstNavbar" aria-controls="firstNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="firstNavbar">
                    <ul class="navbar-nav mx-xl-5">
                        <li class="nav-item"><a class="nav-link" href="#">Explorar</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Donar</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">+18</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Chat</a></li>
                    </ul>
                    <div class="navbar-nav">
                        <a class="nav-link" href="#"><i class="fas fa-bell"></i></a>
                        <a class="nav-link" href="#"><i class="fas fa-search"></i></a>
                        <a class="nav-link" href="#">?????? Escucha</a>
                        <a class="nav-link" href="#">???? Cambiar la paleta</a>
                        <?php if ($auth) : ?>
                            <a class="nav-link" href="/Sitio_memes/cerrar_sesion.php">Cerrar Sesi??n</a>
                        <?php else : ?>
                            <a class="nav-link" data-toggle="modal" data-target="#loginModal">Iniciar Sesi??n</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <hr />
        </nav>
    </header>
    <?php
    echo $contenido;
    ?>
    <footer></footer>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7fb5970158.js" crossorigin="anonymous"></script>
    <?php include '../views/modalLogin.php'; ?>
    <script src="../build/js/main.js" type="text/javascript"></script>
</body>

</html>