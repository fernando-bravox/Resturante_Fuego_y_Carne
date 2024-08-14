// Función para mostrar u ocultar el formulario de actualización
function toggleForm(id) {
    var formId = 'form-' + id; // ID del formulario específico
    var form = document.getElementById(formId); // Obtener el formulario

    // Mostrar u ocultar el formulario
    if (form.style.display === 'none') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
}

// Función para validar el formulario de actualización antes de enviarlo
function validarFormulario(id) {
    var formId = 'form-' + id; // ID del formulario específico
    var form = document.getElementById(formId); // Obtener el formulario
    var nombre = form.nombre.value.trim(); // Obtener el valor del nombre y eliminar espacios en blanco al inicio y final

    // Validar nombre: no debe estar vacío y no debe contener números
    if (nombre === "") {
        alert("Por favor, ingrese un nombre para la categoría.");
        return false;
    } else if (/^\d+$/.test(nombre)) {
        alert("El nombre de la categoría no puede contener solo números.");
        return false;
    }

    // Puedes agregar más validaciones aquí según sea necesario

    return true; // Permitir el envío del formulario si pasa todas las validaciones
}

// Función para enviar el formulario usando AJAX
function enviarFormulario(id) {
    var formId = 'form-' + id;
    var form = document.getElementById(formId);
    var formData = new FormData(form);

    // Enviar datos del formulario usando Fetch API
    fetch('actualizar_categoria.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));

    return false; // Evitar el envío del formulario de manera tradicional
}
