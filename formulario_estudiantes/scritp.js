document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.getElementById('formularioAlumno');
    const dob = document.getElementById('dob');
    const edad = document.getElementById('edad');
    const tablaAlumnos = document.getElementById('tablaAlumnos').querySelector('tbody');

    formulario.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(formulario);
        const url = formData.get('alumnoId') ? 'php/actualizar_alumno.php' : 'php/agregar_alumno.php';
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  alert('Alumno guardado correctamente');
                  formulario.reset();
                  cargarAlumnos();
              } else {
                  alert('Error al guardar el alumno');
              }
          });
    });

    dob.addEventListener('input', function() {
        const birthDate = new Date(dob.value);
        const age = new Date().getFullYear() - birthDate.getFullYear();
        edad.value = age >= 18 ? age : 'Edad inválida';
    });

    function cargarAlumnos() {
        fetch('php/obtener_alumnos.php')
            .then(response => response.json())
            .then(data => {
                tablaAlumnos.innerHTML = '';
                data.forEach(alumno => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${alumno.ci}</td>
                        <td>${alumno.matricula}</td>
                        <td>${alumno.dob}</td>
                        <td>${alumno.nombre}</td>
                        <td>${alumno.edad}</td>
                        <td>${alumno.observaciones}</td>
                        <td>
                            <button class="btn btn-warning" onclick="editarAlumno(${alumno.id})">Editar</button>
                        </td>
                    `;
                    tablaAlumnos.appendChild(row);
                });
            });
    }

    window.editarAlumno = function(id) {
        fetch(`php/obtener_alumnos.php?id=${id}`)
            .then(response => response.json())
            .then(alumno => {
                document.getElementById('alumnoId').value = alumno.id;
                document.getElementById('ci').value = alumno.ci;
                document.getElementById('matricula').value = alumno.matricula;
                document.getElementById('dob').value = alumno.dob;
                document.getElementById('nombre').value = alumno.nombre;
                document.getElementById('edad').value = alumno.edad;
                document.getElementById('observaciones').value = alumno.observaciones;
            });
    };

    cargarAlumnos();
});
