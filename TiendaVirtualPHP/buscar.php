<?php 
require "php/sesion.php"; 
require "php/conn.php";
require "php/lateral.php";

if(isset($_GET["buscar"])){
    $buscar = $_GET["buscar"];
    $sql = "SELECT * FROM productos WHERE nombre LIKE '%".$buscar."%' OR caracteristicas LIKE '%".$buscar."%'";
    $r = mysqli_query($conn, $sql);
    $productos = array();
    while ($data = mysqli_fetch_assoc($r)) {
        array_push($productos, $data);
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Búsqueda</title>
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
                    <h2 class="text-center">Resultado de la búsqueda: <?php print $buscar; ?></h2>
                    <?php
                        for ($i=0; $i < count($productos); $i++) { 
                            print '<div class="media">';
                            print '<div class="media-left">';
                            print '<img src="imagenes/'.$productos[$i]["imagen"].'" class="media-object">';
                            print '</div>';
                            print '<div class="media-body">';
                            print '<h4 class="media-heading"><a href="producto.php?id='.$productos[$i]["id"].'">'.$productos[$i]["nombre"].'</a></h4>'; 
                            print '<p>'.$productos[$i]["caracteristicas"].'</p>';
                            print '</div>';
                            print '</div>';
                        }
                    ?>
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