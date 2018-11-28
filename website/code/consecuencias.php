<?php
header('Cache-Control: no cache'); //no cache
//session_cache_limiter('private_no_expire'); // works
//ob_start();
session_start();
require_once('assest/php/Database.php');
$_SESSION['confConsec']=1;
?>
<?php
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}
$db = Database::getInstance();
$con = $db->getConnection();
$idTemaP = $_GET['nrotema'];
$nombreTema = $_GET['temaP'];

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
                        <h2>Aqui se puede apreciar a todos los perjudicados debido a la consecuencia</h2>
                        <p>
                            <?=$nombreTema;?>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="fondogris">
            <div class="container d-xl-block d-lg-block d-none">
                <?php

                $consulta1 = "SELECT * FROM perjudicado as p,consecuencia as c,problematica as pro where p.idConsecuencia=c.idConsecuencia and c.idProblematica=pro.idProblematica and pro.idTema=$idTemaP"; //WHERE nombre like '$nombre%'
                $respuesta1 = mysqli_query($con, $consulta1) or die(mysql_error());


                $total1 = mysqli_num_rows($respuesta1);
                $paginacion1 = 3; //3
                $nrofila = ceil($total1 / $paginacion1);
                $ini1 = 0;
                $vermas = 1;
                for ($i = 1; $i <= $nrofila; $i++) { 
                    if (!($vermas <= 2 )) {?>
                <div id="Vermas" style="display:none;">
                    <br><br>
                    <div class="row justify-content-around">
                        <?php
                    $consulta1 = "SELECT * FROM perjudicado as p,consecuencia as c,problematica as pro where p.idConsecuencia=c.idConsecuencia and c.idProblematica=pro.idProblematica and pro.idTema=$idTemaP LIMIT $ini1,$paginacion1";

                    $respuesta1 = mysqli_query($con, $consulta1);

                    while ($fila1 = mysqli_fetch_array($respuesta1)) { ?>
                        <div class="col-4">
                            <div class="card sizeCardPer">
                                <img class="card-img-top" src="assest/images/<?= $fila1['detallePerju']; ?>" alt="Card image cap">

                                <div class="card-body ">
                                    <h3 class="card-title text-center">
                                        <?= $fila1['descripcionPer']; ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <?php

                }
                ?>
                    </div>

                </div>
                <?php
                    } else {?>
                <br><br>
                <div class="row justify-content-around">
                    <?php
                    $consulta1 = "SELECT * FROM perjudicado as p,consecuencia as c,problematica as pro where p.idConsecuencia=c.idConsecuencia and c.idProblematica=pro.idProblematica and pro.idTema=$idTemaP LIMIT $ini1,$paginacion1";

                    $respuesta1 = mysqli_query($con, $consulta1);

                    while ($fila1 = mysqli_fetch_array($respuesta1)) { ?>
                    <div class="col-4">
                        <div class="card sizeCardPer">
                            <img class="card-img-top" src="assest/images/<?= $fila1['detallePerju']; ?>" alt="Card image cap">

                            <div class="card-body ">
                                <h3 class="card-title text-center">
                                    <?= $fila1['descripcionPer']; ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <?php

                }
                ?>
                </div>
                <?php    
                    }
                    ?>
                <?php
                $ini1 = $ini1 + 3;
                $vermas = $vermas +1;
            }
            ?>
                <br>
                <div class="row ">
                    <div class="col-12 text-center">

                        <a id="btnmas" class="btnRes"><i class="fas fa-sync-alt"></i><span class="pl-2">ver mas
                                perjudicados</span></a>
                    </div>
                </div>
            </div>
            <!--MOVIL-->
            <div class="container d-block d-sm-block d-md-block d-lg-none d-xl-none">
                <?php

                $consulta1 = "SELECT * FROM perjudicado as p,consecuencia as c,problematica as pro where p.idConsecuencia=c.idConsecuencia and c.idProblematica=pro.idProblematica and pro.idTema=$idTemaP"; //WHERE nombre like '$nombre%'
                $respuesta1 = mysqli_query($con, $consulta1) or die(mysql_error());


                $total1 = mysqli_num_rows($respuesta1);
                $paginacion1 = 1; //3
                $nrofila = ceil($total1 / $paginacion1);
                $ini1 = 0;
                $vermasM = 1;
                for ($i = 1; $i <= $nrofila; $i++) {
                    if (!($vermasM <= 3)) { ?>
                <div class="VermasMovil" style="display:none;">
                    <br><br>
                    <div class="row justify-content-around">
                        <?php
                        $consulta1 = "SELECT * FROM perjudicado as p,consecuencia as c,problematica as pro where p.idConsecuencia=c.idConsecuencia and c.idProblematica=pro.idProblematica and pro.idTema=$idTemaP LIMIT $ini1,$paginacion1";
                        $respuesta1 = mysqli_query($con, $consulta1);
                        while ($fila1 = mysqli_fetch_array($respuesta1)) { ?>
                        <div class="col-12">
                            <div class="card sizeCardPer">
                                <img class="card-img-top" src="assest/images/<?= $fila1['detallePerju']; ?>" alt="Card image cap">

                                <div class="card-body ">
                                    <h3 class="card-title text-center">
                                        <?= $fila1['descripcionPer']; ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>

                </div>
                <?php
            } else { ?>
                <br><br>
                <div class="row justify-content-around">
                    <?php
                        $consulta1 = "SELECT * FROM perjudicado as p,consecuencia as c,problematica as pro where p.idConsecuencia=c.idConsecuencia and c.idProblematica=pro.idProblematica and pro.idTema=$idTemaP LIMIT $ini1,$paginacion1";
                        $respuesta1 = mysqli_query($con, $consulta1);
                        while ($fila1 = mysqli_fetch_array($respuesta1)) { ?>
                    <div class="col-12">
                        <div class="card sizeCardPer">
                            <img class="card-img-top" src="assest/images/<?= $fila1['detallePerju']; ?>" alt="Card image cap">

                            <div class="card-body ">
                                <h3 class="card-title text-center">
                                    <?= $fila1['descripcionPer']; ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <?php

                    }
                    ?>
                </div>


                <?php 
            }
            ?>
                <?php
                $ini1 = $ini1 + 1;
                $vermasM = $vermasM + 1;
            }
            ?>
                <br>
                <div class="row ">
                    <div class="col-12 text-center">
                        <a id="btnmasMovil" class="btnRes"><i class="fas fa-sync-alt"></i><span class="pl-2">ver mas
                                perjudicados</span></a>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <section class="fcolor">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h2 class="colorNegro">Aqui puedes observar la realidad vividencial mediante imagenesy videos</h2>
                    </div>
                </div>
                <br>
                <div class="row ">
                    <div class="col">
                        <nav>
                            <div class="nav  justify-content-center" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active btnRes mr-2" id="nav-imagen-tab" data-toggle="tab"
                                    href="#nav-imagen" role="tab" aria-controls="nav-imagen" aria-selected="true">Imagenes</a>
                                <a class="nav-item nav-link btnResBlank ml-2" id="nav-video-tab" data-toggle="tab" href="#nav-video"
                                    role="tab" aria-controls="nav-video" aria-selected="false">Videos</a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="container">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-imagen" role="tabpanel" aria-labelledby="nav-imagen-tab">
                        <?php

                        $consulta1 = "SELECT DISTINCT rv.descripcion FROM perjudicado as p,consecuencia as c,problematica as pro,realidadvividencial as rv where p.idConsecuencia=c.idConsecuencia and c.idProblematica=pro.idProblematica and pro.idTema=1 and rv.idRealidad=p.idRealidad and rv.tipo LIKE 'imagen'"; //WHERE nombre like '$nombre%'
                        $respuesta1 = mysqli_query($con, $consulta1) or die(mysql_error());


                        $total1 = mysqli_num_rows($respuesta1);
                        $paginacion1 = 3; //3
                        $nrofila = ceil($total1 / $paginacion1);
                        $ini1 = 0;
                        $vermas = 1;
                        for ($i = 1; $i <= $nrofila; $i++) {?>
                        <div class="row justify-content-around">
                            <?php
                        $consulta1 = "SELECT DISTINCT rv.descripcion FROM perjudicado as p,consecuencia as c,problematica as pro,realidadvividencial as rv where p.idConsecuencia=c.idConsecuencia and c.idProblematica=pro.idProblematica and pro.idTema=1 and rv.idRealidad=p.idRealidad and rv.tipo LIKE 'imagen' LIMIT $ini1,$paginacion1";

                        $respuesta1 = mysqli_query($con, $consulta1);

                        while ($fila1 = mysqli_fetch_array($respuesta1)) { ?>
                            <div class="col-4">
                                <div class="card sizeCardRealidad">
                                    <div class="card-body ">
                                        <img class="card-img-top" src="assest/images/<?= $fila1['descripcion']; ?>" alt="Card image cap">
                                    </div>
                                </div>
                            </div>
                            <?php
                    }
                    ?>
                        </div>
                        <br><br>
                        <?php 
                        $ini1 = $ini1 + 3;
                        }
                        ?>

                    </div>
                    <div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
                        <?php

                        $consulta1 = "SELECT DISTINCT rv.descripcion FROM perjudicado as p,consecuencia as c,problematica as pro,realidadvividencial as rv where p.idConsecuencia=c.idConsecuencia and c.idProblematica=pro.idProblematica and pro.idTema=1 and rv.idRealidad=p.idRealidad and rv.tipo LIKE 'video'"; //WHERE nombre like '$nombre%'
                        $respuesta1 = mysqli_query($con, $consulta1) or die(mysql_error());


                        $total1 = mysqli_num_rows($respuesta1);
                        $paginacion1 = 3; //3
                        $nrofila = ceil($total1 / $paginacion1);
                        $ini1 = 0;
                        $vermas = 1;
                        for ($i = 1; $i <= $nrofila; $i++) { ?>
                        <div class="row justify-content-around">
                            <?php
                            $consulta1 = "SELECT DISTINCT rv.descripcion FROM perjudicado as p,consecuencia as c,problematica as pro,realidadvividencial as rv where p.idConsecuencia=c.idConsecuencia and c.idProblematica=pro.idProblematica and pro.idTema=1 and rv.idRealidad=p.idRealidad and rv.tipo LIKE 'video' LIMIT $ini1,$paginacion1";

                            $respuesta1 = mysqli_query($con, $consulta1);

                            while ($fila1 = mysqli_fetch_array($respuesta1)) { ?>
                            <div class="col-4">
                                <div class="card sizeCardRealidad">
                                    <div class="card-body ">
                                        <video controls="controls">
                                            <source src="assest/videos/<?=$fila1['descripcion'];?>" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                            </div>
                            <?php

                        }
                        ?>
                        </div>
                        <br><br>
                        <?php 
                        $ini1 = $ini1 + 3;
                    }
                    ?>
                    </div>

                </div>
            </div>



        </section>
        <section class="fondogris">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h2 class="colorNegro">¿Ya viste a las Perjudicados? y ¿la realidad q enfrenta la sociedad? que ocacionan el: <?= $nombreTema; ?> combate el problema</h2>
                    </div>
                </div>
                <br> <br>
                <div class="row ">
                    <div class="col text-center">
                        <a href="tema.php?tema=<?= $idTemaP; ?>" class="btnRes">Como combatir el problema</a>
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