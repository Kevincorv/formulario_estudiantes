<?php
require 'conexion.php';

if(isset($_POST['id'])){
    $alumnoId = $_POST['id'];
    try {
        // Realizar la eliminación del alumno en la base de datos
        $sql = 'DELETE FROM alumnos WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$alumnoId]);

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'ID de alumno no especificado.']);
}
?>
<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "universidad");

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del alumno a eliminar
$id = $_POST['id'];

// Consulta SQL para eliminar el alumno
$sql = "DELETE FROM alumnos WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Alumno eliminado correctamente";
} else {
    echo "Error al eliminar el alumno: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>

