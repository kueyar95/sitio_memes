<?php
require '../../includes/app.php';
use App\Post;
estaAutenticado();
incluirTemplate('header');
$db = conectarDb();
$publicacion = new Post;
//Arreglo con errores
$errores = Post::getErrores();

//Ejecutar código luego de que el usuario envié el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /**Subida de archivos */
    //Generar nombre único para cada archivo
    $nombreUnico = md5(uniqid(rand(), true)) . '.jpg';
    
    //Asignar files a una variable
    $archivoPost = $_FILES['publicacion'];

    //Obtener el nombre del archivo y luego agregarlo a $_POST
    $nombreArchivo = $archivoPost['name']['archivoPost'];

    //Guardar en $_POST el nombre de usuario desde $_SESSION
    $_POST['publicacion']['nombreUsuarioPost'] = $_SESSION['usuario'];
    
    //Instanciar la clase post
    $publicacion = new Post($_POST['publicacion']);

    if($_FILES['publicacion']['tmp_name']['archivoPost']){
       $publicacion->setArchivoPost($nombreUnico);
    }

    //Validar los datos
    $errores = $publicacion->validar();
    //Revisar que el arreglo de errores esté vacío
    if (empty($errores)) {

        if (!is_dir(CARPETA_IMG)) {
            mkdir(CARPETA_IMG);
        }

        //Subir la imagen
        move_uploaded_file($archivoPost['tmp_name']['archivoPost'], CARPETA_IMG . $nombreUnico);

        //Guardar los datos de la publicación creada
        $publicacion->guardar();
        if ($resultado) {
            header('Location: ../index.php?resultado=1');
        }
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
            <?php include '../../includes/layout/formulario_post.php'; ?>
            <input type="submit" value="Publicar" class="btn btn-success" id="btnPost">
        </form>
    </div>
</main>