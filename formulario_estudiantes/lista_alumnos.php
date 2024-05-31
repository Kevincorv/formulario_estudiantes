<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alumnos</title>
    <!-- Agregar Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema de Alumnos</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Registrar Alumno</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="lista_alumnos.php">Lista de Alumnos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mt-5">Lista de Estudiantes</h2>
        <div class="table-responsive">
            <table id="tablaAlumnos" class="table table-striped mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>CI</th>
                        <th>Matrícula</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Nombre Completo</th>
                        <th>Género</th>
                        <th>Carrera</th>
                        <th>Edad</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Conexión a la base de datos
                    $conn = new mysqli("localhost", "root", "", "universidad");

                    // Verificar la conexión
                    if ($conn->connect_error) {
                        die("Error de conexión: " . $conn->connect_error);
                    }

                    // Consulta SQL para obtener los datos de los alumnos
                    $sql = "SELECT id, ci, matricula, dob, nombre, genero, carrera, edad, observaciones FROM alumnos";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Mostrar los datos de cada fila
                        while ($alumno = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $alumno['ci'] . "</td>";
                            echo "<td>" . $alumno['matricula'] . "</td>";
                            echo "<td>" . $alumno['dob'] . "</td>";
                            echo "<td>" . $alumno['nombre'] . "</td>";
                            echo "<td>" . $alumno['genero'] . "</td>";
                            echo "<td>" . $alumno['carrera'] . "</td>";
                            echo "<td>" . $alumno['edad'] . "</td>";
                            echo "<td>" . $alumno['observaciones'] . "</td>";
                            echo "<td>
                                    <a href='editar_alumno.php?id=" . $alumno['id'] . "' class='btn btn-sm btn-primary'>Editar</a>
                                    <button class='btn btn-sm btn-danger btn-eliminar' data-id='" . $alumno['id'] . "'>Eliminar</button>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>No hay alumnos registrados</td></tr>";
                    }

                    // Cerrar la conexión
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-eliminar').click(function() {
                var id = $(this).data('id');
                if (confirm('¿Estás seguro de que deseas eliminar este alumno?')) {
                    $.ajax({
                        url: 'eliminar_alumno.php',
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            alert(response);
                            location.reload(); // Recargar la página para ver los cambios
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
