<?php require 'includes/app.php';
      incluirTemplate('header', $inicio = true);
?>

  <main class="container-xl d-flex justify-content-center px-0 mx-0">
  
  <?php incluirTemplate('sidebar_izquierda', $inicio = true); ?>
    <div class="container d-flex flex-column px-0 mx-0 px-sm-0 mx-sm-0 px-lg px-xl-3 mx-xl-3">
      <h2 class="d-flex justify-content-center">Contenido Principal</h2>
      <article>
        <div>
          <div class="header_post d-flex mx-2">
            <a href="#" class="mx-2">
              <img src="./img/imagen_perfil.webp" alt="" style="width: 20px; height: 20px" />
            </a>
            <p>Author del post</p>
          </div>
          <a href="#">
            <h3 class="mx-3">Memazo</h3>
          </a>
        </div>

        <div class="post_container bg-secondary d-flex justify-content-center">
          <img src="./img/105192300_10224356452958140_2819783552494851991_n.png" class="img-fluid" alt="meme" />
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
      <hr />
      <article>
        <div>
          <div class="header_post d-flex mx-2">
            <a href="#" class="mx-2">
              <img src="./img/imagen_perfil.webp" alt="" style="width: 20px; height: 20px" />
            </a>
            <p>Author del post</p>
          </div>
          <a href="#">
            <h3 class="mx-3">Memazo2</h3>
          </a>
        </div>

        <div class="post_container d-flex justify-content-center">
          <img src="./img/105373701_1186993761648814_2279444911623149423_o.jpg" class="img-fluid" alt="meme2" />
        </div>
        <div class="mt-2 post_afterbar border rounded rounded-lg">
          <button type="button" class="btn btn-outline-success" id="btn_up">
            <i class="fas fa-arrow-up"></i>
          </button>
          <button type="button" class="btn btn-outline-danger" id="btn_down">
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
      <hr />
      <article>
        <div>
          <div class="header_post d-flex mx-2">
            <a href="#" class="mx-2">
              <img src="./img/imagen_perfil.webp" alt="" style="width: 20px; height: 20px" />
            </a>
            <p>Author del post</p>
          </div>
          <a href="#">
            <h3 class="mx-3">Memazo3</h3>
          </a>
        </div>
        <div class="post_container d-flex justify-content-center bg-secondary">
          <img src="./img/30728258_1718374458254884_1041249644786483200_n.jpg" class="img-fluid" alt="meme3" />
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
    </div>
    <?php incluirTemplate('sidebar_derecha', $inicio = true); ?>
    <?php incluirTemplate('modalLogin', $inicio = true); ?>
  </main>
 
  <?php
    incluirTemplate('footer', $inicio = true);
  ?>