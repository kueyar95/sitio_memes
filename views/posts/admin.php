<main class="container-xl">
    <div class="d-flex justify-content-center"></div>
    <h2 class="d-flex justify-content-center">Administrador de Publicaciones</h2>

    <?php
    if($resultado){
        $mensaje = mostrarNotificaciones(intval($resultado));
        if ($mensaje) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo sanitizar($mensaje); ?>
            </div>
    <?php } } ?>


    <a href="crear" class="btn btn-success">Crear post</a>
    <!-- Listado de publicaciones creadas por el usuario -->
    <div class="contenedor">
        <h3 class="d-flex justify-content-center">Publicaciones tuyas</h3>
        <div class="container d-flex flex-column px-0 mx-0 px-sm-0 mx-sm-0 px-lg px-xl-3 mx-xl-3">

            <?php foreach ($posts as $post) : ?>
                <article>
                    <!--Header de la publicación -->
                    <div>
                        <div class="header_post d-flex mx-2 mt-4">
                            <a href="#" class="mx-2">
                                <img src="../public/build/img/imagen_perfil.webp" alt="" style="width: 20px; height: 20px" />
                            </a>
                            <p><?php echo $post->nombreUsuarioPost; ?></p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="#">
                                <h3 class="mx-3"><?php echo $post->descripcion; ?></h3>
                            </a>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <form method="POST" class="mx-2" action="/posts/eliminar">
                                            <input type="hidden" name="id" value="<?php echo $post->id; ?>">
                                            <input type="submit" class="border-0 bg-white" value="Eliminar">
                                        </form>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/posts/editar?id=<?php echo $post->id; ?>">Editar</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Descargar</a>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Body de la publicación -->
                    <div class="post_container bg-secondary d-flex justify-content-center">
                        <img src="../imagenes/<?php echo $post->archivoPost; ?>" class="img-fluid" alt="meme" />
                    </div>
                    <!-- Footer de la publicación -->
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
            <?php endforeach; ?>
        </div>
    </div>

</main>
