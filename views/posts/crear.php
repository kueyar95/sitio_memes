<div>
    <h2 class="d-flex justify-content-center mt-3">Crear publicación</h2>
    <?php foreach ($errores as $error) : ?>
            <div class="container w-25 mt-4 alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
    <?php endforeach; ?>
    <a href="/posts/admin" class="btn btn-success">Volver</a>
    <form class="container w-25" method="POST" enctype="multipart/form-data">
            <?php include __DIR__ . './formulario.php'; ?>
        <input type="submit" value="Publicar" class="btn btn-success" id="btnPost">
    </form>
</div>