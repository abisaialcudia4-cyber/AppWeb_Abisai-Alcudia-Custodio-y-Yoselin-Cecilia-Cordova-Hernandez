<?php
// ===============================================
// CONFIGURACIÓN DE LA CONEXIÓN A LA BASE DE DATOS
// ===============================================
$host = "localhost";
$user = "root";          // usuario por defecto de XAMPP
$pass = "";    // tu contraseña
$dbname = "talleres_ut";

// Conexión
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// ===============================================
// OBTENER LOS DATOS DEL FORMULARIO
// ===============================================
$nombre          = $_POST['nombre'] ?? '';
$curp            = $_POST['curp'] ?? '';
$matricula       = $_POST['matricula'] ?? '';
$cuatrimestre    = $_POST['cuatrimestre'] ?? '';
$grupo           = $_POST['grupo'] ?? '';
$turno           = $_POST['turno'] ?? '';
$tel_cel         = $_POST['tel_cel'] ?? '';
$tel_casa        = $_POST['tel_casa'] ?? '';
$correo          = $_POST['correo'] ?? '';
$disponibilidad  = $_POST['disponibilidad'] ?? '';
$fecha_ins       = $_POST['fecha_inscripcion'] ?? '';
$enfermedad      = $_POST['enfermedad'] ?? '';
$discapacidad    = $_POST['discapacidad'] ?? '';
$tipo_discap     = $_POST['tipo_discapacidad'] ?? '';
$taller          = $_POST['taller'] ?? '';

// ===============================================
// VALIDACIONES BÁSICAS
// ===============================================
if (
    empty($nombre) || empty($curp) || empty($matricula) || 
    empty($cuatrimestre) || empty($grupo) || empty($turno) ||
    empty($tel_cel) || empty($correo) || empty($disponibilidad) ||
    empty($fecha_ins) || empty($enfermedad) || empty($discapacidad) ||
    empty($taller)
) {
    die("⚠️ Error: Faltan campos obligatorios.");
}

// ===============================================
// PREPARAR INSERCIÓN A LA BD
// ===============================================
$sql = "INSERT INTO inscripciones 
(nombre, curp, matricula, cuatrimestre, grupo, turno, tel_cel, tel_casa, correo, disponibilidad, fecha_inscripcion, enfermedad, discapacidad, tipo_discapacidad, taller)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssssss",
    $nombre, $curp, $matricula, $cuatrimestre, $grupo, $turno,
    $tel_cel, $tel_casa, $correo, $disponibilidad, $fecha_ins,
    $enfermedad, $discapacidad, $tipo_discap, $taller
);

if ($stmt->execute()) {
    header("Location: success.html");
    exit();
} else {
    echo "❌ Error al guardar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
