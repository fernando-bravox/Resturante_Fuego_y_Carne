const categoriaForm = document.getElementById('categoriaForm');
categoriaForm.addEventListener('submit', (event) => {
    event.preventDefault();
    agregarCategoria(event);
});

async function agregarCategoria(event) {
    const nombre_categoria = document.getElementById('nombre_categoria').value;
    const descripcion_categoria = document.getElementById('descripcion_categoria').value;
    const imagen_categoria = document.getElementById('imagen_categoria');

    if (!nombre_categoria || !descripcion_categoria || !imagen_categoria.value) {
        mostrarAlertaError('Todos los campos deben ser llenados correctamente.');
        return;
    }

    const file = imagen_categoria.files[0];

    const formData = new FormData();
    formData.append('nombre_categoria', nombre_categoria);
    formData.append('descripcion_categoria', descripcion_categoria);
    formData.append('imagen_categoria', file);

    try {
        const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swCategoria.php', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            mostrarAlertaExito(); // Llamada a la función de SweetAlert
            document.getElementById('categoriaForm').reset(); // Resetear el formulario

            setTimeout(() => {
                location.reload(); // Recargar la página después de un pequeño retraso
            }, 2000);
        } else {
            mostrarAlertaError('Error en la respuesta del servidor');
        }
    } catch (error) {
        mostrarAlertaError('Error al registrar categoría: ' + error.message);
    }
}

function mostrarAlertaExito() {
    Swal.fire({
        icon: 'success',
        title: 'Categoría agregada correctamente',
        confirmButtonText: 'OK',
        confirmButtonColor: '#3085d6'
    });
}

function mostrarAlertaError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: mensaje,
        confirmButtonText: 'OK',
        confirmButtonColor: '#3085d6'
    });
}
