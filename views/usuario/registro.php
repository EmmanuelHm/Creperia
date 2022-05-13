
<?php if( isset($_SESSION['admin'])): ?>
    <a href="<?=$_SERVER["HTTP_REFERER"]?>" class="btn red mt-4">Regresar</a>
<?php endif; ?>

<?php if( isset($edit) && isset($user) && is_object($user)):?>
    <?php $url_action = base_url."usuario/save&id=".$user->id; ?>
<?php else: ?>
    <?php $url_action = base_url."usuario/save"; ?>
<?php endif; ?>

<form action="<?=$url_action?>" method="post" id="auth" enctype="multipart/form-data">
    
    <?php if( !isset($_SESSION['admin']) ): ?>
        <h2>Registrarse</h2>

    <?php elseif( isset($edit) && isset($user) && is_object($user)):?>
        <h2>Editar Usuario</h2>
    <?php else: ?>
        <h2>Crear Usuario</h2>
    <?php endif; ?>

    <?php if( isset($_SESSION['register']) && $_SESSION['register'] == "Complete" ): ?>
        <strong class="alert green">Registro completado correctamente.</strong>
    <?php elseif( isset($_SESSION['register']) && $_SESSION['register'] == "Failed" ): ?>
        <strong class="alert red">Registro fallido. El email ya existe en la BD.</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('register')?>

    <input type="text" name="nombre" value="<?=isset($user) &&  is_object($user) ? $user->nombre : ''; ?>" placeholder="Nombre:" required>

    <input type="text" name="apellidos" value="<?=isset($user) &&  is_object($user) ? $user->apellidos : ''; ?>" placeholder="Apellidos:" required>

    <input type="email" name="email" value="<?=isset($user) &&  is_object($user) ? $user->email : ''; ?>" placeholder="Correo:" required>

    <label for="imagen">Imagen:</label>

    <?php if(isset($user) &&  is_object($user) && !empty($user->imagen)): ?>
        <img src="<?=base_url?>uploads/users/<?=$user->imagen?>" alt="<?=$user->nombre?>" class="thumb">
    <?php endif; ?>

    <input type="file" name="imagen">

    <?php if( isset($edit) && isset($user) && is_object($user) ):?>

        <label for="rol">Rol:</label>
        <select name="rol">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
    
    <?php endif; ?>

    <input type="password" name="password" placeholder="Contraseña:" required>


    <?php if( !isset($_SESSION['admin']) ): ?>
        <input type="submit" value="Registrarse">
        <a href="<?=base_url?>usuario/sesion">Ya tengo una cuenta.</a>
    
    <?php elseif( isset($edit) && isset($user) && is_object($user) ): ?>
        <input type="submit" value="Editar">
    <?php else: ?>
        <input type="submit" value="Crear">
    <?php endif; ?>

</form>