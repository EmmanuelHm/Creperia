<?php if( isset($gestion) ): ?>
    <h1 class="text-white mb-5 text-center">Gestionar Pedidos</h1>
<?php else :?>
    <h1 class="text-white mb-5 text-center">Mis Pedidos</h1>
<?php endif; ?>

<table class="table text-center table-dark table-striped table-hover">

    <thead class="fs-4">
        <tr>
            <th scope="col">N° pedido</th>
            <th scope="col">Costo</th>
            <th scope="col">Fecha</th>
            <th scope="col">Estado</th>
            <th scope="col">Ver</th>
        </tr>
    </thead>

    <tbody class="fs-5">

    <?php while( $pedido = $pedidos->fetch_object() ):?>
        <tr>
            <td><?=$pedido->id?></td>
            <td>$<?= $pedido->total ?></td>
            <td><?= $pedido->fecha ?></td>
            <td><?= Utils::showStatus($pedido->estatus) ?></td>
            <td>
                <a href="<?=base_url?>pedido/detalle&id=<?=$pedido->id?>" class="btn green btn-sm">
                    Ver Pedido
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>