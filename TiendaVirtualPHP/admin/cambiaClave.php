<?php

session_start();

if(!isset($_SESSION["admin"])){
    header("location:index.php");
}
require "../php/conn.php";

if(isset($_POST["clave1"])){
    $clave1 = $_POST["clave1"];
    $clave2 = $_POST["clave2"];

    if($clave1===$clave2){
        $clave = hash_hmac("sha512",$clave1,"andro");
        $sql = "UPDATE admin SET clave='".$clave."'";
        if(mysqli_query($conn, $sql)){
            header("location:index.php");
		} else {
			$errores = "Error al cambiar la contraseña";
		}
    } else {
        $errores = "Las Contraseñas no coinciden";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Cambiar contraseña del admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/de3b316a2b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="productos.php">Móviles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="graficas.php">Tarjetas Gráficas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="usuarios.php">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pedidos.php">Pedidos</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="cambiaClave.php">Cambiar Contraseña</a>
                </li>
            </ul>
            <p>
                <?php require "php/logout.php"; ?>
            </p>
        </div>
    </nav>

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
            </div>
            <div class="col-sm-8 text-center">
                <div class="card-body">
                <?php if(!empty($errores)): ?>
                            <div class="alert alert-danger">
                                <strong>
                                    <?php echo $errores  ?>
                                </strong>
                            </div>
                <?php endif; ?>
                    <h2 class="text-center">Cambia la clave de acceso del administrador</h2>
                    <form method="POST" action="cambiaClave.php">
                        <div class="form-group text-left">
                            <label for="clave1">Contraseña:</label>
                            <input type="password" name="clave1" id="clave1" class="form-control" placeholder="Escribe la contraseña">
                        </div>
                        <div class="form-group text-left">
                            <label for="clave2">Confirma la contraseña:</label>
                            <input type="password" name="clave2" id="clave2" class="form-control" placeholder="Confirma la contraseña">
                        </div>
                        <div class="form-group text-left">
                            <label for="enviar"></label>
                            <input type="submit" name="enviar" id="enviar" value="Enviar" class="btn btn-success" role="button">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-2 sidenav">
            </div>
        </div>
    </div>
</body>

</html>