
<a href="<?=$_SERVER["HTTP_REFERER"]?>" class="btn red mt-4">Regresar</a>

<h1 class="text-white mb-4 text-center"><?=$cat->nombre?></h1>

<?php if($productos->num_rows == 0): ?>
    <p>No hay Productos para mostrar</p>
<?php else: ?>

    <?php while ($prod = $productos->fetch_object()) : ?>

        <div class="producto">
            <div class="detalle">
                <h3><?=$prod->nombre?></h3>
                <p><?=$prod->descripcion?></p>
                <p>Precio: $ <?=$prod->precio?> m.x.</p>
                <a href="<?=base_url?>carrito/add&id=<?=$prod->id?>">Comprar</a>
            </div>
            <div class="image">
                <?php if($prod->imagen != null):?>
                    <img src="<?=base_url?>uploads/products/<?=$prod->imagen?>" alt="<?=$prod->nombre?>">
                <?php else:?>
                    <img src="<?=base_url?>assets/img/logo.png" alt="Imagen Producto">
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>

<?php endif; ?>