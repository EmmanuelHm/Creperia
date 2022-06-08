<h1 class="text-white mb-4 text-center">Resultados sobre: <?=$search?></h1>

<?php if($productos->num_rows >= 1): ?>

    <div id="productos">

        <?php while ($prod = $productos->fetch_object()) : ?>
            <div class="card">
                <?php if($prod->imagen != null):?>
                    <img src="<?=base_url?>uploads/products/<?=$prod->imagen?>" alt="<?=$prod->nombre?>">
                <?php else:?>
                    <img src="<?=base_url?>assets/img/logo.png" alt="Imagen Producto">
                <?php endif; ?>
                <h3><?=$prod->nombre?></h3>
                <p><?=$prod->descripcion?></p>
                <h5>Categoría: <strong><?=$prod->categoria?></strong></h5>
                <p>
                    <strong>$ <?=$prod->precio?> m.x.</strong>
                </p>
                <a href="<?=base_url?>carrito/add&id=<?=$prod->id?>">Comprar</a>
            </div>
        <?php endwhile ?>

    </div>

<?php else: ?>
    <div class="alert alert-danger text-center mt-5" role="alert">
        <h2>No se encontro nungún resultado.</h2>
        <a href="<?=base_url?>" class="btn btn-danger btn-sm mt-3">Regresar al inicio</a>
    </div>
<?php endif; ?>