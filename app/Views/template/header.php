<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>La/Micha</title>
    <!-- Favicon-->
    <link rel="icon" type="image/svg" href="assets/img/bag.svg" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!--SweetAlerts-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--jQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= base_url() ?>css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <img src="assets/img/bag.svg" class="mr-2" style="width: 30px; height: auto;">
            <a class="navbar-brand" href="#page-top">La/Micha</a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="<?php echo base_url('listar_productos') ?>">Productos</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="<?php echo base_url('verCarrito') ?>"><i class="fa-solid fa-cart-shopping"></i><span id="num_cart" class="badge bg-secondary">
                                <?php echo session()->get('num_cart') ?? 0; ?>
                            </span></a></li>
                    <li class="nav-item mx-0 mx-lg-1 dropdown">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                            <span class="badge bg-secondary"><?php $user = session()->get('user'); if($user != null){ echo $user;}else{ echo 'INICIAR/REGISTRATE';} ?></span>
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                            <?php if (session()->get('iniciado') == 0) { ?>
                                <li><a class="dropdown-item" href="<?php echo base_url('iniciar') ?>">Iniciar sesión</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('registrar') ?>">Registrar</a></li>
                            <?php } else { ?>
                                <li><a class="dropdown-item" href="<?php echo base_url('salir') ?>">Cerrar Sesión</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center">
        <class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <img class="masthead-avatar mb-5" src="assets/img/logo_principal.svg" alt="..." />
            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0">La/Micha</h1>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fa-solid fa-tag"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Masthead Subheading-->
            <p class="masthead-subheading font-weight-light mb-0">Todos - Los Productos al - 50%</p>
            <p style="text-align: center; margin: 0 auto; width: 50%;">Somos una tienda reconocida por tener la mayoría de nuestros productos a un con descuento, a muy buena calidad, entre otros reacondicionados. Podrás encontrar gran variedad de consolas, celulares, entre otros dispositivos electrónicos. Puedes registrarte para luego iniciar sesión y añadir los productos de tu agrado al carrito. <br> Gracias por visitarnos.</p>
            </div>
    </header>