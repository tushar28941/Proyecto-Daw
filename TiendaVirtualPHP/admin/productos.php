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

    $errores = array();
    $id = (isset($_POST["id"]))?$_POST["id"]:"";
    $nombre = $_POST["nombre"];
    $caracteristicas = $_POST["caracteristicas"];
    $precio = $_POST["precio"];
    $descuento = $_POST["descuento"];
    $envio = $_POST["envio"];
    $fecha = $_POST["fecha"];
    $imagen = $_POST["imagen"];
    $relacion1 = $_POST["relacion1"];
    $relacion2 = $_POST["relacion2"];
    $relacion3 = $_POST["relacion3"];
    $masvendido = ($_POST["masvendido"]=="")?"0":"1";
    $nuevo = ($_POST["nuevo"]=="")?"0":"1";

    $sql = "INSERT INTO productos VALUES(0,'0','".$nombre."', ";
    $sql .= "'".$caracteristicas."', ";
    $sql .= $precio.", ";
    $sql .= $descuento.", ";
    $sql .= $envio.", ";
    $sql .= "'".$fecha."', ";
    $sql .= "'".$imagen."', ";
    $sql .= "'".$relacion1."', ";
    $sql .= "'".$relacion2."', ";
    $sql .= "'".$relacion3."', ";
    $sql .= "'".$masvendido."', ";
    $sql .= "'".$nuevo."')";

    if($nombre==""){
        array_push($errores, "El nombre es obligatorio");
    } else {
        $buscar  = array(' ', '*', '!', '@', '?');
        $reemplazar = array('-', '', '', '', '');
        $imagen = str_replace($buscar, $reemplazar, $nombre);
        $imagen = $imagen.".jpg";
        if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
			copy($_FILES['imagen']['tmp_name'], "../imagenes/".$imagen);
		} else {
			array_push($errores, "Error en la carga de datos");
        }
                        $sql = "INSERT INTO productos VALUES(0,'0','".$nombre."', ";
                        $sql .= "'".$caracteristicas."', ";
                        $sql .= $precio.", ";
                        $sql .= $descuento.", ";
                        $sql .= $envio.", ";
                        $sql .= "'".$fecha."', ";
                        $sql .= "'".$imagen."', ";
                        $sql .= "'".$relacion1."', ";
                        $sql .= "'".$relacion2."', ";
                        $sql .= "'".$relacion3."', ";
                        $sql .= "'".$masvendido."', ";
                        $sql .= "'".$nuevo."')";

                   /* $sql = "UPDATE productos SET ";
                    $sql .= "nombre = '".$nombre."', ";
                    $sql .= "caracteristicas = '".$caracteristicas."', ";
                    $sql .= "precio = ".$precio.", ";
                    $sql .= "descuento = ".$descuento.", ";
                    $sql .= "envio = ".$envio.", ";
                    $sql .= "fecha = '".$fecha."', ";
                    $sql .= "imagen = '".$imagen."', ";
                    $sql .= "relacion1 = '".$relacion1."', ";
                    $sql .= "relacion2 = '".$relacion2."', ";
                    $sql .= "relacion3 = '".$relacion3."', ";
                    $sql .= "masvendido = '".$masvendido."', ";
                    $sql .= "nuevo = '".$nuevo."' ";
                    $sql .= "WHERE id=".$id;
                    */

                
        
        if(mysqli_query($conn, $sql)){
            header("location:productos.php");


        } else {
            array_push($errores,"Error al insertar los datos ");
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }  
    
}

if ($m=="B"){
    $id = $_GET["id"];
    $sql ="SELECT imagen FROM productos WHERE id=".$id;
    $r = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($r);
    $imagen = $row["imagen"];
    unlink("../imagenes/".$imagen);
    $sql = "DELETE FROM productos WHERE id=".$id;
    if (mysqli_query($conn, $sql)){
        header("location:productos.php");
    }

    $errores = array("Error al borrar");
}

