
<?php if( isset($_SESSION['admin'])): ?>
    <a href="<?=$_SERVER["HTTP_REFERER"]?>" class="btn red mt-4">Regresar</a>
<?php endif; ?>

<?php if( isset($edit) && isset($prod) && is_object($prod)):?>
    <?php $url_action = base_url."producto/save&id=".$prod->id; ?>
<?php else: ?>
    <?php $url_action = base_url."producto/save"; ?>
<?php endif; ?>

<form action="<?=$url_action?>" method="post" id="auth" enctype="multipart/form-data">
    
    <?php if( isset($edit) && isset($prod) && is_object($prod)):?>
        <h2>Editar Producto</h2>
    <?php else: ?>
        <h2>Crear Producto</h2>
    <?php endif; ?>

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?=isset($prod) &&  is_object($prod) ? $prod->nombre : ''; ?>" placeholder="Nombre:" required>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion">
        <?=isset($prod) && is_object($prod) ? trim($prod->descripcion) : ''; ?>
    </textarea>

    <label for="precio">Precio:</label>
    <input type="number" name="precio" value="<?=isset($prod) &&  is_object($prod) ? $prod->precio : ''; ?>" placeholder="Precio:" required>

    <label for="imagen">Imagen:</label>

    <?php if(isset($prod) &&  is_object($prod) && !empty($prod->imagen)): ?>
        <img src="<?=base_url?>uploads/products/<?=$prod->imagen?>" alt="<?=$prod->nombre?>" class="thumb">
    <?php endif; ?>

    <input type="file" name="imagen">

    <label for="categoria_id">Categoria:</label>
    <?php $categorias = Utils::showCategorias() ?>
    <select name="categoria_id">
        <?php while($cat = $categorias->fetch_object()):?>
            <option value="<?= $cat->id ?>" <?=isset($prod) &&  is_object($prod) && $cat->id == $prod->categoria_id ? 'selected' : ''; ?>>
                <?= $cat->nombre ?>
            </option>
        <?php endwhile; ?>
    </select>

    <?php if( isset($edit) && isset($prod) && is_object($prod) ): ?>
        <input type="submit" value="Editar">
    <?php else: ?>
        <input type="submit" value="Crear">
    <?php endif; ?>

</form>