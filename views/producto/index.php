<h1 class="text-white mb-4 text-center">Gestión de Productos</h1>

<a href="<?=base_url?>producto/form" class="btn green mb-4">
    Crear Producto
</a>

<?php if($productos->num_rows == 0): ?>
    <h1 class="mb-4 text-center text-danger">Aun no hay Productos</h1>
<?php else: ?>

    <div id="lista">

    <?php while( $producto = $productos->fetch_object()): ?>
    
        <div id="item">
            <?php if($producto->imagen != null):?>
                <img src="<?=base_url?>uploads/products/<?=$producto->imagen?>" alt="<?=$producto->nombre?>">
            <?php else:?>
                <img src="<?=base_url?>assets/images/no-user.jpg" alt="No user image">
            <?php endif; ?>
            <h2 class="text-center"><?=$producto->nombre;?></h2>
            <p><?=$producto->descripcion;?></p>
            <p class="text-center">
                <strong>$ <?=$producto->precio;?> m.x.</strong>
            </p>

            <div class="actions">
                <a href="<?=base_url?>producto/editar&id=<?=$producto->id?>" class="btn blue">Editar</a>
                <a href="<?=base_url?>producto/eliminar&id=<?=$producto->id?>" class="btn red">Eliminar</a>
            </div>
        </div>

    <?php endwhile; ?>

    </div>

<?php endif; ?>