<h1 class="text-white mb-4 text-center">Gestión de Usuarios</h1>

<a href="<?=base_url?>usuario/registro" class="btn green mb-4">
    Crear Usuario
</a>

<div id="lista">

    <?php while( $usuario = $usuarios->fetch_object()): ?>
    
        <div id="item" class="text-center">
            <?php if($usuario->imagen != null):?>
                <img src="<?=base_url?>uploads/users/<?=$usuario->imagen?>" alt="<?=$usuario->nombre?>">
            <?php else:?>
                <img src="<?=base_url?>assets/images/no-user.jpg" alt="No user image">
            <?php endif; ?>
            <h3><?=$usuario->nombre;?> <?=$usuario->apellidos;?></h3>
            <p><?=$usuario->email;?></p>
            <p>
                <strong>Rol: <?=$usuario->rol;?></strong>
            </p>

            <div class="actions">
                <a href="<?=base_url?>usuario/editar&id=<?=$usuario->id?>" class="btn blue">Editar</a>
                <a href="<?=base_url?>usuario/eliminar&id=<?=$usuario->id?>" class="btn red">Eliminar</a>
            </div>
        </div>

    <?php endwhile; ?>

</div>