<?php

session_start();

if(!isset($_SESSION["admin"])){
    header("location:index.php");
}

require "../php/conn.php";
require "../php/sesion.php";

if (isset($_GET["m"])){
    $m = $_GET["m"];
} else {
    $m = "S";
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
		header("location:usuarios.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($m=="B"){
    $id = $_GET["id"];

    $sql = "SELECT count(*) as num FROM carrito WHERE idUsuario=".$id;
    $r = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($r);
    $n = (mysqli_num_rows($r)==1)? $row["num"] : 0;

    if($n>0){
		$errores = array("No se puede borrar. Este usuario tiene ".$n." productos en el carrito de compra.");
		$m = "S";
	} else {
		$sql = "DELETE FROM usuarios WHERE id=".$id;
		if(mysqli_query($conn, $sql)){
			header("location:usuarios.php");
		}
		$errores = array("Error al borrar el registro");
	}
}

if ($m=="S"){
    $sql = "SELECT * FROM usuarios";
    $r = mysqli_query($conn, $sql);
    $usuarios = array();
    while($data = mysqli_fetch_assoc($r)){
        array_push($usuarios, $data);
    }
}

if ($m=="C"){
    $id = $_GET["id"];
    
    $sql = "SELECT * FROM usuarios WHERE id=" .$id;
    $r = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($r);

    $nombre = $data["nombre"];
    $apellido1 = $data["apellido1"];
    $apellido2 = $data["apellido2"];
    $email = $data["email"];
    $direccion = $data["direccion"];
    $localidad = $data["localidad"];
    $ciudad = $data["ciudad"];
    $codpos = $data["codpos"];
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Usuarios</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
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
                <li class="nav-item active">
                    <a class="nav-link" href="usuarios.php">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pedidos.php">Pedidos</a>
                </li>
                <li class="nav-item">
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
            <div class="col-sm-8 text-left">
                <div class="card-body">                
                <h2 class="text-center">Usuarios registrados</h2>
                <?php 
                if(count($errores)>0){
                    print '<div class="alert alert-danger">';
                    foreach ($errores as $key => $valor) {
                        print "<strong> ".$valor."</strong>";
                    }
                    print '</div>'; 
                }
                if($m=="C"){
                    
                            
                ?>
                    <form method="POST" action="usuarios.php">
                        <input type="hidden" id="id" name="id" value="<?php print $id; ?>">

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
                    <?php } 
                    if ($m=="S") {
                        print "<table class='table table-striped' width='100%'>";
                        print "<tr>";
                        print "<th>id</th>";
                        print "<th>Nombre</th>";
                        print "<th>Apellido 1</th>";
                        print "<th>Apellido 2</th>";
                        print "<th>Modificar</th>";
                        print "<th>Borrar</th>";
                        print "</tr>";
                        for ($i=0; $i < count($usuarios) ; $i++) { 
                            print "<tr>";
                            print "<td>".$usuarios[$i]["id"]."</td>";
                            print "<td>".$usuarios[$i]["nombre"]."</td>";
                            print "<td>".$usuarios[$i]["apellido1"]."</td>";
                            print "<td>".$usuarios[$i]["apellido2"]."</td>";
                            print "<td><a class='btn btn-info' href='usuarios.php?m=C&id=".$usuarios[$i]["id"]."'>Modificar</a></td>";
                            print "<td><a class='btn btn-danger' href='usuarios.php?m=B&id=".$usuarios[$i]["id"]."'>Borrar</a></td>";
                            print "</tr>";
                        }
                        print "</table>";
                    }                    
                    ?>
                </div>
            </div>
            <div class="col-sm-2 sidenav">
            </div>
        </div>
    </div>
</body>
</html>