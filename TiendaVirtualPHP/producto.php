<?php 
require "php/sesion.php"; 
require "php/conn.php";
require "php/carrito.php";
require "php/lateral.php";
if(isset($_GET["id"])){
    if (isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "SELECT * FROM productos WHERE id=".$id;
        $r = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($r);
    }
}
function mostrar($id, $conn){
    $sql = "SELECT nombre,imagen FROM productos WHERE id=".$id;
    $r = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($r);

    print '<div class="card-body">'.$data["nombre"];
    print '<a href="producto.php?id='.$id.'"><img src="imagenes/'.$data["imagen"].'" alt="consola" class="media-object" width="100%"></a>';
    print '</div>';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Tarjetas Gráficas</title>
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
                <img src="imagenes/<?php print $data['imagen']; ?>" alt="ordenador" class="media-object" width="100%">
                <br>
                <h4>Producto: <?php print $data['id']; ?></h4>
                <h4>Precio: <?php print $data['precio']; ?>€</h4>
                <br><br>
                <div class="card-body">
                    <p>Carrito</p>
                    <p>Total: <?php print desplegar2($carrito, $conn); ?>€</p>
                </div>
                <a href="carrito.php?id=<?php print $id; ?>" class="btn btn-success" role="button">Carrito</a>
                <a href="index.php" class="btn btn-info" role="button">Regresar</a>
            </div>
            <div class="col-sm-8 text-left">
                <h2><?php print $data['nombre']; ?></h2>
                <br>
                <h4>Caracteristicas: </h4>
                <br>
                <p><?php print $data['caracteristicas']; ?></p>
            </div>
            <div class="col-sm-2 sidenav">
                <?php
                if($data["tipo"]=="0"){
                    print '<h4>Productos relacionados</h4>';
                    print '<div class="card-body">';
                    if($data["relacion1"]!=0){
                    mostrar($data["relacion1"], $conn);
                    }
                    if($data["relacion2"]!=0){
                        mostrar($data["relacion2"], $conn);
                    }
                    if($data["relacion3"]!=0){
                        mostrar($data["relacion3"], $conn);
                    }
                } else if ($data["tipo"]=="1") {
                    print '<h4>Productos nuevos</h4>';
                    print '<div class="card-body">';
                    nuevo($conn);
                }
                ?>
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