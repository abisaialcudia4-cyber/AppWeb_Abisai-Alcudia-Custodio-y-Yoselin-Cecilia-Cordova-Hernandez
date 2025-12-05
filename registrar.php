<?php
include "conexion.php";

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$sql = "INSERT INTO usuarios (nombres, apellidos, correo, contrasena)
        VALUES ('$nombres', '$apellidos', '$correo', '$contrasena')";

if (mysqli_query($conexion, $sql)) {
    echo "
        <script>
            alert('✔ Registro realizado exitosamente');
            window.location = 'login.html';
        </script>
    ";
} else {
    echo "
        <script>
            alert('❌ Error: No se pudo registrar. El correo ya existe o hubo un problema.');
            window.location = 'registro.html';
        </script>
    ";
}
?>
    