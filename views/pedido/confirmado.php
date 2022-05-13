<?php if( isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'Complete' ): ?>

<h1 class="text-white mb-5 text-center">¡Gracias por comprar con nosotros!</h1>

<?php if(isset($pedido)): ?>

    <div class="alert alert-primary shadow" role="alert">
        <h2 class="fw-bold fs-1 text-decoration-underline">Datos del pedido</h2>
        <p>
            <span class="fst-italic fw-bold fs-4">Número pedido:</span> <span class="fs-4"><?= $pedido->id?> </span> 
        </p>
        <p>
            <span class="fst-italic fw-bold fs-4">Total a pagar:</span> <span class="fs-4">$<?= $pedido->total?> </span>
        </p>
    </div>

    <h2 class="text-white mb-5 text-decoration-underline shadow-text">Productos:</h2>

    <div id="lista">

        <?php while( $producto = $productos->fetch_object()): ?>
        
            <div id="item" class="text-center">
                <?php if($producto->imagen != null):?>
                    <img src="<?=base_url?>uploads/products/<?=$producto->imagen?>" alt="<?=$producto->nombre?>">
                <?php else:?>
                    <img src="<?=base_url?>assets/images/no-user.jpg" alt="No user image">
                <?php endif; ?>
                <h2 ><?=$producto->nombre;?></h2>
                <p>Precio: $<?=$producto->precio?> m.x.</p>
                <p>Cantidad: <?=$producto->cantidad?></p>
            </div>

        <?php endwhile; ?>

    </div>

    <div class="mt-5 d-flex justify-content-center">
        <a href="<?=base_url?>menu/index" class="btn red me-3">Ir al menu</a>
        <a href="<?=base_url?>" class="btn green me-3">Ir al inicio</a>
        <a href="<?=base_url?>pedido/mis_pedidos" class="btn inf">Ver mis pedidos</a>
    </div>

<?php endif; ?>

<?php elseif( isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'Complete' ): ?>

    <h1 class="text-white mb-5 text-center">No se hizo el pedido</h1>
    <div class="alert alert-danger" role="alert">
        <h2>No se ha podido procesar su pedido</h2>
        <a href="<?=base_url?>" class="text-decoration-underline">Ir al inicio</a>
    </div>

<?php endif; ?>