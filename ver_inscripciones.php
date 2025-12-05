<?php
// ===============================================
// CONFIGURACIÓN DE LA CONEXIÓN A LA BASE DE DATOS
// ===============================================
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "talleres_ut";

// Conexión
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// ===============================================
// CONSULTA DE LAS INSCRIPCIONES
// ===============================================
$sql = "SELECT 
            id,
            nombre,
            matricula,
            curp,
            cuatrimestre,
            grupo,
            turno,
            correo,
            tel_cel,
            taller,
            fecha_inscripcion
        FROM inscripciones";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Inscripciones</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; }
        table { width: 95%; margin: auto; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background: #004aad; color: white; }
        h2 { text-align: center; color: #004aad; }
        .container { margin: 20px auto; width: 90%; text-align: center; }
        a { text-decoration: none; background: #004aad; color: white; padding: 10px 20px; border-radius: 5px; }
    </style>
</head>
<body>

<h2>Listado de alumnos inscritos</h2>

<div class="container">
    <a href="inscripcion.html">Registrar nuevo alumno</a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Matrícula</th>
        <th>CURP</th>
        <th>Cuatrimestre</th>
        <th>Grupo</th>
        <th>Turno</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Taller</th>
        <th>Fecha de inscripción</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nombre']}</td>
                    <td>{$row['matricula']}</td>
                    <td>{$row['curp']}</td>
                    <td>{$row['cuatrimestre']}</td>
                    <td>{$row['grupo']}</td>
                    <td>{$row['turno']}</td>
                    <td>{$row['correo']}</td>
                    <td>{$row['tel_cel']}</td>
                    <td>{$row['taller']}</td>
                    <td>{$row['fecha_inscripcion']}</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='11'>No hay inscripciones registradas</td></tr>";
    }

    $conn->close();
    ?>
</table>
<div style="text-align:center; margin:20px;">
    <a href="generar_pdf.php" 
       style="background:#28a745; padding:10px 20px; color:white; border-radius:5px; text-decoration:none;">
       📄 Descargar PDF
    </a>
</div>

</body>
</html>
