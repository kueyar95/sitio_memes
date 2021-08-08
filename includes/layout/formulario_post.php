

<div class="form-group">
    <label for="archivoPost">Seleccionar archivo</label>
    <input type="file" class="form-control-file" id="archivoPost" name="publicacion[archivoPost]" accept="image/png, .jpeg, .jpg, image/gif">
    <?php if($publicacion->archivoPost): ?>
        <img class="img-fluid" src="<?php echo '../../imagenes/' . sanitizar($publicacion->archivoPost);?>" alt="">
    <?php endif; ?>
</div>
<div class="form-group">
    <label for="descripcion">Descripción</label>
    <input type="text" class="form-control" id="descripcion" name="publicacion[descripcion]" value="<?php echo sanitizar($publicacion->descripcion); ?>">
</div>
<div class="form-group">
    <label for="tags">Tags</label>
    <input type="text" class="form-control" id="tags" name="publicacion[tags]" value="<?php echo sanitizar($publicacion->tags); ?>">
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" name="publicacion[checkSensitivo]" id="checkSensitivo" value="<?php echo sanitizar($publicacion->checkSensitivo);?>">
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