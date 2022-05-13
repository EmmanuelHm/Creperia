<?php if( isset($_SESSION['identity']) ): ?>

    <h1 class="text-white mb-4 text-center">Hacer Pedido</h1>
    <a href="<?=base_url?>carrito/index" class="btn inf">Ver los productos y el precio del pedido</a>

    <form action="<?=base_url?>pedido/add" id="form-dir" class="mt-4" method="POST">
        <h3 class="text-center fw-bold fs-1">Direccion de Envio</h3>

        <div class="mb-2">
            <label for="direccion" class="mb-3">Dirección:</label>
            <input type="text" name="direccion" class="form-control" required>
        </div>

        <div class="mb-2">
            <label for="colonia" class="mb-3">Colonia:</label>
            <input type="text" name="colonia" class="form-control" required>
        </div>

        <div class="mb-2">
            <label for="municipio" class="mb-3">Municipio:</label>
            <input type="text" name="municipio" class="form-control" required>
        </div>

        <div class="mb-2">
            <label for="telefono" class="mb-3">Telefono:</label>
            <input type="number" name="telefono" class="form-control" required>
        </div>

        <div class="mb-2 mt-5 d-flex justify-content-center">
            <input type="submit" value="Comprar" class="btn green">
        </div>
    </form>

<?php else: ?>

    <h1 class="text-white mb-4 text-center">Necesitas iniciar sesión</h1>
    <div class="alert alert-info text-center mt-5" role="alert">
        <h2>Registrate o ingresa a una cuenta para poder comprar.</h2>
        <a href="<?=base_url?>usuario/sesion" class="text-dark fs-4 text-decoration-underline">Ingresa Aquí</a>
    </div>

<?php endif; ?>