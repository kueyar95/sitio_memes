<?php

require '../../includes/app.php';


use App\Post;

estaAutenticado();
incluirTemplate('header');
$db = conectarDb();

//Arreglo con errores
$errores = Post::getErrores();

//Iniciar variables
$nombreUsuarioPost = '';
$nombreArchivo = '';
$archivoPost = '';
$descripcion = '';
$tags = '';
$checkSensitivo = '';
$fuentePost = '';

//Ejecutar código luego de que el usuario envié el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /**Subida de archivos */
    $carpetaContPost = '../../imagenes/';
    if (!is_dir($carpetaContPost)) {
        mkdir($carpetaContPost);
    }

    //Generar nombre único para cada archivo
    $nombreUnico = md5(uniqid(rand(), true)) . '.jpg';
    
    //Asignar files a una variable
    $archivoPost = $_FILES['archivoPost'];
    
    //Obtener el nombre del archivo y luego agregarlo a $_POST
    $nombreArchivo = $archivoPost['name'];
    $_POST['archivoPost'] = $nombreArchivo;

    //Guardar en $_POST el nombre de usuario desde $_SESSION
    $_POST['nombreUsuarioPost'] = $_SESSION['usuario'];

    
    //Instanciar la clase post
    $publicacion = new Post($_POST);
    //Revisar que el arreglo de errores esté vacío
    //Validar los datos
    
    $errores = $publicacion->validar();
    if (empty($errores)) {
        
        //Subir la imagen
       move_uploaded_file($archivoPost['tmp_name'], $carpetaContPost . $nombreUnico);
    
        //Guardar los datos de la publicación creada
        $publicacion->guardar();
    } else {
        echo "Hay errores";
    }
}

?>

<main>
    <?php

    ?>
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
                <input class="form-check-input" type="checkbox" name="checkSensitivo" id="checkSensitivo">
                <label class="form-check-label" for="checkSensitivo">
                    ¿Contenido sensible?
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fuentePost" id="fuentePost">
                <label class="form-check-label" for="fuentePost">
                    ¿Quieres subir la fuente del post?
                </label>
            </div>
            <input type="submit" value="Publicar" class="btn btn-success" id="">
        </form>
    </div>
</main>