<h1 class="text-white mb-4 text-center">Carrito de Compras</h1>

<a href="<?=base_url?>menu/index" class="btn red mt-4 mb-5">Regresar al menu</a>

<?php if( isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1 ): ?>

    <div id="lista">

        <?php foreach($carrito as $indice => $elemento): 
            $producto = $elemento['producto'];
        ?>

        <div id="item">
            <?php if($producto->imagen != null):?>
                <img src="<?=base_url?>uploads/products/<?=$producto->imagen?>" alt="<?=$producto->nombre?>">
            <?php else:?>
                <img src="<?=base_url?>assets/images/no-user.jpg" alt="No user image">
            <?php endif; ?>
            <h2 class="text-center"><?=$producto->nombre;?></h2>
            <p class="text-center fs-5">Precio: $ <?=$producto->precio?> m.x.</p>
            <p class="text-center fs-3">Cantidad:</p>

            <div class="actions">
                <a href="<?=base_url?>carrito/up&index=<?=$indice?>" class="btn blue">+</a>
                <p><?=$elemento['unidades']?></p>
                <a href="<?=base_url?>carrito/down&index=<?=$indice?>" class="btn red">-</a>
            </div>
        </div>
            
        <?php endforeach; ?>

    </div>
<?php $stats = Utils::statsCarrito(); ?>
<div class="alert alert-light text-center mt-4" role="alert">
        <h2 class="fw-bold">Precio Total: $<?=$stats['total'];?> mx.</h2>
</div>

<div id="car-op">
    <a href="<?=base_url?>carrito/delete_all" class="btn red me-4 mt-3">Vaciar Carrito</a>
    <a href="<?=base_url?>pedido/hacer" class="btn green mt-3">Realizar Pedido</a>
</div>

<?php else: ?>
    <div class="alert alert-danger text-center mt-5" role="alert">
        <h2>El carrito esta vacio. Agrega algún producto</h2>
    </div>
<?php endif; ?>