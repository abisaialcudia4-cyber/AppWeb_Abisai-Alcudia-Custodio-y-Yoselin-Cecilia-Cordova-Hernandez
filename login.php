<?php
include "conexion.php";

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Buscar si existe el usuario
$sql = "SELECT * FROM usuarios WHERE correo='$correo' AND contrasena='$contrasena'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) > 0) {

    echo "
        <script>
            alert('✔ Bienvenido a la página web');
            window.location = 'http://localhost/ProyectoWeb/html/index.html';  
        </script>
    ";

} else {

    echo "
        <script>
            alert('❌ Correo o contraseña incorrectos');
            window.location = 'login.html';  
        </script>
    ";
}

?>
