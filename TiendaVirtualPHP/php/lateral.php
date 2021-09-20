<?php 
function masvendido($conn){
    $sql = "SELECT * FROM productos WHERE masvendido='1' LIMIT 3";
    $r = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_assoc($r)){
        print '<div class="card-body">'.$data["nombre"];
        print '<a href="producto.php?id='.$data["id"].'"><img src="imagenes/'.$data["imagen"].'" alt="moviles" class="media-object" width="100%"></a>';
        print "</div>";
    }
}

function nuevo($conn){
    $sql = "SELECT * FROM productos WHERE nuevo='1' LIMIT 3";
    $r = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_assoc($r)){
        print '<div class="card-body">'.$data["nombre"];
        print '<a href="producto.php?id='.$data["id"].'"><img src="imagenes/'.$data["imagen"].'" alt="moviles" class="media-object" width="100%"></a>';
        print "</div>";
    }
}
?>