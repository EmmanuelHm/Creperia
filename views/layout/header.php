<!DOCTYPE php>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crepería Van Gogh</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
    <link rel="shortcut icon" href="<?=base_url?>assets/images/logo.svg" type="image/x-icon">
    <!-- Bootstrap5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div id="main">

        <!-- Menu -->
        <div id="menu">
            <div id="social-menu">
                <?php if( !isset($_SESSION['identity'])) : ?>
                    <p>Siguenos:</p>
                    <div id="icons-social">
                        <img src="<?=base_url?>assets/icons/ig.svg" alt="Instagram">
                        <img src="<?=base_url?>assets/icons/fb.svg" alt="Facebook">
                        <img src="<?=base_url?>assets/icons/wa.svg" alt="Whatsapp">
                    </div>
                <?php else: ?>
                    <p>
                        <?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellidos ?>
                    </p>
                <?php endif; ?>
            </div>
            
            <nav>
                <?php if( !isset($_SESSION['admin']) ): ?>
                    <a href="<?=base_url?>" id="brand-logo">
                        <img src="<?=base_url?>assets/images/logo.svg" alt="Crepería Van Gogh">
                    </a>
                <?php else: ?>
                    <a href="<?=base_url?>usuario/index" id="brand-logo">
                        <img src="<?=base_url?>assets/images/logo.svg" alt="Crepería Van Gogh">
                    </a>
                <?php endif; ?>

                <ul class="text-center d-flex align-items-center">
                    <?php if( !isset($_SESSION['admin']) ): ?>
                        <li><a href="<?=base_url?>">Inicio</a></li>
                        <?php if( !isset($_SESSION['identity']) ): ?>
                            <li><a href="<?=base_url?>historia/index">Historia</a></li>
                        <?php else: ?>
                            <li><a href="<?=base_url?>pedido/mis_pedidos">Mis Pedidos</a></li>
                        <?php endif; ?>
                        <li><a href="<?=base_url?>menu/index">Menú</a></li>
                        <li><a href="<?=base_url?>contacto/index">Contacto</a></li>
                    <?php else: ?>
                        <li><a href="<?=base_url?>usuario/index">Usuarios</a></li>
                        <li><a href="<?=base_url?>categoria/index">Categorias</a></li>
                        <li><a href="<?=base_url?>producto/index">Productos</a></li>
                        <li><a href="<?=base_url?>pedido/gestion">Ordenes</a></li>
                    <?php endif; ?>

                </ul>   
            </nav>
            
            <?php if( !isset($_SESSION['identity'])) : ?>
                <a href="<?=base_url?>usuario/sesion" id="sesion">
                    <div id="user-image">
                        <img src="<?=base_url?>assets/icons/profile.svg" alt="Profile">
                    </div>
                    <p>Mi Cuenta</p>
                </a>
            <?php else: ?>
                <a href="<?=base_url?>usuario/logout" id="sesion" class="text-danger">
                    <div id="user-image">
                        <img src="<?=base_url?>assets/icons/logout-exit.svg" alt="Logout">
                    </div>
                    <p>Salir</p>
                </a>
            <?php endif; ?>

        </div>

        <!-- Principal -->
        <main id="principal">