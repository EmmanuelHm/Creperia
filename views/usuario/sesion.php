<form action="<?=base_url?>usuario/login" method="post" id="auth">

    <h2>Iniciar Sesión</h2>

    <?php if( isset($_SESSION['register']) && $_SESSION['register'] == "Complete" ): ?>
        <strong class="alert green">Registro completado correctamente.</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('register')?>

    <?php if( isset($_SESSION['error_login']) ): ?>
        <strong class="alert red">No se pudo iniciar sesion. Revise sus credenciales.</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('error_login')?>

    <input type="email" name="email" placeholder="Correo Electronico">

    <input type="password" name="password" placeholder="Password">

    <input type="submit" value="Ingresar">

    <a href="<?=base_url?>usuario/registro">Aún no tengo una cuenta.</a>

</form>