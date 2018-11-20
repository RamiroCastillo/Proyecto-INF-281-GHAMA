<?php
require_once('Database.php');
mysql_query("SET NAMES utf8");
/*SLIDE 3*/ 
$db = Database::getInstance();
$con = $db->getConnection();
mysql_query("SET NAMES utf8");?>

<?php
/*SLIDE 1*/
$consulta1 = "SELECT * FROM tema"; //WHERE nombre like '$nombre%'
$respuesta1 = mysqli_query($con, $consulta1) or die(mysql_error());

$total1 = mysqli_num_rows($respuesta1);
$paginacion1 = 1; //3
$paginas1 = ceil($total1 / $paginacion1);
$ini1 = 0;
/*echo $total1;
echo "<br>";
echo $paginacion1;
echo "<br>";
echo "NRO".$paginas1;
echo "<br>";
echo $ini1;*/
?>
<section class="carousel slide fondogris d-block d-md-none d-lg-none d-xl-none" data-ride="carousel" id="card-slide"
    data-interval="false">
    <div class="container carousel-inner">
        <?php
        for ($indice = 1; $indice <= $paginas1; $indice++) {
            //echo "indice : ";
            //echo $indice;
            if($indice == 1) { ?>
        <div class="row justify-content-around carousel-item active ml-0">
            <?php
                    $consulta1 = "SELECT * FROM tema as t,usuario as u where t.idUsuario = u.idUsuario LIMIT $ini1,$paginacion1";

                    $respuesta1 = mysqli_query($con, $consulta1);
                    ?>
            <?php
            $filtro = 1;
            while ($fila1 = mysqli_fetch_array($respuesta1)) { ?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-4 ">
                <div class="card my-cards">
                    <figure class="cursoDestacado__video">
                        <img class="card-img-top imgc" src="assest/images/<?= $fila1['imagenTema']; ?>" alt="Card image cap"
                            height=170>
                        <?php
                        if ($filtro <= 4) { ?>
                        <span class="filtro colorfiltro<?=$filtro;?>"></span>
                        <?php

                    } else {
                        $filtro = 1 ?>
                        <span class="filtro colorfiltro<?= $filtro; ?>"></span>
                        <?php

                    }
                    ?>
                    </figure>

                    <div class="card-body modiftamcard">
                        <h5 class="card-title">
                            <?= $fila1['tema']; ?>
                        </h5>
                        <p class="card-text">
                            <?= $fila1['descripcion']; ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-around align-items-center">
                            <div class="col-auto">
                                <img class="img-fluid rounded-circle" src="assest/images/<?= $fila1['foto']; ?>" alt="Card image cap"
                                    height="50px" width="50px">
                            </div>
                            <div class="col-auto mr-auto colort">
                                <span>
                                    <?= $fila1['nombre'] . " " . $fila1['apellido']; ?></span>
                            </div>
                            <div class="col-auto">
                                <a href="capacitacion.php"><button type="button" name="button" class="btn-cap">CAPACITATE</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            $filtro = $filtro + 1;
        }
        ?>
        </div>
        <?php
            }else{?>
            <div class="row justify-content-around carousel-item ml-0">
            <?php
            $consulta1 = "SELECT * FROM tema as t,usuario as u where t.idUsuario = u.idUsuario LIMIT $ini1,$paginacion1";

            $respuesta1 = mysqli_query($con, $consulta1);
            ?>
            <?php
            while ($fila1 = mysqli_fetch_array($respuesta1)) { ?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-4 ">
                <div class="card my-cards">
                    <figure class="cursoDestacado__video">
                        <img class="card-img-top imgc" src="assest/images/<?= $fila1['imagenTema']; ?>" alt="Card image cap"
                            height=170>
                        <?php
                        if ($filtro <= 4) { ?>
                        <span class="filtro colorfiltro<?= $filtro; ?>"></span>
                        <?php

                    } else {
                        $filtro = 1 ?>
                        <span class="filtro colorfiltro<?= $filtro; ?>"></span>
                        <?php

                    }
                    ?>
                    </figure>

                    <div class="card-body modiftamcard">
                        <h5 class="card-title">
                            <?= $fila1['tema']; ?>
                        </h5>
                        <p class="card-text">
                            <?= $fila1['descripcion']; ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-around align-items-center">
                            <div class="col-auto">
                                <img class="img-fluid rounded-circle" src="assest/images/<?= $fila1['foto']; ?>" alt="Card image cap"
                                    height="50px" width="50px">
                            </div>
                            <div class="col-auto mr-auto colort">
                                <span>
                                    <?= $fila1['nombre'] . " " . $fila1['apellido']; ?></span>
                            </div>
                            <div class="col-auto">
                                <a href="capacitacion.php"><button type="button" name="button" class="btn-cap">CAPACITATE</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            $filtro = $filtro + 1;
        }
        ?>
        </div>
            <?php    
            }?>

        <?php
        //echo "pafinacion : ";
        $ini1 = $ini1 + 1; 
        //echo $ini1?>
        <?php
        }
    ?>
    </div>
    <a class="carousel-control-prev" href="#card-slide" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#card-slide" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</section>



