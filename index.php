<?php
session_start();
require 'includes/app.php';
//Importante: Los requires e include se hacen en base al index del directorio raíz
$db = conectarDb();

//Consultar
$query = "SELECT * FROM posts";
$resultado = mysqli_query($db, $query);

incluirTemplate('header', $inicio = true);
?>

<main class="container-xl d-flex justify-content-center px-0 mx-0">

  <?php incluirTemplate('sidebar_izquierda', $inicio = true); ?>
  <div class="container d-flex flex-column px-0 mx-0 px-sm-0 mx-sm-0 px-lg px-xl-3 mx-xl-3">
    <h2 class="d-flex justify-content-center">Contenido Principal</h2>
    <?php while ($post = mysqli_fetch_assoc($resultado)) : ?>
      <article class="mt-5">
        <div>
          <div class="header_post d-flex mx-2">
            <a href="#" class="mx-2">
              <img src="./public/build/img/imagen_perfil.webp" alt="" style="width: 20px; height: 20px" />
            </a>
            <p>Author del post</p>
          </div>
          <a href="./post.php?id=<?php echo $post['id']; ?>">
            <h3 class="mx-3"><?php echo $post['descripcion']; ?></h3>
          </a>
        </div>
        <a href="./post.php?id=<?php echo $post['id']; ?>">
        <div class="post_container bg-secondary d-flex justify-content-center">
          <img src="./imagenes/<?php echo $post['archivoPost']; ?>" class="img-fluid" alt="meme" />
        </div>
        </a>
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
    <hr />


  </div>
  <?php incluirTemplate('sidebar_derecha', $inicio = true); ?>
  <?php incluirTemplate('modalLogin', $inicio = true); ?>
</main>

<?php
incluirTemplate('footer', $inicio = true);
?>