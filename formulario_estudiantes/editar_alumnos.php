<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "universidad");

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del alumno
$id = $_GET['id'];

// Obtener los datos actuales del alumno
$sql = "SELECT ci, matricula, dob, nombre, genero, carrera, edad, observaciones FROM alumnos WHERE id = $id";
$result = $conn->query($sql);
$alumno = $result->fetch_assoc();

// Si el formulario ha sido enviado, actualizar los datos del alumno
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ci = $_POST['ci'];
    $matricula = $_POST['matricula'];
    $dob = $_POST['dob'];
    $nombre = $_POST['nombre'];
    $genero = $_POST['genero'];
    $carrera = $_POST['carrera'];
    $edad = $_POST['edad'];
    $observaciones = $_POST['observaciones'];

    $sql = "UPDATE alumnos SET ci = '$ci', matricula = '$matricula', dob = '$dob', nombre = '$nombre', genero = '$genero', carrera = '$carrera', edad = '$edad', observaciones = '$observaciones' WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado correctamente";
        header("Location: lista_alumnos.php"); // Redireccionar a la lista de alumnos
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno</title>
    <!-- Agregar Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mt-5">Editar Alumno</h2>
        <form method="POST">
            <div class="form-group">
                <label for="ci">CI</label>
                <input type="text" class="form-control" id="ci" name="ci" value="<?php echo $alumno['ci']; ?>" required>
            </div>
            <div class="form-group">
                <label for="matricula">Matrícula</label>
                <input type="text" class="form-control" id="matricula" name="matricula" value="<?php echo $alumno['matricula']; ?>" required>
            </div>
            <div class="form-group">
                <label for="dob">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $alumno['dob']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $alumno['nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="genero">Género</label>
                <input type="text" class="form-control" id="genero" name="genero" value="<?php echo $alumno['genero']; ?>" required>
            </div>
            <div class="form-group">
                <label for="carrera">Carrera</label>
                <input type="text" class="form-control" id="carrera" name="carrera" value="<?php echo $alumno['carrera']; ?>" required>
            </div>
            <div class="form-group">
                <label for="edad">Edad</label>
                <input type="number" class="form-control" id="edad" name="edad" value="<?php echo $alumno['edad']; ?>" required>
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="observaciones" required><?php echo $alumno['observaciones']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
