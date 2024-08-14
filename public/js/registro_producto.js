function validarFormulario() {
    var nombre = document.getElementById("nombre").value.trim();
    var descripcion = document.getElementById("descripcion").value.trim();
    var precio = document.getElementById("precio").value.trim();
    var imagen = document.getElementById("imagen").value.trim();
    var categoria_id = document.getElementById("categoria_id").value.trim();

    if (nombre === "" || descripcion === "" || precio === "" || imagen === "" || categoria_id === "") {
        mostrarMensaje("Todos los campos son obligatorios.");
        return false;
    }

    // Crear FormData para enviar los datos del formulario
    var formData = new FormData();
    formData.append("nombre", nombre);
    formData.append("descripcion", descripcion);
    formData.append("precio", precio);
    formData.append("imagen", document.getElementById("imagen").files[0]);
    formData.append("categoria_id", categoria_id);

    // Crear instancia de XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Configurar la solicitud
    xhr.open("POST", "guardar_producto.php", true);

    // Configurar la carga del evento
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById("registroForm").reset(); // Limpiar el formulario
            mostrarMensaje(xhr.responseText); // Mostrar mensaje del servidor
        } else {
            mostrarMensaje("Error en la solicitud.");
        }
    };

    // Enviar la solicitud
    xhr.send(formData);

    return false; // Evitar el envío normal del formulario
}

function mostrarMensaje(mensaje) {
    document.getElementById("mensaje").innerHTML = "<p class='text-center mt-4'>" + mensaje + "</p>";
}
