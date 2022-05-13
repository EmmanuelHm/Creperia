
<?php if( isset($_SESSION['admin'])): ?>
    <a href="<?=$_SERVER["HTTP_REFERER"]?>" class="btn red mt-4">Regresar</a>
<?php endif; ?>

<?php if( isset($edit) && isset($cat) && is_object($cat)):?>
    <?php $url_action = base_url."categoria/save&id=".$cat->id; ?>
<?php else: ?>
    <?php $url_action = base_url."categoria/save"; ?>
<?php endif; ?>

<form action="<?=$url_action?>" method="post" id="auth" enctype="multipart/form-data">
    
    <?php if( isset($edit) && isset($cat) && is_object($cat)): ?>
        <h2>Editar Categoría</h2>
    <?php else: ?>
        <h2>Crear Categoría</h2>
    <?php endif; ?>

    <input type="text" name="nombre" value="<?=isset($cat) &&  is_object($cat) ? $cat->nombre : ''; ?>" placeholder="Nombre:" required>

    <label for="imagen">Imagen:</label>

    <?php if(isset($cat) &&  is_object($cat) && !empty($cat->imagen)): ?>
        <img src="<?=base_url?>uploads/categories/<?=$cat->imagen?>" alt="<?=$cat->nombre?>" class="thumb">
    <?php endif; ?>

    <input type="file" name="imagen">
    
    <?php if( isset($edit) && isset($cat) && is_object($cat) ): ?>
        <input type="submit" value="Editar">
    <?php else: ?>
        <input type="submit" value="Crear">
    <?php endif; ?>

</form>