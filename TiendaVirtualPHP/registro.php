<?php
require "php/conn.php";
if(isset($_POST["nombre"])){
    $nombre = $_POST["nombre"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    $localidad = $_POST["localidad"];
    $ciudad = $_POST["ciudad"];
    $codpos = $_POST["codpos"];
	$clave1 = $_POST["clave1"];
	$clave2 = $_POST["clave2"];

    $errores = '';
    if ($nombre==""){
        //$error[0]="Ingresa el nombre";
        $errores .= '<li>Nombre esta vacio</li>';
    } else if ($apellido1=="") {
        //$error[1]="Ingresa el primer apellido";
        $errores .= '<li>Apellido esta vacio</li>';
    } else if ($email=="") {
        //$error[2]="Ingresa el email";
        $errores .= '<li>Email esta vacio</li>';
    } else if ($direccion=="") {
        //$error[3]="Ingresa la dirección";
        $errores .= '<li>Dirección esta vacio</li>';
    } else if ($localidad=="") {
        //$error[4]="Ingresa la localidad";
        $errores .= '<li>Localidad esta vacio</li>';
    } else if ($ciudad=="") {
        //$error[5]="Ingresa la ciudad";
        $errores .= '<li>Ciudad esta vacio</li>';
    } else if ($codpos=="") {
        //$error[6]="Ingresa el código postal";
        $errores .= '<li>Código postal esta vacio</li>';
    }else if ($clave1!==$clave2) {
        //$error[9]="Las Contraseñas no coinciden";
        $errores .= '<li>Las Contraseñas no coinciden</li>';
    } else {
        if(validarCorreo($email, $conn)){
            $clave = hash_hmac("sha512",$clave1,"andro");
            $sql = "INSERT INTO usuarios VALUES(0, ";
            $sql .= "'".$nombre."', '".$apellido1."',"; 
            $sql .= "'".$apellido2."', '".$email."',";
            $sql .= "'".$direccion."', '".$localidad."',"; 
            $sql .= "'".$ciudad."', '".$codpos."', '".$clave."')";
        
            if (mysqli_query($conn, $sql)){
                header("location:registroGracias.php");
            } else {
                $error[7]="Error al insertar los datos";
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $errores .= '<li>Ya está registrado el email</li>';
        }
            
        }
    }

    function validarCorreo($email, $conn){
        $sql = "SELECT * FROM usuarios WHERE email='".$email."'";
        $r = mysqli_query($conn, $sql);
        $n = mysqli_num_rows($r);
        $bandera = ($n==0)? true : false;  
        return $bandera;
    }


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Registrar</title>
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
            <div class="col-sm-8 text-left">
                <div class="card-body">
                <?php if(!empty($errores)): ?>
                            <div class="alert alert-danger">
                                <strong>
                                    <?php echo $errores  ?>
                                </strong>
                            </div>
                <?php endif; ?>
                    <h2 class="text-center">Registrar</h2>
                    <p>Rellene sus datos</p>
                    <form method="POST" action="registro.php">
                        <div class="form-group text-left">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Escribe el nombre">
                        </div>
                        <div class="form-group text-left">
                            <label for="apellido1">Apellido 1:</label>
                            <input type="text" name="apellido1" id="apellido1" class="form-control" placeholder="Escribe el primer apellido">
                        </div>
                        <div class="form-group text-left">
                            <label for="apellido2">Apellido 2:</label>
                            <input type="text" name="apellido2" id="apellido2" class="form-control" placeholder="Escribe el segundo apellido">
                        </div>
                        <div class="form-group text-left">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Escribe el email">
                        </div>
                        <div class="form-group text-left">
                            <label for="clave1">Contraseña:</label>
                            <input type="password" name="clave1" id="clave1" class="form-control" placeholder="Escribe la contraseña">
                        </div>
                        <div class="form-group text-left">
                            <label for="clave2">Confirma la contraseña:</label>
                            <input type="password" name="clave2" id="clave2" class="form-control" placeholder="Confirma la contraseña">
                        </div>
                        <div class="form-group text-left">
                            <label for="direccion">Direccion:</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Escribe la direccion">
                        </div>
                        <div class="form-group text-left">
                            <label for="localidad">Localidad:</label>
                            <input type="text" name="localidad" id="localidad" class="form-control" placeholder="Escribe la localidad">
                        </div>
                        <div class="form-group text-left">
                            <label for="ciudad">Ciudad:</label>
                            <input type="text" name="ciudad" id="ciudad" class="form-control" placeholder="Escribe la ciudad">
                        </div>
                        <div class="form-group text-left">
                            <label for="codpos">Código postal:</label>
                            <input type="text" name="codpos" id="codpos" class="form-control" placeholder="Escribe el código postal">
                        </div>
                        <div class="form-group text-left">
                            <label for="enviar"></label>
                            <input type="submit" name="enviar" id="enviar" value="Enviar" class="btn btn-success" role="button">
                        </div>
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