<?php

session_start();

if(isset($_SESSION['usuario'])){
    $nombre = $_SESSION['usuario']['nombre'];
    $apellido1 = $_SESSION['usuario']['apellido1'];
    $apellido2 = $_SESSION['usuario']['apellido2'];
}
?>