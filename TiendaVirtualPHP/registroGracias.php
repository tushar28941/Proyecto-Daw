<?php require "php/sesion.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Contacto enviado</title>
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
                    <h2>Gracias por registrarte</h2>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to
                        using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web
                        sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                    </p>
                    <a href="index.php" class="btn btn-success" role="button">Volver al inicio</a>
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