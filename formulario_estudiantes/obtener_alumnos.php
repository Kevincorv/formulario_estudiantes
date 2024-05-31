<?php
require 'db.php';

function calcularEdad($dob) {
    $dob = new DateTime($dob);
    $now = new DateTime();
    $age = $now->diff($dob)->y;
    return $age;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = 'SELECT * FROM alumnos WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $alumno = $stmt->fetch(PDO::FETCH_ASSOC);
    $alumno['edad'] = calcularEdad($alumno['dob']);
    echo json_encode($alumno);
} else {
    $sql = 'SELECT *, TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS edad FROM alumnos';
    $stmt = $pdo->query($sql);
    $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($alumnos as &$alumno) {
        $alumno['edad'] = calcularEdad($alumno['dob']);
    }
    echo json_encode($alumnos);
}
?>
