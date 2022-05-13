<h1 class="text-white mb-4 text-center">Gestión de Categorías</h1>

<a href="<?=base_url?>categoria/form" class="btn green mb-4">
    Crear Categoría
</a>

<?php if($categorias->num_rows == 0): ?>
    <h1 class="mb-4 text-center text-danger">Aun no hay categorías</h1>
<?php else: ?>

    <div id="lista">

    <?php while( $categoria = $categorias->fetch_object()): ?>
    
        <div id="item">
            <?php if($categoria->imagen != null):?>
                <img src="<?=base_url?>uploads/categories/<?=$categoria->imagen?>" alt="<?=$categoria->nombre?>">
            <?php else:?>
                <img src="<?=base_url?>assets/images/no-user.jpg" alt="No user image">
            <?php endif; ?>
            <h2 class="text-center"><?=$categoria->nombre;?></h2>
            <br/>

            <div class="actions">
                <a href="<?=base_url?>categoria/editar&id=<?=$categoria->id?>" class="btn blue">Editar</a>
                <a href="<?=base_url?>categoria/eliminar&id=<?=$categoria->id?>" class="btn red">Eliminar</a>
            </div>
        </div>

    <?php endwhile; ?>

    </div>

<?php endif; ?>