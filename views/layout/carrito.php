<?php if( !isset($_SESSION['admin']) ): ?>

    <a href="<?=base_url?>carrito/index" id="cart">
        <?php $stats = Utils::statsCarrito(); ?>
        <img src="<?=base_url?>assets/icons/cart.svg" alt="cart">
        <p><?=$stats['count'];?></p>
    </a>

<?php endif; ?>