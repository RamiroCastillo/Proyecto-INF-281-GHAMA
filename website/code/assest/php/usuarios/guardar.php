<?php
    session_start();
    
?>
<?php
require_once('../Database.php');
require_once('../Validar.php');
date_default_timezone_set("America/La_Paz");
mysql_query("SET NAMES utf8");
$db=Database::getInstance();
$con = $db->getConnection();
$validar = new Validar();
if (isset($_SESSION['user']) != "") {
    header("Location: ../../../index.php");
}

$nombre = $validar->filterForm($_POST['nombre']);
$apellido = $validar->filterForm($_POST['apellido']);
$correo = $validar->filterForm($_POST['correo']);
$correoc = $validar->filterForm($_POST['correoc']);
$password = $validar->filterForm($_POST['password']);
$passwordc = $validar->filterForm($_POST['passwordc']);
$ci= $validar->filterForm($_POST['ci']);
$telefono = $validar->filterForm($_POST['telefono']);
$celular = $validar->filterForm($_POST['cel']);
$direccion = $validar->filterForm($_POST['direccion']);
$ocupacion   = $validar->filterForm($_POST['ocupacion']);
$fechaNac = $validar->filterForm($_POST['fechaNac']);
  //verificamos si el email ya esta registrado
$query = "SELECT idUsuario, nombre, password FROM usuario WHERE email= '$correo' ";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
echo($row['nombre']);
$count = mysqli_num_rows($result);

    // si $count es cero indica de que no esta registrado el email
if ($count == 0) {
    
        //insertamos al nuevo usuario
    $query = "INSERT INTO usuario(nombre, apellido, ci, telefono, celular, direccion, ocupacion, fecha_nac, email, password, foto) VALUES('$nombre','$apellido','$ci','$telefono','$celular','$direccion','$ocupacion','$fechaNac','$correo',MD5('$password'),'pusuario.png')";
    $result = mysqli_query($con, $query);
    $user_id = mysqli_insert_id($con);
    if (!$result) {
        echo "<script> alert('no enviadoo');; window.location='../../../index.php'</script>";
    } else {

        echo "<script> alert('Usuario registrado. Puedes iniciar sesión'); window.location='../../../index.php'</script>";
    }

    /*if ($user_id > 0) {
            // set session and redirect to index page
        $_SESSION['user'] = $user_id;
        echo "entro";
        echo "<br>";
        print_r($_SESSION);
        /*$_SESSION['activo'] = 1;*/
        /*header("Location: ../../../index.php");
        exit;*/
    /*} else {
        $errTyp = "danger";
        $errMSG = "Algo salió mal, intenta de nuevo";
        echo "no entro";
    }*/
} else {
    $errTyp = "warning";
    $errMSG = "El email ya está en uso";
    echo "email en uso";
}


?>