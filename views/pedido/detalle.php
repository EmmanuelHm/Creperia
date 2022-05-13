<h1 class="text-white mb-5 text-center">Detalle del Pedido</h1>

<?php if(isset($pedido)): ?>

    <?php if( isset($_SESSION['admin']) ): ?>
        <a href="<?=base_url?>pedido/gestion" class="btn red mb-4">
            Regresar a ordenes
        </a>
    <?php else: ?>
        <a href="<?=base_url?>pedido/mis_pedidos" class="btn red mb-4">
            Regresar a mis pedidos
        </a>
    <?php endif; ?>


    <div id="pedido-info" class="text-center">
        <h3 class="text-decoration-underline fs-2">Dirección de envio</h3>
        <p>Direccion: <?= $pedido->direccion?></p>
        <p>Colonia: <?= $pedido->colonia?></p>
        <p>Municipio: <?= $pedido->municipio?></p>
        <p>Telefono: <?= $pedido->telefono?> </p>

        <h3 class="text-decoration-underline fs-2 mt-3">Datos del pedido</h3>
        <p class="fs-5">Estado: <strong> <?= Utils::showStatus($pedido->estatus) ?> </strong></p>
        <p>Número de pedido: <?= $pedido->id?></p>
        <p>Total a pagar: <strong>$<?= $pedido->total?></strong></p>

        <?php if( isset($_SESSION['admin']) ): ?>
            <h3>Cambiar estado del pedido</h3>

            <form action="<?=base_url?>pedido/estado" method="POST">
                <input type="hidden" value="<?=$pedido->id?>" name="pedido_id"/>

                <select name="estado" class="mt-2">
                    <option value="confirm" <?=$pedido->estatus == "confirm" ? 'selected' : '' ?> >
                        Pendiente
                    </option>
                    <option value="preparation" <?=$pedido->estatus == "preparation" ? 'selected' : '' ?> >
                        En preparación
                    </option>
                    <option value="ready" <?=$pedido->estatus == "ready" ? 'selected' : '' ?> >
                        Peparado para el envio
                    </option>
                    <option value="sended" <?=$pedido->estatus == "sended" ? 'selected' : '' ?> >
                        Enviado
                    </option>
                </select>

                <input type="submit" value="Cambiar estado" class=" btn inf mt-3"/>
            </form>
        <?php endif; ?>

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

<?php endif; ?>