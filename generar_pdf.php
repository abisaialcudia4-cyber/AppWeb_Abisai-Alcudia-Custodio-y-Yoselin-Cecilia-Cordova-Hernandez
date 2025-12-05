<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// CONEXIÓN BD
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "talleres_ut";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Error conexión: " . $conn->connect_error);
}

// CONSULTA
$sql = "SELECT id, nombre, curp, matricula, taller, fecha_inscripcion 
        FROM inscripciones";
$result = $conn->query($sql);

// HTML PDF
$html = "
<h2 style='text-align:center;'>LISTA DE ALUMNOS INSCRITOS</h2>
<table border='1' width='100%' cellspacing='0' cellpadding='5'>
<tr style='background:#004aad; color:white;'>
    <th>ID</th>
    <th>Nombre</th>
    <th>CURP</th>
    <th>Matrícula</th>
    <th>Taller</th>
    <th>Fecha Inscripción</th>
</tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $html .= "
        <tr>
            <td>".$row['id']."</td>
            <td>".$row['nombre']."</td>
            <td>".$row['curp']."</td>
            <td>".$row['matricula']."</td>
            <td>".$row['taller']."</td>
            <td>".$row['fecha_inscripcion']."</td>
        </tr>";
    }
} else {
    $html .= "<tr><td colspan='7'>No hay registros</td></tr>";
}

$html .= "</table>";

$conn->close();

// GENERAR PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// DESCARGAR PDF
$dompdf->stream("lista_inscritos.pdf", ["Attachment" => true]);
?>
