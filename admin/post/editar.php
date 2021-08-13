<?php
require '../../includes/app.php';

use Models\Post;

estaAutenticado();

//Validar id
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: /Sitio_memes/admin/ ');
}

//Incluir template
incluirTemplate('header');

$db = conectarDb();
$publicacion = new Post;

//Obtener los datos del post
$publicacion = Post::find($id);

//Arreglo con errores
$errores = Post::getErrores();

//Ejecutar código luego de que el usuario envié el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Asignar los atributos
    $args = $_POST['publicacion'];

    /**Subida de archivos */
    //Generar nombre único para cada archivo
    $nombreUnico = md5(uniqid(rand(), true)) . '.jpg';

    //Instanciar la clase post
    $publicacion->updatePost($args);

    //Validar los datos
    $errores = $publicacion->validar();

    if ($_FILES['publicacion']['tmp_name']['archivoPost']) {
        $publicacion->setArchivoPost($nombreUnico);
    }

    //Revisar que el arreglo de errores esté vacío
    if (empty($errores)) {
        //Subir la imagen
        move_uploaded_file($_FILES['publicacion']['tmp_name']['archivoPost'], CARPETA_IMG . $nombreUnico);
        //Guardar los datos de la publicación creada
        $resultado = $publicacion->guardar();
        if ($resultado) {
            header('Location: ../index.php?resultado=2');
        }
    } else {
        echo "Hay errores";
    }
}
?>
<main>
    <div class="container">
        <div>
            <h2 class="d-flex justify-content-center mt-3">Editar publicación</h2>

            <a href="../index.php" class="btn btn-success">Volver</a>
        </div>
        <?php foreach ($errores as $error) : ?>
            <div class="container w-25 mt-4 alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form class="container w-25" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/layout/formulario_post.php'; ?>
            <input type="submit" value="Actualizar" class="btn btn-success" id="">
        </form>
    </div>
</main>