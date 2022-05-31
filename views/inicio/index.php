
<div id="banner">
    <div class="image">
        <img src="<?=base_url?>assets/images/crepa.png">
    </div>
    <div class="info">
        <h2 class="fs-1">
            <strong>¡Bienvenidos!</strong>
        </h2>
        <p class="mt-4 text-center">
            En Crepería Van Gogh podrás encontrar una gran variedad de ricos postres y bebidas frías o calientes para todos los gustos.
            <br/>
            Deleita tu paladar con nuestra deliciosa crepa "Noches Estrellada".
            <br/>
            ¡La especialidad de la casa!
        </p>
    </div>
</div>

<div id="productos">

    <h2 class="mb-5 text-center">
        <strong>Productos Destacados</strong>
    </h2>

    <?php while ($prod = $productos->fetch_object()) : ?>
        <div class="card">
            <?php if($prod->imagen != null):?>
                <img src="<?=base_url?>uploads/products/<?=$prod->imagen?>" alt="<?=$prod->nombre?>">
            <?php else:?>
                <img src="<?=base_url?>assets/img/logo.png" alt="Imagen Producto">
            <?php endif; ?>
            <h3><?=$prod->nombre?></h3>
            <p><?=$prod->descripcion?></p>
            <p>
                <strong>$ <?=$prod->precio?> m.x.</strong>
            </p>
            <a href="<?=base_url?>carrito/add&id=<?=$prod->id?>">Comprar</a>
        </div>
    <?php endwhile ?>

</div>