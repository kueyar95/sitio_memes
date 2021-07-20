<?php

require '../../includes/app.php';
estaAutenticado();
incluirTemplate('header');
$db = conectarDb();
//echo "<pre>";
//echo var_dump($_POST);
//echo "</pre>";

//Arreglo con errores
$errores = [];

//Iniciar variables
$nombreArchivo = '';
$descripcion = '';
$tags = '';
$checkSensitivo = '';
$fuentePost = '';

//Ejecutar código luego de que el usuario envié el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //echo "<pre>";
    //var_dump($_POST);
    //var_dump($_FILES);
    //echo "</pre>";

    $descripcion = mysqli_real_escape_string($db, $_POST['descripcionPost']);
    $tags = mysqli_real_escape_string($db, $_POST['tags']);

    //Asignar files a una variable
    $archivoPost = $_FILES['archivoPost'];
    $nombreArchivo = $archivoPost['name'];


    if (isset($_POST["checkSensitivo"])) {
        $checkSensitivo = $_POST['checkSensitivo'];
    } else {
        $checkSensitivo = '0';
    }
    if (isset($_POST['fuentePost'])) {
        $fuentePost = $_POST['fuentePost'];
    } else {
        $fuentePost = '0';
    }

    if (!$descripcion) {
        $errores[] = 'Debes añadir una descripción';
    }
    if (!$tags) {
        $errores[] = 'Debes añadir mínimo un tag';
    }
    if(!$nombreArchivo){
        $errores = "El contenido de la publicación es obligatoria";
    }
    //echo "<pre>";
    //echo var_dump($errores);
    //echo "</pre>";

    //Revisar que el arreglo de errores esté vacío
    if (empty($errores)) {
        /**Subida de archivos */
        $carpetaContPost = '../../imagenes/';
        if(!is_dir($carpetaContPost)){
            mkdir($carpetaContPost);
        }
        //Generar nombre único para cada archivo
        $nombreUnico = md5( uniqid( rand(), true)) . '.jpg';

        //Subir la imagen
        move_uploaded_file($archivoPost['tmp_name'], $carpetaContPost . $nombreUnico );

        //Insertar en la base de datos
        $query = "INSERT INTO post (nombreArchivo, descripcion, tags, checkSensitivo, fuentePost) VALUES ('$nombreUnico','$descripcion','$tags','$checkSensitivo','$fuentePost')";

        $resultado = mysqli_query($db, $query);
        //echo"<pre>";
        //var_dump($resultado);
        //echo "</pre>";
        if($resultado){
            header('Location: ../index.php?resultado=1');
        }
    } else {
        echo "Hay errores";
    }
}

?>

<main>
    <div class="container">
        <div>
            <h2 class="d-flex justify-content-center mt-3">Crear publicación</h2>

            <a href="../index.php" class="btn btn-success">Volver</a>
        </div>
        <?php foreach ($errores as $error) : ?>
            <div class="container w-25 mt-4 alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form class="container w-25" method="POST" action="/Sitio_memes/admin/post/crear" enctype="multipart/form-data">
            <div class="form-group">
                <label for="archivoPost">Seleccionar archivo</label>
                <input type="file" class="form-control-file" id="archivoPost" name="archivoPost" accept="image/png, .jpeg, .jpg, image/gif">
            </div>
            <div class="form-group">
                <label for="descripcionPost">Descripción</label>
                <input type="text" class="form-control" id="descripcionPost" name="descripcionPost" value="<?php echo $descripcion; ?>">
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <input type="text" class="form-control" id="tags" name="tags" value="<?php echo $tags; ?>">
            </div>

            <div class="form-check">
                <input class="form-check-input" value="0" type="checkbox" name="checkSensitivo" id="checkSensitivo">
                <label class="form-check-label" for="checkSensitivo">
                    ¿Contenido sensible?
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" value="0" type="checkbox" name="fuentePost" id="fuentePost">
                <label class="form-check-label" for="fuentePost">
                    ¿Quieres subir la fuente del post?
                </label>
            </div>
            <input type="submit" value="Publicar" class="btn btn-success" id="">
        </form>
    </div>
</main>