<?php
require "php/sesion.php";
require "php/conn.php";
require "php/lateral.php";

if(!isset($_SESSION["usuario"])){
    header("location:login.php");
    exit;
}

if(isset($_POST["nombre"])){
    $id = $_SESSION["usuario"]["id"];
    $nombre = $_POST["nombre"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    $localidad = $_POST["localidad"];
    $ciudad = $_POST["ciudad"];
    $codpos = $_POST["codpos"];
    
    $sql = "UPDATE usuarios SET ";
	$sql .= "nombre='".$nombre."', ";
	$sql .= "apellido1='".$apellido1."', ";
	$sql .= "apellido2='".$apellido2."', ";
	$sql .= "email='".$email."', ";
	$sql .= "direccion='".$direccion."', ";
	$sql .= "localidad='".$localidad."', ";
	$sql .= "ciudad='".$ciudad."', ";
	$sql .= "codpos='".$codpos."' ";
    $sql .= "WHERE id=".$id;
    
    if(mysqli_query($conn, $sql)){
		$sql = "SELECT * FROM usuarios WHERE id=".$id;
		$r = mysqli_query($conn, $sql);
		$usuario = mysqli_fetch_assoc($r);
		$_SESSION["usuario"]=$usuario;
		header("location:pago.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

$nombre = $_SESSION["usuario"]["nombre"];
$apellido1 = $_SESSION["usuario"]["apellido1"];
$apellido2 = $_SESSION["usuario"]["apellido2"];
$email = $_SESSION["usuario"]["email"];
$direccion = $_SESSION["usuario"]["direccion"];
$localidad = $_SESSION["usuario"]["localidad"];
$ciudad = $_SESSION["usuario"]["ciudad"];
$codpos = $_SESSION["usuario"]["codpos"];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Datos de envío</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/de3b316a2b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Móviles Andromeda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="moviles.php">Móviles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="graficas.php">Tarjetas Gráficas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="acercade.php">Acerca de</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacto.php">Contacto</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <?php require "php/navbar.php"; ?>
            </ul>
        </div>
    </nav>

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <h4>Productos más vendidos</h4>
                <?php masvendido($conn); ?>
            </div>
            <div class="col-sm-8 text-left">
                <div class="card-body">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="checkout.php">Iniciar Sesión</a></li>
                        <li class="breadcrumb-item active">Datos de envío</li>
                        <li class="breadcrumb-item">Forma de pago</li>
                        <li class="breadcrumb-item">Revisar</li>
                    </ol>
                    <h2 class="text-center">Datos de envío</h2>
                    <p>Verifique los datos</p>
                    <form method="POST" action="direccion.php">
                        <div class="form-group text-left">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Escribe el nombre" value="<?php print $nombre; ?>">
                        </div>
                        <div class="form-group text-left">
                            <label for="apellido1">Apellido 1:</label>
                            <input type="text" name="apellido1" id="apellido1" class="form-control" required placeholder="Escribe el primer apellido" value="<?php print $apellido1; ?>">
                        </div>
                        <div class="form-group text-left">
                            <label for="apellido2">Apellido 2:</label>
                            <input type="text" name="apellido2" id="apellido2" class="form-control" placeholder="Escribe el secundo apellido" value="<?php print $apellido2; ?>">
                        </div>
                        <div class="form-group text-left">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Escribe el email" value="<?php print $email; ?>" required>
                        </div>
                        <div class="form-group text-left">
                            <label for="direccion">Direccion:</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" required placeholder="Escribe la direccion"  value="<?php print $direccion; ?>">
                        </div>
                        <div class="form-group text-left">
                            <label for="localidad">Localidad:</label>
                            <input type="text" name="localidad" id="localidad" class="form-control" required placeholder="Escribe la localidad" value="<?php print $localidad; ?>">
                        </div>
                        <div class="form-group text-left">
                            <label for="ciudad">Ciudad:</label>
                            <input type="text" name="ciudad" id="ciudad" class="form-control" required placeholder="Escribe la ciudad" value="<?php print $ciudad; ?>">
                        </div>
                        <div class="form-group text-left">
                            <label for="codpos">Código postal:</label>
                            <input type="text" name="codpos" id="codpos" class="form-control" required placeholder="Escribe el código postal" value="<?php print $codpos; ?>">
                        </div>
                        <div class="form-group text-left">
                            <label for="enviar"></label>
                            <input type="submit" name="enviar" id="enviar" value="Enviar" class="btn btn-success" role="button">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-2 sidenav">
                <h4>Productos nuevos</h4>
                <?php nuevo($conn); ?>
            </div>
        </div>
    </div>

    <br>
    <br>

    <footer class="container-fluid text-center">
        <a href="aviso.php">Aviso de privacidad</a>
    </footer>
</body>

</html>