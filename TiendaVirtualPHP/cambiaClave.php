<?php
require "php/conn.php";
require "php/sesion.php"; 

if(isset($_GET["id"])){
    $id = $_GET["id"];

    $sql = "SELECT * FROM usuarios WHERE id=".$id;

    $resultado = mysqli_query($conn, $sql);
	$n = mysqli_num_rows($resultado);
	if($n!=1){
		header("location:index.php");
	}
}

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $clave1 = $_POST["clave1"];
    $clave2 = $_POST["clave2"];

    if($clave1===$clave2){
        $clave = hash_hmac("sha512",$clave1,"andro");
        $sql = "UPDATE usuarios SET clave='".$clave."' WHERE id=".$id;
        if(mysqli_query($conn, $sql)){
            header("location:cambiaClaveGracias.php");
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
    <title>Cambiar contraseña</title>
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
            <a href="login.php" class="btn btn-outline-success my-2 my-sm-0">Log In</a>
        </div>
    </nav>

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <h4>Productos relacionados</h4>
                <div class="card-body">Moviles
                    <a href="producto.php"><img src="imagenes/moviles.jpg" alt="moviles" class="media-object" width="100%"></a>
                </div>
                <div class="card-body">Tablets
                    <a href="producto.php"><img src="imagenes/tablet.jpg" alt="tablet" class="media-object" width="100%"></a>
                </div>
                <div class="card-body">Consolas
                    <a href="producto.php"><img src="imagenes/consola.jpg" alt="consola" class="media-object" width="100%"></a>
                </div>
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
                    <h2 class="text-center">Cambia la clave de acceso</h2>
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

                        <input type="hidden" name ="id" id="id" value="<? print $id; ?>">
                    </form>
                </div>
            </div>
            <div class="col-sm-2 sidenav">
                <h4>Productos relacionados</h4>
                <div class="card-body">Moviles
                    <a href="producto.php"><img src="imagenes/moviles.jpg" alt="moviles" width="100%"></a>
                </div>
                <div class="card-body">Tablets
                    <a href="producto.php"><img src="imagenes/tablet.jpg" alt="tablet" width="100%"></a>
                </div>
                <div class="card-body">Consolas
                    <a href="producto.php"><img src="imagenes/consola.jpg" alt="consola" width="100%"></a>
                </div>
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