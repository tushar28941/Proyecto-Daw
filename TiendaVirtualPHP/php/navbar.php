<?php

    if (isset($_SESSION["carrito"])) {
        print '<li><a href="carrito.php"><span class="btn btn-outline-success my-2 my-sm-0 fas fa-shopping-cart fa-2x"></span></a></li>';
    }
    if(isset($_SESSION['usuario'])){
        print '<li><a href="#"  class="btn btn-outline-info my-2 my-sm-0"> Bienvenido '.$nombre." ".$apellido1." ".$apellido2.'</a></li>';
        print '<li><a href="logout.php" class="btn btn-outline-success my-2 my-sm-0">Log Out</a></li>';
    } else {
        print '<li><a href="login.php" class="btn btn-outline-success my-2 my-sm-0">Log In</a></li>';
    }

?>