<?php
/*SLIDE 2*/
$consulta2 = "SELECT * FROM tema"; //WHERE nombre like '$nombre%'
$respuesta2 = mysqli_query($con, $consulta2) or die(mysql_error());

$total2 = mysqli_num_rows($respuesta2);
$paginacion2 = 2; //3
$paginas2 = ceil($total2 / $paginacion2);
$ini2 = 0;
?>
<section class="carousel slide fondogris d-none d-md-block d-lg-none" data-ride="carousel" id="card-slide2"
    data-interval="false">
    <div class="container carousel-inner">
        <?php
        for ($segundoindi = 1; $segundoindi <= $paginas2; $segundoindi++) {
            if ($segundoindi == 1) { ?>
        <div class="row justify-content-around carousel-item active ml-0">
            <?php
                    $consulta2 = "SELECT * FROM tema as t,usuario as u where t.idUsuario = u.idUsuario LIMIT $ini2,$paginacion2";

                    $respuesta2 = mysqli_query($con, $consulta2);
                    ?>
            <?php
            $filtro = 1;
            while ($fila2 = mysqli_fetch_array($respuesta2)) { ?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-4 ">
                <div class="card my-cards">
                    <figure class="cursoDestacado__video">
                        <img class="card-img-top imgc" src="assest/images/<?= $fila2['imagenTema']; ?>" alt="Card image cap"
                            height=170>
                        <?php
                        if ($filtro <= 4) { ?>
                        <span class="filtro colorfiltro<?= $filtro; ?>"></span>
                        <?php

                    } else {
                        $filtro = 1 ?>
                        <span class="filtro colorfiltro<?= $filtro; ?>"></span>
                        <?php

                    }
                    ?>
                    </figure>

                    <div class="card-body modiftamcard">
                        <h5 class="card-title">
                            <?= $fila2['tema']; ?>
                        </h5>
                        <p class="card-text">
                            <?= $fila2['descripcion']; ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-around align-items-center">
                            <div class="col-auto">
                                <img class="img-fluid rounded-circle" src="assest/images/<?= $fila2['foto']; ?>" alt="Card image cap"
                                    height="50px" width="50px">
                            </div>
                            <div class="col-auto mr-auto colort">
                                <span>
                                    <?= $fila2['nombre'] . " " . $fila2['apellido']; ?></span>
                            </div>
                            <div class="col-auto">
                                <a href="capacitacion.php"><button type="button" name="button" class="btn-cap">CAPACITATE</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            $filtro = $filtro + 1;
        }
        ?>
        </div>
        <?php
            } else { ?>
        <div class="row justify-content-around carousel-item ml-0">
            <?php
                $consulta2 = "SELECT * FROM tema as t,usuario as u where t.idUsuario = u.idUsuario LIMIT $ini2,$paginacion2";

                $respuesta2 = mysqli_query($con, $consulta2);
                ?>
            <?php
                while ($fila2 = mysqli_fetch_array($respuesta2)) { ?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-4 ">
                <div class="card my-cards">
                    <figure class="cursoDestacado__video">
                        <img class="card-img-top imgc" src="assest/images/<?= $fila2['imagenTema']; ?>" alt="Card image cap"
                            height=170>
                        <?php
                            if ($filtro <= 4) { ?>
                        <span class="filtro colorfiltro<?= $filtro; ?>"></span>
                        <?php

                            } else {
                                $filtro = 1 ?>
                        <span class="filtro colorfiltro<?= $filtro; ?>"></span>
                        <?php

                            }
                            ?>
                    </figure>

                    <div class="card-body modiftamcard">
                        <h5 class="card-title">
                            <?= $fila2['tema']; ?>
                        </h5>
                        <p class="card-text">
                            <?= $fila2['descripcion']; ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-around align-items-center">
                            <div class="col-auto">
                                <img class="img-fluid rounded-circle" src="assest/images/<?= $fila2['foto']; ?>" alt="Card image cap"
                                    height="50px" width="50px">
                            </div>
                            <div class="col-auto mr-auto colort">
                                <span>
                                    <?= $fila2['nombre']." ". $fila2['apellido']; ?></span>
                            </div>
                            <div class="col-auto">
                                <a href="capacitacion.php"><button type="button" name="button" class="btn-cap">CAPACITATE</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                $filtro = $filtro + 1;
            }
            ?>
        </div>
        <?php
            }
            ?>
        <?php
                $ini2 = $ini2 + 2;?>
        <?php
            }
            ?>
    </div>
    <a class="carousel-control-prev" href="#card-slide2" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#card-slide2" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</section>

