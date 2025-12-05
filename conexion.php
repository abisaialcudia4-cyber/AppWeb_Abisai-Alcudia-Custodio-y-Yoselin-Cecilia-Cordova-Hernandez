<?php
$host = "localhost";
$usuario = "root";
$clave = ""; 
$bd = "talleres_ut"; // <-- CAMBIA ESTO al nombre de tu BD

$conexion = mysqli_connect($host, $usuario, $clave, $bd);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
