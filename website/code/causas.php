<?php
header('Cache-Control: no cache'); //no cache
//session_cache_limiter('private_no_expire'); // works
//ob_start();
session_start();
require_once('assest/php/Database.php');
$_SESSION['confC'] = 1;
?>
<?php
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}
$db = Database::getInstance();
$con = $db->getConnection();
$nombreTema = $_GET['temaP'];
$idTemaP = $_GET['nrotema'];
$IDS;

$consulta = "SELECT * FROM problematica as p,causa as c where p.idProblematica = c.idProblematica and p.idTema = $idTemaP"; //WHERE nombre like '$nombre%'
$respuesta = mysqli_query($con, $consulta) or die(mysql_error());

$nrocausas = mysqli_num_rows($respuesta);



@mysql_query("SET NAMES 'utf8'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Causas</title>
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
                    <li class="menuPrin__item"><a href="index.php">Inicio</a></li>
                    <li class="menuPrin__item"><a href="capacitacion.php" class="activadot">Capacitacion</a></li>
                    <li class="menuPrin__item"><a href="#">Gestor de Recursos</a></li>
                    <li class="menuPrin__item"><a href="#">Foro</a></li>
                    <li class="menuPrin__item"><a href="#">Consejos</a></li>
                </ul>

                <?php
                if (isset($_SESSION['user'])) { ?>
                <ul class="menuAcceso nav navbar-nav ">
                    <li class="dropdown ">
                        <div class="text-center  menuUser dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <figure class="menuUser__img ml-5">
                                <img src="assest/images/<?= $_SESSION['foto']; ?>" alt="Ramiro">
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
            } else { ?>
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

    <?php
    if (isset($_SESSION['user'])) {  /*MENU CON SESION*/ ?>
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
                    <a class="nav-link px-3" href="index.php">Inicio</span></a>
                </li>
                <li class="nav-item d-flex align-items-center ">
                    <a class="nav-link px-3 activadot" href="capacitacion.php">Capacitacion</a>
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
                            <img src="assest/images/<?= $_SESSION['foto']; ?>" alt="Ramiro">
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

} else { ?>
    <nav class="my-nav w-100 navbar navbar-expand-lg px-5" id="navsticky">
        <a class="navbar-brand custom-navbar-brand" href="#"><img src="assest/images/NuevoLogo.png" alt="Logo GHAMA"></a>
        <button class="navbar-toggler custom-toggler " type="button" data-toggle="modal" data-target="#menuModal"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
            <ul class="navbar-nav hover mr-5">
                <li class="nav-item active d-flex align-items-center  ">
                    <a class="nav-link px-3" href="index.php">Inicio</span></a>
                </li>
                <li class="nav-item d-flex align-items-center ">
                    <a class="nav-link px-3 activadot" href="capacitacion.php">Capacitacion</a>
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
                    <a class="nav-link px-3 bgcr" href="#" data-toggle="modal" data-target="#myModal">Resgistrate</a>
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

        <div class="container contenidoTG">
            <div class="row">
                <div class="col-12 text-center textoTamaño">
                    <h2>Preguntate el por que de todo</h2>
                    <p>Siempre deberiamos preguntarnos por que suceden las cosas para saber mas afondo del tema.</p>
                </div>
            </div>
        </div>

    </header>
    <!--FIN DEL HEADER-->
    <main>
        <section class="container">
            <div class="row">
                <div class="col-12 ">
                    <div class="contenidoI adornoSandI text-center py-2">
                        <h2>Aqui se muestran las distintas causas de la problematica</h2>
                        <p>
                            <?=$nombreTema;?>
                        </p>
                    </div>
                </div>
            </div>
        </section>


        <section class="fondogris">
            <div id="causaPagPrin" class="carousel slide " data-ride="carousel" data-interval="false">
                <div class="container carousel-inner">
                    <div class="row justify-content-around">
                        <div class="col-10 col-md-6 col-lg-6 col-xl-6">
                            <div class="mxCausas">
                                <?php
                                $consulta = "SELECT * FROM problematica as p,causa as c where p.idProblematica = c.idProblematica and p.idTema = $idTemaP"; //WHERE nombre like '$nombre%'
                                $respuesta = mysqli_query($con, $consulta) or die(mysql_error());

                                $total = mysqli_num_rows($respuesta);
                                $paginacion = 1; //3
                                $paginas = ceil($total / $paginacion);
                                $ini = 0;


                                for ($i = 1; $i <= $paginas; $i++) {
                                    $consulta = "SELECT * FROM problematica as p,causa as c where p.idProblematica = c.idProblematica and p.idTema = $idTemaP LIMIT $ini,$paginacion";

                                    $respuesta = mysqli_query($con, $consulta);
                                    while ($fila = mysqli_fetch_array($respuesta)) {
                                        if ($i == 1) { ?>
                                <div class="carousel-item active">
                                    <div class="card cardCausaPrin  w-100 ">
                                        <img class="card-img-top sizeimgCausa" src="assest/images/<?= $fila['imagenCausa']; ?>"
                                            alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?= $fila['Detalle'];?>
                                            </h5>
                                            <br>
                                            <p class="card-text">
                                                <?= $fila['descripcionCausa']; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $idCausaNro = $fila['idCausa'];
                                $IDS[$idCausaNro] = 1;
                           

                            } else { ?>
                                <div class="carousel-item">
                                    <div class="card cardCausaPrin w-100 ">
                                        <img class="card-img-top sizeimgCausa" src="assest/images/<?= $fila['imagenCausa']; ?>"
                                            alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?= $fila['Detalle']; ?>
                                            </h5> <br>
                                            <p class="card-text">
                                                <?= $fila['descripcionCausa']; ?>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <?php
                                $idCausaNro = $fila['idCausa'];
                                $IDS[$idCausaNro] = 0;

                            }
                        }
                        $ini = $ini + 1;
                    } ?>
                            </div>

                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#causaPagPrin" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a id="next" class="carousel-control-next" href="#causaPagPrin" role="button" data-slide="next">

                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>
        <form action="#" method="post">
            <input id="nroCausas" type="hidden" value="<?= $nrocausas; ?>">
        </form>
        <?php
        $IDS = urlencode(serialize($IDS));	
        ?>
        <form action="#" method="post">
            <input type="hidden" value="<?=$IDS;?>" id="ids">
        </form>
        <section class="fcolor">
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-12 ">
                        <img src="assest/images/Flecha.svg" alt="" class="sizeArrow">
                    </div>
                    <button id="responsables" class="btnRes">Los Responsables </button>
                </div>
            </div>
        </section>
        <br>
        <section class=" fcolor" id="slideResponsa" style="display: none;">

        </section>
        <br><br>

        <section class="fondogris">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h2 class="colorNegro">¿Ya viste a las causas? y ¿A los responsables? que ocacionan el: <?= $nombreTema;?> combate el problema</h2>
                    </div>
                </div>
                <br> <br>
                <div class="row ">
                    <div class="col text-center">
                        <a href="tema.php?tema=<?=$idTemaP;?>" class="btnRes">Como combatir el problema</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="g-contenedor-full l-main-contenedorDark">
            <div class="g-contenedor l-main-decorar--ziczacTopGris"></div>
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-12 text-center">
                        <a href="capacitacion.php" class="btn-accion2--amarilloClaro text-center">¡Comienza un curso!</a>
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
    <script type="text/javascript" src="assest/js/mostrarRespon.js"></script>
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