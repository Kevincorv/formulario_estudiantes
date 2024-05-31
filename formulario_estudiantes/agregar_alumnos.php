<?php
require 'conexion.php'; //se incluye el archivo de conexión

$ci = $_POST['ci'];
$matricula = $_POST['matricula'];
$dob = $_POST['dob'];
$nombre = $_POST['nombre'];
$observaciones = $_POST['observaciones'];

// Calculamos la edad a partir de la fecha de nacimiento
$fecha_nacimiento = new DateTime($dob);
$hoy = new DateTime();
$edad = $hoy->diff($fecha_nacimiento)->y;

try {
    // Preparamos y ejecutamos la consulta SQL para insertar un nuevo alumno
    $sql = 'INSERT INTO alumnos (ci, matricula, dob, nombre, edad, observaciones) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ci, $matricula, $dob, $nombre, $edad, $observaciones]);
    
    // Enviamos una respuesta JSON indicando el éxito de la operación
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    // En caso de error, enviamos una respuesta JSON indicando el fallo y el mensaje de error
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
