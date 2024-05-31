<?php
require 'db.php';

$id = $_POST['alumnoId'];
$ci = $_POST['ci'];
$matricula = $_POST['matricula'];
$dob = $_POST['dob'];
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$observaciones = $_POST['observaciones'];

$sql = 'UPDATE alumnos SET ci = ?, matricula = ?, dob = ?, nombre = ?, edad = ?, observaciones = ? WHERE id = ?';
$stmt = $pdo->prepare($sql);
if ($stmt->execute([$ci, $matricula, $dob, $nombre, $edad, $observaciones, $id])) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