<?php
/*SLIDE 3*/ 
$consulta3 = "SELECT * FROM tema"; //WHERE nombre like '$nombre%'
$respuesta3 = mysqli_query($con,$consulta3)or die(mysql_error());

$total3 = mysqli_num_rows($respuesta3);
$paginacion3 = 3; //3
$paginas3 = ceil($total3 / $paginacion3);
$ini3 = 0;

?>
<section class="carousel slide fondogris d-none d-lg-block d-xl-block" data-ride="carousel" id="card-slide3"
    data-interval="false">
    <div class="container carousel-inner">
        <?php
        for ($i = 1; $i <= $paginas3; $i++) {
            if ($i == 1) { ?>
        <div class="row justify-content-around carousel-item active ml-0">
            <?php
        $consulta3 = "SELECT * FROM tema as t,usuario as u where t.idUsuario = u.idUsuario LIMIT $ini3,$paginacion3";

        $respuesta3 = mysqli_query($con, $consulta3);
        ?>
            <?php
            $filtro = 1;
            while ($fila3 = mysqli_fetch_array($respuesta3)) { ?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-4 ">
                <div class="card my-cards">
                    <figure class="cursoDestacado__video">
                        <img class="card-img-top imgc" src="assest/images/<?= $fila3['imagenTema']; ?>" alt="Card image cap"
                            height=170>
                        <?php
                        if ($filtro <= 4) { ?>
                        <span class="filtro colorfiltro<?= $filtro; ?>"></span>
                        <?php

                        } else {
                        $filtro = 1 ?>
                        <span class="filtro colorfiltro<?= $filtro; ?>"></span>
                        <?php
                        }
                        ?>
                    </figure>

                    <div class="card-body modiftamcard">
                        <h5 class="card-title">
                            <?= $fila3['tema']; ?>
                        </h5>
                        <p class="card-text">
                            <?= $fila3['descripcion']; ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-around align-items-center">
                            <div class="col-auto">
                                <img class="img-fluid rounded-circle" src="assest/images/<?= $fila3['foto']; ?>" alt="Card image cap"
                                    height="50px" width="50px">
                            </div>
                            <div class="col-auto mr-auto colort">
                                <span>
                                    <?= $fila3['nombre'] . " " . $fila3['apellido']; ?></span>
                            </div>
                            <div class="col-auto">
                                <a href="capacitacion.php"><button type="button" name="button" class="btn-cap">CAPACITATE</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            $filtro = $filtro + 1;
        }
        ?>
        </div>

        <?php
    } else { ?>
        <div class="row justify-content-around carousel-item ml-0">
            <?php
                $consulta3 = "SELECT * FROM tema as t,usuario as u where t.idUsuario = u.idUsuario LIMIT $ini3,$paginacion3";

                $respuesta3 = mysqli_query($con, $consulta3);
                ?>
            <?php
                while ($fila3 = mysqli_fetch_array($respuesta3)) { ?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-4 ">
                <div class="card my-cards">
                    <figure class="cursoDestacado__video">
                        <img class="card-img-top imgc" src="assest/images/<?= $fila3['imagenTema']; ?>" alt="Card image cap"
                            height=170>
                        <?php
                            if ($filtro <= 4) { ?>
                        <span class="filtro colorfiltro<?= $filtro; ?>"></span>
                        <?php

                        } else {
                            $filtro = 1 ?>
                        <span class="filtro colorfiltro<?= $filtro; ?>"></span>
                        <?php

                        }
                        ?>
                    </figure>

                    <div class="card-body modiftamcard">
                        <h5 class="card-title">
                            <?= $fila3['tema']; ?>
                        </h5>
                        <p class="card-text">
                            <?= $fila3['descripcion']; ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-around align-items-center">
                            <div class="col-auto">
                                <img class="img-fluid rounded-circle" src="assest/images/<?= $fila3['foto']; ?>" alt="Card image cap"
                                    height="50px" width="50px">
                            </div>
                            <div class="col-auto mr-auto colort">
                                <span>
                                    <?= $fila3['nombre']; ?></span>
                            </div>
                            <div class="col-auto">
                                <a href="capacitacion.php"><button type="button" name="button" class="btn-cap">CAPACITATE</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                $filtro = $filtro +1;
            }
            ?>
        </div>
        <?php

            }
            ?>
        <?php
                $ini3 = $ini3 + 3;
    }
    ?>
    </div>
    <a class="carousel-control-prev" href="#card-slide3" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#card-slide3" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</section>




