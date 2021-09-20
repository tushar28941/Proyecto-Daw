<?php

if(isset($_POST["email"])){
    $email = $_POST["email"];
    $clave = $_POST["clave"];
    $clave2 = hash_hmac("sha512", $clave, "andro");
    $recordarme = $_POST["recordarme"];

    $nombre = "datos";
	$valor = $email."|".$clave;
	if($recordarme=="on"){
		$fecha = time() + (60*60*24*7);
	} else {
		$fecha = time() - 1;
	}
	setcookie($nombre, $valor, $fecha);

    $sql ="SELECT * FROM usuarios WHERE email='".$email."' AND clave='".$clave2."'";

    $r = mysqli_query($conn, $sql);
    $n = mysqli_num_rows($r);
    if($n==1){
        $usuario = mysqli_fetch_assoc($r);
        session_start();
        $_SESSION['usuario']=$usuario;
        header("location:".$saltaPag);
    } else {
        $error = "Email o contraseña incorrecta";
    }
}
$datos = $_COOKIE["datos"];
$email = "";
$clave = "";
$recordarme = "";
if(isset($datos)){
	$aDatos = explode("|", $datos);
	$email = $aDatos[0];
	$clave = $aDatos[1];
	$recordarme = "checked";
}

?>