<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//ob_start();
session_start();
require_once('assest/php/Database.php');
$_SESSION['confC'] = 0;
$_SESSION['confConsec'] = 0;
?>
<?php

if (isset($_POST['btn-login'])) {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $db = Database::getInstance();
    $conn = $db->getConnection();

    $query = "SELECT idUsuario, nombre,apellido, foto,password FROM usuario WHERE email= '$correo' and password = MD5($password) ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    //mysqli_close($conn);
    if ($count > 0) {
        $_SESSION['user'] = $row['idUsuario'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['apellido'] = $row['apellido'];
        $_SESSION['foto'] = $row['foto'];
        //header("Location: ../indexBo.php");
    } elseif ($count == 1) {
        //$errMSG = "Password incorrecto";
        echo "<script> alert('Password incorrecto')</script>"; 
    } else echo "<script> alert('Usuario no Encontrado')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina de Inicio</title>
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
    <link rel="shorcut icon" type="image/x-icon" href="assest/images/favicon.ico">
    <link rel="stylesheet" href="assest/css/normalize.css">
    <link rel="stylesheet" href="assest/css/fontawesome.min.css">
    <script defer src="assest/js/fontawesome-all.js"></script>
    <link rel="stylesheet" href="assest/css/bootstrap.min.css">
    <link rel="stylesheet" href='assest/css/animate.min.css'>
    <link rel="stylesheet" href="assest/css/main.css">
</head>

<body>
    <!--INICIO DE VENTANAS MODALES-->
    <div class="modal" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModalTitle">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content menuMovil">
                <ul class="menuPrin">
                    <li class="menuPrin__item"><a href="index.php" class="active">Inicio</a></li>
                    <li class="menuPrin__item"><a href="capacitacion.php">Capacitacion</a></li>
                    <li class="menuPrin__item"><a href="#">Gestor de Recursos</a></li>
                    <li class="menuPrin__item"><a href="#">Foro</a></li>
                    <li class="menuPrin__item"><a href="#">Consejos</a></li>
                </ul>

                <?php
                if (isset($_SESSION['user'])) {?>
                <ul class="menuAcceso nav navbar-nav ">
                    <li class="dropdown ">
                        <div class="text-center  menuUser dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <figure class="menuUser__img ml-5">
                                <img src="assest/images/<?=$_SESSION['foto'];?>" alt="Ramiro">
                                <p class="mt-3">
                                    <?= $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?>
                                </p>
                            </figure>
                        </div>
                        <ul class="menuAcceso dropdown-menu">
                            <li><a href="assest/php/salir.php?logout" class="colorb"><i class="fas fa-sign-out-alt"></i>Salir</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <?php    
                } else {?>
                <ul class="menuAcceso">
                    <li class="menuAcceso__item"><a href="#" class="btn--blancoTransparente js-login" data-dismiss="modal"
                            data-toggle="modal" data-target="#myModalEntrar">Entrar</a></li>
                    <li class="menuAcceso__item"><a href="#" class="btn--amarilloClaro js-registro" data-dismiss="modal"
                            data-toggle="modal" data-target="#myModal">Regístrate</a></li>
                </ul>
                <?php
                }
                ?>

                <button class="btn-cerrar" data-dismiss="modal"><i class="fas fa-times"></i><span>Cerrar</span></button>
            </div>
        </div>
    </div>

    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content my-modal-content ">
                <div class="modal-header my-modal-header">

                    <h5 class="modal-title text-center" id="exampleModalLabel">Crea una cuenta en GHAMA para acceder a
                        todos los temas.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="assest/php/usuarios/guardar.php" method="POST">
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text inputS"><i class="fas fa-user"></i></div>
                                    </div>
                                    <input type="text" class="form-control inputS" name="nombre" placeholder="Nombre" required pattern="[A-Za-z0-9]{5,40}" title="Letras y números. Tamaño mínimo: 5. Tamaño máximo: 40">
                                </div>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control inputS" name="apellido" placeholder="Apellido"
                                    required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text inputS"><i class="fas fa-envelope"></i></div>
                                    </div>
                                    <input type="email" class="form-control inputS" name="correo" placeholder="Correo Electrónico"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text inputS"><i class="fas fa-envelope"></i></div>
                                    </div>
                                    <input type="email" class="form-control inputS" name="correoc" placeholder="Confirmar Correo Electrónico"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text inputS"><i class="fas fa-lock"></i></div>
                                    </div>
                                    <input type="password" class="form-control inputS" name="password" placeholder="Contraseña"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text inputS"><i class="fas fa-lock"></i></div>
                                    </div>
                                    <input type="password" class="form-control inputS" name="passwordc" placeholder="Confirmar Contraseña"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text inputS"><i class="fas fa-address-card"></i></div>
                                    </div>
                                    <input type="text" class="form-control inputS" name="ci" placeholder="C.I" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text inputS"><i class="fas fa-phone"></i></div>
                                    </div>
                                    <input type="text" class="form-control inputS" name="telefono" placeholder="Telefono"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text inputS"><i class="fas fa-mobile-alt"></i></div>
                                    </div>
                                    <input type="text" class="form-control inputS" name="cel" placeholder="Celular"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text inputS"><i class="fas fa-map-marker"></i></div>
                                    </div>
                                    <input type="text" class="form-control inputS" name="direccion" placeholder="Direccion"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text inputS"><i class="fas fa-user-md"></i></div>
                                    </div>
                                    <input type="text" class="form-control inputS" name="ocupacion" placeholder="Ocupacion"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text inputS"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="date" class="form-control inputS" name="fechaNac" placeholder="Fecha de Nacimiento"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col text-center">
                                <button class=" btn my-btn" type="submit">Crear cuenta
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <p class="text-center px-5 text">Al crear tu cuenta aceptas nuestros Terminos y
                                    Condiciones</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between my-footer">
                    <span>¿Ya tienes cuenta?</span>
                    <a href="#" class="btn bgc px-3 " data-toggle="modal" data-target="#myModalEntrar" data-dismiss="modal">Entrar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="myModalEntrar" tabindex="-1" role="dialog" aria-labelledby="myModalEntrarLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content my-modal-content ">
                <div class="modal-header my-modal-header ">
                    <h5 class="modal-title offset-5" id="myModalEntrarLabel">ENTRAR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" method="post">
                        <div class="form-row mx-3">
                            <div class="col">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text inputS"><i class="fas fa-envelope"></i></div>
                                    </div>
                                    <input type="email" class="form-control inputS" placeholder="Correo Electrónico"
                                        required name="correo">
                                </div>
                            </div>
                        </div>
                        <div class="form-row mx-3">
                            <div class="col">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text inputS"><i class="fas fa-lock"></i></div>
                                    </div>
                                    <input type="password" class="form-control inputS" placeholder="Contraseña"
                                        required name="password">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col text-center">
                                <button class=" btn my-btn" type="submit" name="btn-login">Entrar
                                    <i class="fas fa-chevron-circle-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <p class="text-center px-5 text">¿Olvidaste tu contraseña?</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between my-footer">
                    <span>¿No tienes Cuenta ?</span>
                    <a href="#" class="btn bgc px-3" data-toggle="modal" data-target="#myModal" data-dismiss="modal">Registrate</a>
                </div>
            </div>
        </div>
    </div>
    <!--FIN DE VENTANAS MODALES-->
    <!--INICIO DE BARRA DE NAVEGACION-->
    <?php
    if (isset($_SESSION['user'])) {  /*MENU CON SESION*/?>
    <nav class="my-nav w-100 navbar navbar-expand-lg px-5" id="navsticky">
        <a class="navbar-brand custom-navbar-brand" href="#">
            <img src="assest/images/NuevoLogo.png" alt="Logo GHAMA"></a>
        <button class="navbar-toggler custom-toggler " type="button" data-toggle="modal" data-target="#menuModal"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
            <ul class="navbar-nav hover mr-5">
                <li class="nav-item active d-flex align-items-center  ">
                    <a class="nav-link px-3 " href="index.php">Inicio</span></a>
                </li>
                <li class="nav-item d-flex align-items-center ">
                    <a class="nav-link px-3" href="capacitacion.php">Capacitacion</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link px-3" href="#">Recursos</a>
                </li>
                <li class="nav-item d-flex align-items-center ">
                    <a class="nav-link px-3" href="#">Foro</a>
                </li>
                <li class="nav-item d-flex align-items-center ">
                    <a class="nav-link px-3" href="#">Consejos</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <div class="menuUser dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <figure class="menuUser__img">
                            <img src="assest/images/<?= $_SESSION['foto'];?>" alt="<?= $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?>">
                            <p class="mt-3">
                                <?= $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?>
                            </p>
                        </figure>
                    </div>
                    <ul class="dropdown-menu">
                        <li><a href="assest/php/salir.php?logout" class="colorv"><i class="fas fa-sign-out-alt ml-4"></i>Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>


        </div>
    </nav>
    <?php
    } else {?>
    <nav class="my-nav w-100 navbar navbar-expand-lg px-5" id="navsticky">
        <a class="navbar-brand custom-navbar-brand" href="#"><img src="assest/images/NuevoLogo.png" alt="Logo GHAMA"></a>
        <button class="navbar-toggler custom-toggler " type="button" data-toggle="modal" data-target="#menuModal"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
            <ul class="navbar-nav hover mr-5">
                <li class="nav-item active d-flex align-items-center  ">
                    <a class="nav-link px-3" href="#">Inicio</span></a>
                </li>
                <li class="nav-item d-flex align-items-center ">
                    <a class="nav-link px-3" href="capacitacion.php">Capacitacion</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link px-3" href="#">Recursos</a>
                </li>
                <li class="nav-item d-flex align-items-center ">
                    <a class="nav-link px-3" href="#">Foro</a>
                </li>
                <li class="nav-item d-flex align-items-center ">
                    <a class="nav-link px-3" href="#">Consejos</a>
                </li>
            </ul>
            <ul class="navbar-nav NHover">
                <li class="nav-item active d-flex align-items-center mr-2">
                    <a class="nav-link px-3 bgc" href="#" data-toggle="modal" data-target="#myModalEntrar">Entrar</span></a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link px-3 bgcr" href="#" data-toggle="modal" data-target="#myModal">Registrate</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php    
    }
    ?>


    <!--FIN DE BARRA DE NAVEGACION-->
    <!--INICIO DEL HEADER-->
    <header class="headerhome">

        <div id="carouselExampleSlidesOnly" class="my-carousel carousel slide carousel-fade d-none d-md-block d-lg-block"
            data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img d-block w-100" src="assest/images/s3F.jpg" salt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="img d-block w-100" src="assest/images/s8.jpg" alt="Second slide">
                </div>
            </div>
        </div>
        <div id="carouselExampleSlidesOnly" class="my-carousel carousel slide carousel-fade d-block d-md-none d-lg-none"
            data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img d-block w-100" src="assest/images/s2F_Mobile.jpg" salt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="img d-block w-100" src="assest/images/s8_Mobile.jpg" alt="Second slide">
                </div>
            </div>
        </div>
        <div class="tituloXL d-none d-lg-block d-md-block">
            <h3 class="text-center"> ¿Que es lo que tienes que saber de la inseguridad ciudadana ? </h3>
        </div>
        <div class="container d-block d-sm-none d-md-none contenido">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-center">¿Que es lo que tienes que saber de la inseguridad ciudadana ?</h3>
                </div>
            </div>
        </div>


        <div class="card-deck contenidocard d-none d-sm-flex d-lg-flex">
            <div class="card cardb">
                <img src="assest/images/icon.svg" class="card-img-top" alt="" height="100">
                <div class="card-body">
                    <h3 class="card-title text-center">Causas</h3>
                    <p class="card-text text-center">Que ocaciona la inseguridad ciudadana en La Paz</p>
                </div>
            </div>
            <div class="card cardb ">
                <img src="assest/images/icon2.svg" class="card-img-top" alt="" height="100">
                <div class="card-body">
                    <h3 class="card-title text-center">Metodos</h3>
                    <p class="card-text text-center">Estrategias para prevenir echos de inseguridad ciudadana</p>
                </div>
            </div>
            <div class="card cardb ">
                <img src="assest/images/icon3.svg" class="card-img-top" alt="" height="100">
                <div class="card-body">
                    <h3 class="card-title text-center">Sugerencias</h3>
                    <p class="card-text text-center">Informacion acerta de vivencias de distintas persona</p>
                </div>
            </div>
        </div>


        <div class="container-fluid my-card-slide d-lg-none d-md-none d-sm-none">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner carousel-innerM row w-100 mx-auto">
                    <div class="carousel-item carousel-itemM col-md-4 active">
                        <div class="card cardb-n">
                            <img src="assest/images/icon.svg" class="card-img-top" alt="" height="100">
                            <div class="card-body">
                                <h3 class="card-title text-center">Causas</h3>
                                <p class="card-text text-center">Que ocaciona la inseguridad ciudadana en La Paz</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-md-4">
                        <div class="card cardb-n">
                            <img src="assest/images/icon2.svg" class="card-img-top" alt="" height="100">
                            <div class="card-body">
                                <h3 class="card-title text-center">Metodos</h3>
                                <p class="card-text text-center">Estrategias para prevenir echos de inseguridad
                                    ciudadana</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-md-4">
                        <div class="card cardb-n">
                            <img src="assest/images/icon3.svg" class="card-img-top" alt="" height="100">
                            <div class="card-body">
                                <h3 class="card-title text-center">Sugerencias</h3>
                                <p class="card-text text-center">Informacion acerta de vivencias de distintas persona</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </header>
    <!--FIN DEL HEADER-->
    <main>
        <section class="container">
            <div class="row">
                <div class="col-12 ">
                    <div class="contenidoI adornoSandI text-center py-2">
                        <h2>Lo que se aprendera</h2>
                        <p class="pb-2">Los temas que veras llegaran a ser de gran ayuda para ti</p>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include("assest/php/mostrar.php");
        ?>
        <!--FIN SLIDE 3-->
        <!--FIN DE CURSOS-->
        <section class="container fcolor">
            <div class="row justify-content-around customrow l-main-decorar--ziczac">
                <div class="col-sm-12 col-md-12 col-lg-12 ">
                    <div class="encabezadoSection contenidoI text-center">
                        <h2>¿ Por que Capacitarse?</h2>
                        <p>Nuestra metodología es sobre experiencias de situaciones reales.</p>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-lg-4 col-xl-4 col-12 listaIconos__item icon-footprint">
                    <h3 class="listaIconos__titulo">Disversas opniones</h3>
                    <p class="listaIconos__p contenidoI">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Odit, molestias tempora amet beatae sunt ut veniam ea autem.</p>
                </div>
                <div class="col-lg-4 col-xl-4 col-12 listaIconos__item icon-helpprint">
                    <h3 class="listaIconos__titulo">Ayuda conjunta</h3>
                    <p class="listaIconos__p contenidoI">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Odit, molestias tempora amet beatae
                        sunt ut veniam ea autem.</p>
                </div>
                <div class="col-lg-4 col-xl-4 col-12 listaIconos__item icon-videoprint">
                    <h3 class="listaIconos__titulo">Material grafico</h3>
                    <p class="listaIconos__p contenidoI">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Odit, molestias tempora amet beatae sunt ut veniam ea autem.</p>
                </div>
            </div>

        </section>

        <section class="g-contenedor-full l-main-contenedorDark">
            <div class="container">
                <div class="row ">
                    <div class="col-12 encabezadoSeccion text-center">
                        <h2>Ellos probaron el sistema</h2>
                    </div>
                </div>
                <div class="row g-contenedor justify-content-center">
                    <div class="col-12 l-footer-testimonios">
                        <div id="carouselTestimonios" class="carousel slide customcarrusuel carousel-fade " data-ride="carousel"
                            data-interval="6000">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselTestimonios" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselTestimonios" data-slide-to="1"></li>
                                <li data-target="#carouselTestimonios" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active testimonio__item">
                                    <blockquote class="testimonio--dark ">
                                        <div class="testimonio__detalle">
                                            <div class="row justify-content-between">
                                                <div class="col-md-2 col-lg-2 col-xl-2 col-sm-12 col-12 ">
                                                    <figure class="testimonio__img icon-bubble-quote margin">
                                                        <img src="assest/images/EddyRamos.jpg" class="media rounded-circle"
                                                            height="100" width="100" alt="Eddy Ramos uno de los que probo el sistema">
                                                    </figure>
                                                </div>

                                                <div class="col-md-10 col-lg-10 col-xl-10 col-sm-12 col-12">
                                                    <p class="testimonio__p">"Realmente fue una experiencia
                                                        excelente,la asesoría por parte del tutor siempre fue presta a
                                                        resolver inquietudes,las clases fueron mas del tiempo esperado,
                                                        de verdad que el quequiera aprender y despejar todas sus dudas
                                                        este es el curso para usted. Lorecomiendo 200%."</p>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="testimonio__footer">
                                            <div class="row">
                                                <div class="col-12">
                                                    <cite>
                                                        <a href="https://www.facebook.com/eddy.ramos.1656">
                                                            <span class="testiminio__nombre">Eddy Rodrigo Ramos</span>
                                                            <span class="testimonio__fuente">fb.com/eddy.ramos.1656</span>
                                                        </a>
                                                    </cite>
                                                </div>
                                            </div>

                                        </div>
                                    </blockquote>
                                </div>
                                <div class="carousel-item testimonio__item">
                                    <blockquote class="testimonio--dark ">
                                        <div class="testimonio__detalle">
                                            <div class="row justify-content-between">
                                                <div class="col-md-2 col-lg-2 col-xl-2 col-sm-12 col-12 ">
                                                    <figure class="testimonio__img icon-bubble-quote margin">
                                                        <img src="assest/images/avatar.jpg" class="media rounded-circle"
                                                            height="100" width="100" alt="Eddy Ramos uno de los que probo el sistema">
                                                    </figure>
                                                </div>

                                                <div class="col-md-10 col-lg-10 col-xl-10 col-sm-12 col-12">
                                                    <p class="testimonio__p">"Realmente fue una experiencia excelente,
                                                        la
                                                        asesoría por parte del tutor siempre fue presta a resolver
                                                        inquietudes,
                                                        las clases fueron mas del tiempo esperado, de verdad que el que
                                                        quiera
                                                        aprender y despejar todas sus dudas este es el curso para
                                                        usted. Lo
                                                        recomiendo 200%."</p>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="testimonio__footer">
                                            <div class="row">
                                                <div class="col-12">
                                                    <cite>
                                                        <a href="https://www.facebook.com/eddy.ramos.1656">
                                                            <span class="testiminio__nombre">Eddy Rodrigo Ramos</span>
                                                            <span class="testimonio__fuente">fb.com/eddy.ramos.1656</span>
                                                        </a>
                                                    </cite>
                                                </div>
                                            </div>

                                        </div>
                                    </blockquote>

                                </div>
                                <div class="carousel-item testimonio__item">
                                    <blockquote class="testimonio--dark ">
                                        <div class="testimonio__detalle">
                                            <div class="row justify-content-between">
                                                <div class="col-md-2 col-lg-2 col-xl-2 col-sm-12 col-12 ">
                                                    <figure class="testimonio__img icon-bubble-quote margin">
                                                        <img src="assest/images/EddyRamos.jpg" class="media rounded-circle"
                                                            height="100" width="100" alt="Eddy Ramos uno de los que probo el sistema">
                                                    </figure>
                                                </div>

                                                <div class="col-md-10 col-lg-10 col-xl-10 col-sm-12 col-12">
                                                    <p class="testimonio__p">"Realmente fue una experiencia excelente,
                                                        la
                                                        asesoría por parte del tutor siempre fue presta a resolver
                                                        inquietudes,
                                                        las clases fueron mas del tiempo esperado, de verdad que el que
                                                        quiera
                                                        aprender y despejar todas sus dudas este es el curso para
                                                        usted. Lo
                                                        recomiendo 200%."</p>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="testimonio__footer">
                                            <div class="row">
                                                <div class="col-12">
                                                    <cite>
                                                        <a href="https://www.facebook.com/eddy.ramos.1656">
                                                            <span class="testiminio__nombre">Eddy Rodrigo Ramos</span>
                                                            <span class="testimonio__fuente">fb.com/eddy.ramos.1656</span>
                                                        </a>
                                                    </cite>
                                                </div>
                                            </div>

                                        </div>
                                    </blockquote>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!--footer-->


    </main>
    <footer class="g-contenedor-full l-main-contenedorDark2">
        <div class="container">
            <div class="row  g-contenedor l-menu-footer l-main-contenedorDark2__triangulo icon-nigbox">
                <div class="col-12 col-lg-6 col-xl-6 l-footer-novedades l-footer-separador">
                    <h4 class="tituloFooter">Acerca del sistema</h4>
                    <p class="parrafoFooter">El sistema proporciona toda la capacitacion necesaria para informar a las
                        personas de la ciudad de La Paz ante echos delictivos</p>
                    <br><br>
                    <h4 class="tituloFooter">Mantente Informado</h4>
                    <p class="parrafoFooter">Registra tu correo y recibe información sobre nuevos consejos nuevas
                        tematicas que puedes aprender.</p>
                    <form action="" name="registroNovedades" method="POST" class="formNovedades">
                        <div class="formNovedades__campo campo-iconDark icon-envelop5">
                            <input type="email" name="email__novedades" placeholder="Correo electrónico" class="campo-formDark js-emailNovevades">
                        </div>
                        <button class="btn-form--dark icon  js-btnNovedades">Apuntarme
                            <i class="fas fa-chevron-circle-right ml-2"></i>
                        </button>
                    </form>
                </div>
                <div class="col-12 col-lg-6 col-xl-6 text-center colorText spacetop">
                    <h3 class="spacefooter">¿Sabes acerca de la inseguridad Ciudadana?</h3> <br>
                    <h3 class="spacefooter">¿Quisieras compartir tu conocimiento?</h3> <br>
                    <h3 class="spacefooter">Entonces comparte tu tema ayuda a las personas</h3>
                    <br><br>
                    <button type="button" name="button" class="btn-cap spacefooter">Añade un tema</button>
                </div>
            </div>
        </div>
    </footer>
    <footer class="fondofooter">
        <div class="row customrow">
            <div class="col-12 l-footer-copyright text-center">
                <p>Copyright <span class="copyright">©</span> 2018 Ramiro Castillo, Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="assest/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="assest/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assest/js/main.js"></script>
</body>
<?php
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
echo "<pre>";
print_r($_POST);
echo "</pre>";
?>

</html>