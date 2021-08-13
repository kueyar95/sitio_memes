<?php
session_start();
require 'includes/app.php';

//Importante: Los requires e include se hacen en base al index del directorio raíz
$db = conectarDb();

//Autentificación
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $usuarioLogin = $_POST['usuarioLogin'];
  $passwordLogin = $_POST['passwordLogin'];
  //echo "<pre>";
  //echo $usuarioLogin;
  //echo "<br>";
  //echo $passwordLogin;
  //echo "</pre>";
  if (!$usuarioLogin) {
    $errores[] = 'El usuario es obligatorio';
  } elseif (!$passwordLogin) {
    $errores[] = 'La contraseña es obligatoria';
  }
  if (empty($errores)) {
    //Revisar si el usuario existe
    $query = "SELECT * FROM usuarios WHERE nombreUsuario = '${usuarioLogin}'";
    $resultado = mysqli_query($db, $query);

    if ($resultado->num_rows) {
      //Revisar si el password es correcto
      $usuario = mysqli_fetch_assoc($resultado);

      $auth = password_verify($passwordLogin, $usuario['claveUsuario']);
      if ($auth) {
        //El usuario está autenticado

        //Llenar el arreglo de la sesión
        $_SESSION['usuario'] = $usuarioLogin;
        $_SESSION['login'] = true;
      } else {
        //El password es incorrecto
        $errores[] = 'La contraseña está incorrecta';
      }
    } else {
      $errores[] = 'El usuario no existe';
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h2>Login</h2>
  <?php
  var_dump($_POST);

  ?>
</body>

</html>