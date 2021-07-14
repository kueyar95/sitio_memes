<?php
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    
    if (!$id) {
        header('Location: /Sitio_memes/ ');
    }
    require 'includes/app.php';

    $db = conectarDb();

    //Consultar
    $query = "SELECT * FROM post WHERE id = ${id}";
    $resultadoConsulta = mysqli_query($db, $query);

    //Si no existe publicación, llevará a la página principal automaticamente
    if($resultadoConsulta->num_rows === 0){
        header('Location: /Sitio_memes/ ');
    }

    incluirTemplate('header', $inicio = true);
?>

<main class="container-xl d-flex justify-content-center px-0 mx-0">
    <div class="contenedor">
        <h3 class="d-flex justify-content-center">Publicaciones tuyas</h3>
        <div class="container d-flex flex-column px-0 mx-0 px-sm-0 mx-sm-0 px-lg px-xl-3 mx-xl-3">
            <?php while ($post = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <article>
                    <div>
                        <div class="header_post d-flex mx-2">
                            <a href="#" class="mx-2">
                                <img src="./public/build/img/imagen_perfil.webp" alt="" style="width: 20px; height: 20px" />
                            </a>
                            <p>Author del post</p>
                        </div>


                        <div class="d-flex justify-content-between">
                            <a href="#">
                                <h3 class="mx-3"><?php echo $post['descripcion']; ?></h3>
                            </a>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <form method="POST" class="mx-2">
                                            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                                            <input type="submit" class="border-0 bg-white" value="Eliminar">
                                        </form>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="./post/editar.php?id=<?php echo $post['id']; ?>">Editar</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Descargar</a>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="post_container bg-secondary d-flex justify-content-center">
                        <img src="./imagenes/<?php echo $post['nombreArchivo']; ?>" class="img-fluid" alt="meme" />
                    </div>
                    <div class="mt-2 post_afterbar border rounded rounded-lg">
                        <button class="btn btn-outline-success" id="btn_up">
                            <i class="fas fa-arrow-up"></i>
                        </button>
                        <button class="btn btn-outline-danger" id="btn_down">
                            <i class="fas fa-arrow-down"></i>
                        </button>
                        <button class="btn" id="comentario">
                            <i class="fas fa-comment-alt"></i>
                        </button>
                        <button class="btn" id="compartir">
                            <i class="fas fa-share-alt"></i>
                        </button>
                    </div>

                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>