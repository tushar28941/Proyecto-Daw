<?php

session_start();

if(!isset($_SESSION["admin"])){
    header("location:index.php");
}

require "../php/conn.php";
require "../php/sesion.php";
require "../php/carrito.php";

if (isset($_GET["m"])){
    $m = $_GET["m"];
} else {
    $m = "S";
}

if ($m=="D"){
    $id = $_GET["id"];
    $sql = "SELECT * FROM carrito WHERE num='".$id."'";
    $r = mysqli_query($conn, $sql);

    while($data = mysqli_fetch_assoc($r)){
		$sql = "INSERT INTO historicopedidos ";
		$sql .= "SET num='".$data["num"]."', ";
		$sql .= "estado='".$data["estado"]."', ";
		$sql .= "idProducto=".$data["idProducto"].", ";
		$sql .= "precio=".$data["precio"].", ";
		$sql .= "descuento=".$data["descuento"].", ";
		$sql .= "envio=".$data["envio"].", ";
		$sql .= "cantidad=".$data["cantidad"];
		if (!mysqli_query($conn, $sql)) {
			print "Error al insertar el producto";
		}
    }
    
    $sql = "DELETE FROM carrito WHERE num='".$id."'";
	if(mysqli_query($conn, $sql)){
		header("location:pedidos.php");
	}
	$errores = array("Error al borrar el registro");
}

if ($m=="S"){
    $sql = "SELECT idUsuario, fecha, estado, precio as importe, cantidad, descuento, envio FROM carrito ORDER BY fecha";
    $r = mysqli_query($conn, $sql);
    $pedidos = array();
    while($data = mysqli_fetch_assoc($r)){
        array_push($pedidos, $data);
    }
}

if ($m=="B"){
    $carrito = $_GET["id"];
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
                <li class="nav-item">
                    <a class="nav-link" href="usuarios.php">Usuarios</a>
                </li>
                <li class="nav-item active">
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
                <h2 class="text-center">Pedidos registrados</h2>
                <?php 
                if(count($errores)>0){
                    print '<div class="alert alert-danger">';
                    foreach ($errores as $key => $valor) {
                        print "<strong> ".$valor."</strong>";
                    }
                    print '</div>'; 
                }
                if($m=="B"){
                    print '<div class="alert alert-danger">';
                    print "¿Desea borrar este pedido?";
                    print"<a href='pedidos.php'>No</a>&nbsp;";
                    print"<a href='pedidos.php?m=D&id=".$carrito."'>Si</a>&nbsp;";
                    print "<p>Los datos parasar a la tabla de históricos</p>";
                    print "</div>";  
                    despliegaCarritoConsulta($carrito, $conn);                                              
                } 
                    if ($m=="S") {
                        print "<table class='table table-striped' width='100%'>";
                        print "<tr>";
                        print "<th>Estado</th>";
                        print "<th>Importe</th>";
                        print "<th>Cantidad</th>";
                        print "<th>Descuento</th>";
                        print "<th>Envio</th>";
                        print "<th>Total</th>";
                        print "<th>Cliente</th>";
                        print "<th>Fecha de pedido</th>";
                        print "<th>Borrar</th>";
                        print "</tr>";
                        for ($i=0; $i < count($pedidos) ; $i++) { 
                            $total = ($pedidos[$i]["importe"] - $pedidos[$i]["descuento"]) * $pedidos[$i]["cantidad"] + $pedidos[$i]["envio"];
                            
                            if($pedidos[$i]["estado"]=="0"){
                                print "<tr class='bg-warning'>";
                                print "<td>";
                                print "Abierto";
                            }
                            if($pedidos[$i]["estado"]=="1"){
                                print "<tr class='bg-success'>";
                                print "<td>";
                                print "Realizado";
                            }
                            print "</td>";                            
                            print "<td>".number_format($pedidos[$i]["importe"],2)." €</td>";
                            print "<td>".number_format($pedidos[$i]["cantidad"])."</td>";
                            print "<td>".number_format($pedidos[$i]["descuento"],2)." €</td>";
                            print "<td>".number_format($pedidos[$i]["envio"],2)." €</td>";
                            print "<td>".number_format($total,2)." €</td>";
                            print "<td>".$pedidos[$i]["idUsuario"]."</td>";
                            print "<td>".$pedidos[$i]["fecha"]."</td>";
                            print "<td><a class='btn btn-danger' href='pedidos.php?m=B&id=".$pedidos[$i]["num"]."'>Borrar</a></td>";
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