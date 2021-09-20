<?php 
require "php/sesion.php"; 
require "php/conn.php";
require "php/lateral.php";
$saltaPag = "./direccion.php";
if(isset($_SESSION["usuario"])){
    header("location:".$saltaPag);
    exit;
}
require "php/login.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Checkout</title>
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
            <div class="col-sm-8 text-center">
                <div class="card-body" id="conten">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Iniciar Sesión</li>
                        <li class="breadcrumb-item">Datos de envío</li>
                        <li class="breadcrumb-item">Forma de pago</li>
                        <li class="breadcrumb-item">Revisar</li>
                    </ol>
                    <h2>Checkout</h2>
                    <form action="" class="text-left">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required placeholder="Escribe el email">
                        </div>
                        <div class="form-group">
                            <label for="email">Contraseña:</label>
                            <input type="password" name="clave" id="clave" class="form-control" required placeholder="Escribe la contraseña">
                        </div>
                        <div class="checkbox">
                            <label for="checkbox"><input type="checkbox" name="checkbox" id="checkbox">Recordarme</label>
                        </div>
                        <a href="direccion.php" class="btn btn-success">Enviar</a>
                    </form>
                </div>
                <div class="card-body text-left" id="conten">
                    <a href="olvido.php" class="btn btn-info">¿Olvidó su contraseña?</a>
                    <br><br>
                    <a href="registro.php" class="btn btn-info">Registrar</a>
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