if ($m=="S"){
    $sql = "SELECT * FROM productos WHERE tipo='0'";
    $r = mysqli_query($conn, $sql);
    $productos = array();
    while($row = mysqli_fetch_assoc($r)){
        array_push($productos, $row);
    }
}

if ($m=="A" || $m=="C"){
    $sql = "SELECT id,nombre FROM productos ORDER BY nombre";
    $r = mysqli_query($conn, $sql);
    $productos = array();
    while($row = mysqli_fetch_assoc($r)){
        array_push($productos, $row);
    }
}

if ($m=="C"){
    $id = $_GET["id"];
    $sql = "SELECT * FROM productos WHERE id=" .$id;
    $r = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($r);

    $nombre = $data["nombre"];
    $caracteristicas = $data["caracteristicas"];
    $precio = $data["precio"];
    $descuento = $data["descuento"];
    $envio = $data["envio"];
    $fecha = $data["fecha"];
    $imagen = $data["imagen"];
    $relacion1 = $data["relacion1"];
    $relacion2 = $data["relacion2"];
    $relacion3 = $data["relacion3"];
    $masvendido = $data["masvendido"];
    $nuevo = $data["nuevo"];
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Productos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        window.onload = function() {
            <?php if($m=="C") { ?>
            document.getElementById("borrar").onclick = function () {
                if (confirm("¿Eliminar el producto?")){
                    var id = <?php print $id; ?>;
                    window.open("productos.php?m=B&id="+id,"_self");
                }                
            }
            <?php } ?>

            <?php if($m=="S") { ?>
				document.getElementById("alta").onclick = function() {
				window.open("productos.php?m=A","_self");
			}
            <?php } else { ?>
            document.getElementById("volver").onclick = function () {
                window.open("productos.php","_self");
            }
            <?php } ?>
            
        }
    </script>
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
                <li class="nav-item active">
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
            <?php if($m=="S") { ?>
                <label for="alta"></label>
                <input type="button" name="alta" id="alta" value="Crear un producto" class="btn btn-info" role="button">
            <?php } ?>
            </div>
            <div class="col-sm-8 text-left">
                <div class="card-body">                
                <h2 class="text-center">Productos</h2>
                <?php 
                if($m=="A" || $m=="C"){
                    if(count($errores)>0){
                        print '<div class="alert alert-danger">';
                        foreach ($errores as $key => $valor) {
							print "<strong> ".$valor."</strong>";
						}
                    print '</div>'; 
                    }
                            
                ?>
                    <form method="POST" action="productos.php" enctype="multipart/form-data">
                        <div class="form-group text-left">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Escribe el nombre" value="<?php print $nombre;?>">
                        </div>
                        <div class="form-group text-left">
                            <label for="caracteristicas">Caracteristicas:</label>
                            <textarea class="form-control" name="caracteristicas" id="caracteristicas" cols="30" rows="10"><?php print $caracteristicas;?></textarea>
                        </div>
                        <div class="form-group text-left">
                            <label for="precio">Precio:</label>
                            <input type="number" name="precio" id="precio" class="form-control" placeholder="Precio" value="<?php print $precio;?>">
                        </div>
                        <div class="form-group text-left">
                            <label for="descuento">Descuento:</label>
                            <input type="number" name="descuento" id="descuento" class="form-control" placeholder="Descuento" value="<?php print $descuento;?>">
                        </div>
                        <div class="form-group text-left">
                            <label for="envio">Coste de envío:</label>
                            <input type="number" name="envio" id="envio" class="form-control" placeholder="Coste de envío" value="<?php print $envio;?>">
                        </div>
                        <div class="form-group text-left">
						<label for="fecha">* Fecha de salida:</label>
						<input type="date" name="fecha" id="fecha" class="form-control" value="<?php print $fecha;?>">
					    </div>
                        <div class="form-group text-left">
                            <label for="imagen">Imagen:</label>
                            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/jpg">
                            <?php
                                if(isset($imagen)){
                                    print "<img src='../imagenes/".$imagen."' width='150'/>";
								    print "<p>".$imagen."</p>";            
                                }
                            ?>
                        </div>
                        <div class="form-group text-left">
                            <label for="relacion1">Móvil relacionado 1:</label>        
                            <select name="relacion1" id="relacion1">
                                <option value="0">No hay móviles relacionados</option>
                                <?php
                                    for ($i=0; $i <  count($productos) ; $i++) { 
                                        print "<option value='".$productos[$i]["id"]. "'";
                                        if ($productos[$i]["id"]==$relacion1) print " selected ";
                                        print "/".$productos[$i]["nombre"]."</option>";
                                    }
                                ?>
                            </select>                
                        </div>
                        <div class="form-group text-left">
                            <label for="relacion2">Móvil relacionado 2:</label>      
                            <select name="relacion2" id="relacion2">
                                <option value="0">No hay móviles relacionados</option>
                                <?php
                                    for ($i=0; $i <  count($productos) ; $i++) { 
                                        print "<option value='".$productos[$i]["id"]. "'";
                                        if ($productos[$i]["id"]==$relacion2) print " selected ";
                                        print "/".$productos[$i]["nombre"]."</option>";
                                    }
                                ?>
                            </select>                     
                        </div>
                        <div class="form-group text-left">
                            <label for="relacion3">Móvil relacionado 3:</label>
                            <select name="relacion3" id="relacion3">
                                <option value="0">No hay móviles relacionados</option>
                                <?php
                                    for ($i=0; $i <  count($productos) ; $i++) { 
                                        print "<option value='".$productos[$i]["id"]. "'";
                                        if ($productos[$i]["id"]==$relacion3) print " selected ";
                                        print "/".$productos[$i]["nombre"]."</option>";
                                    }
                                ?>
                            </select>                           
                        </div>
                        <div class="form-group">
                            <label><input type="checkbox" name="masvendido" id="masvendido" <?php if($masvendido=="1") print "checked";?>>¿Móvil mas vendido?</label>
                        </div>
                        <div class="form-group">
                            <label><input type="checkbox" name="nuevo" id="nuevo" <?php if($nuevo=="1") print "checked";?>>¿Móvil nuevo?</label>
                        </div>

                        <input type="hidden" name="id" id="id" value=" <?php print $id; ?>">

                        <div class="form-group text-left">
                            <label for="volver"></label>
                            <input type="button" name="volver" id="volver" value="Volver" class="btn btn-info" role="button" id="vovler">

                            <label for="enviar"></label>
                            <input type="submit" name="enviar" id="enviar" value="Enviar" class="btn btn-success" role="button">

                            
                            
                            <?php if($m=="C"){ ?>
                            <label for="borrar"></label>
                            <input type="button" name="borrar" id="borrar" value="Borrar" class="btn btn-danger" role="button" id="borrar">
                            <?php } ?>

                        </div>
                    </form>
                    <?php } 
                    if ($m=="S") {
                        $ren = 0;
                        for ($i=0; $i < count($productos) ; $i++) { 
                            if ($ren==0) {
                                print '<div class="row">';
                            }
                            print '<div class="col-sm-3">';
                            print '<img src="../imagenes/'.$productos[$i]["imagen"].'" class="img-responsive img-rounded" style="width:100%" alt="'.$productos[$i]["nombre"].'">';
                            print '<p><a href="productos.php?m=C&id='.$productos[$i]["id"].'">'.$productos[$i]["nombre"].'</a></p>';
                            print '</div>';
                            $ren++;
                            if ($ren==4) {
                                $ren = 0;
                                print "</div>";
                            }
                        }
                    }                    
                    ?>
                </div>
            </div>
            <div class="col-sm-2 sidenav">
            </div>
        </div>
    </div>

    <br>
    <br>

    <footer class="container-fluid text-center">
    </footer>
</body>

</html>