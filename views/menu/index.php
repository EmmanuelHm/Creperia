<div id="categorias">
    <h2>Menú Categorías</h2>

    <?php while($categoria = $categorias->fetch_object()): ?>
        <a href="<?=base_url?>menu/listar&id=<?=$categoria->id?>" class="categoria">
            <h3><?= $categoria->nombre ?></h3>
            <?php if($categoria->imagen != null):?>
                <img src="<?=base_url?>uploads/categories/<?=$categoria->imagen?>" alt="<?=$categoria->nombre?>">
            <?php else:?>
                <img src="<?=base_url?>assets/images/no-user.jpg" alt="No user image">
            <?php endif; ?>
        </a>
    <?php endwhile; ?>

</div>