<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//session_start();
require_once('assest/php/Database.php');
mysql_query("SET NAMES utf8");
/*SLIDE 3*/
$db = Database::getInstance();
$con = $db->getConnection();
mysql_query("SET NAMES utf8"); ?>
<?php
/*SLIDE 3*/
$vector_ids = unserialize(urldecode($_POST['ids']));

$p = isset($_POST['p'])?$_POST['p']:1;
$i=1;
foreach ($vector_ids as $key => $value) {
    if($p==$i){
        $value=1;
    }else{
        $value = 0;
    }
    if($value==1){
        $idCausa = $key;
    }
    $i=$i+1;
}


$consulta3 = "SELECT * FROM responsable r,crea c where r.idResponsable=c.idResponsable and c.idCausa=$idCausa";
$respuesta3 = mysqli_query($con, $consulta3) or die(mysql_error());

$total3 = mysqli_num_rows($respuesta3);
//echo ($total3);
$paginacion3 = 3; //3
$paginas3 = ceil($total3 / $paginacion3);
$ini3 = 0;
//echo($idCausa);


?>

<div class="carousel slide  data-ride=" carousel" id="card-slideRespon" data-interval="false">
    <div class=" container carousel-inner">
        <?php
    for ($i = 1; $i <= $paginas3; $i++) {
        if ($i == 1) { ?>
        <div class="row justify-content-around carousel-item active ml-0">
            <?php
        $consulta3 = "SELECT * FROM responsable r,crea c where r.idResponsable=c.idResponsable and c.idCausa=$idCausa LIMIT $ini3,$paginacion3";

        $respuesta3 = mysqli_query($con, $consulta3);
        ?>
            <?php
            //$filtro = 1;
        while ($fila3 = mysqli_fetch_array($respuesta3)) {
            ?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-4 ">
                <div class="card cardResponsables">
                    <img class="card-img-top sizeRespon" src="assest/images/<?= $fila3['imagenResposable']; ?>" alt="Card image cap">

                    <div class="card-body">
                        <h2 class="card-title text-center">
                            <?= $fila3['nombre']; ?>
                        </h2>
                    </div>
                </div>
            </div>
            <?php 
    }
    ?>
        </div>

        <?php

} else { ?>
        <div class="row justify-content-around carousel-item ml-0">
            <?php
        $consulta3 = "SELECT * FROM responsable r,crea c where r.idResponsable=c.idResponsable and c.idCausa=$idCausa LIMIT $ini3,$paginacion3";

        $respuesta3 = mysqli_query($con, $consulta3);
        ?>
            <?php
        while ($fila3 = mysqli_fetch_array($respuesta3)) { ?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-4 ">
                <div class="card cardResponsables">
                    <img class="card-img-top sizeRespon" src="assest/images/<?= $fila3['imagenResposable']; ?>" alt="Card image cap">
                    <div class="card-body ">
                        <h2 class="card-title text-center">
                            <?= $fila3['nombre']; ?>
                        </h2>
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
    $ini3 = $ini3 + 3;
}
?>
    </div>

    <a class="carousel-control-prev" href="#card-slideRespon" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#card-slideRespon" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>