// Script actual para manejar el envío del formulario
const usuarioForm = document.getElementById('usuarioForm');
usuarioForm.addEventListener('submit', (event) => {
    event.preventDefault();
    agregarUsuario(event);
});

async function agregarUsuario(event) {
    const cedula = document.getElementById('cedula').value;
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const telefono = document.getElementById('telefono').value;
    const perfil = document.getElementById('perfil').value;

    const formData = new FormData();
    formData.append('cedula', cedula);
    formData.append('firstName', firstName);
    formData.append('lastName', lastName);
    formData.append('email', email);
    formData.append('password', password);
    formData.append('telefono', telefono);
    formData.append('perfil', perfil);

    console.log(formData);
    try {
        const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swUser.php', {
            method: 'POST',
            body: formData
        });
        document.getElementById('usuarioForm').reset(); // Resetear el formulario

    } catch (error) {
        console.error('Error al registrar categoría:', error);
    }
}

// Nueva funcionalidad para agrandar los campos al pasar el mouse
document.addEventListener('DOMContentLoaded', function () {
    const zoomables = document.querySelectorAll('.zoomable');

    zoomables.forEach(function (element) {
        element.addEventListener('mouseenter', function () {
            element.style.transform = 'scale(1.2)';  // Agranda el campo a 1.2 veces su tamaño original
            element.style.transition = 'transform 0.2s';
        });

        element.addEventListener('mouseleave', function () {
            element.style.transform = 'scale(1)';  // Vuelve al tamaño original
            element.style.transition = 'transform 0.2s';
        });
    });

    // Añadir funcionalidad de zoom al botón "Ingresar"
    const submitButton = document.querySelector('button[type="submit"]');

    submitButton.addEventListener('mouseenter', function () {
        submitButton.style.transform = 'scale(1.6)';  // Agranda el botón a 1.2 veces su tamaño original
        submitButton.style.transition = 'transform 0.2s';
    });

    submitButton.addEventListener('mouseleave', function () {
        submitButton.style.transform = 'scale(1)';  // Vuelve al tamaño original
        submitButton.style.transition = 'transform 0.2s';
    });

    // Añadir funcionalidad de zoom al botón "Cambiar Colores"
    const colorToggleBtn = document.getElementById('colorToggleBtn');

    colorToggleBtn.addEventListener('mouseenter', function () {
        colorToggleBtn.style.transform = 'scale(1.2)';  // Agranda el botón a 1.2 veces su tamaño original
        colorToggleBtn.style.transition = 'transform 0.2s';
    });

    colorToggleBtn.addEventListener('mouseleave', function () {
        colorToggleBtn.style.transform = 'scale(1)';  // Vuelve al tamaño original
        colorToggleBtn.style.transition = 'transform 0.2s';
    });

    // Nueva funcionalidad para cambiar los colores
    colorToggleBtn.addEventListener('click', () => {
        const body = document.body;
        const container = document.querySelector('.bg-white'); // Selecciona el contenedor del formulario

        // Verifica si el modo de alto contraste está activado
        if (body.classList.contains('color-inverted')) {
            // Revertir a los colores originales
            body.classList.remove('color-inverted');
            body.style.backgroundColor = '#f7fafc';  // Color original del fondo
            body.style.color = '#2d3748';  // Color original del texto
            container.style.backgroundColor = '#ffffff';  // Fondo original del contenedor
            container.style.borderColor = '#e2e8f0';  // Borde original del contenedor
            document.querySelectorAll('input, select, button').forEach(el => {
                el.style.backgroundColor = '';  // Revertir color de fondo original de los campos
                el.style.color = '';  // Revertir color de texto original de los campos
                el.style.borderColor = '';  // Revertir color de borde original de los campos
            });

            // Restaurar el color de texto original en el contenedor
            container.querySelectorAll('label, h1').forEach(el => {
                el.style.color = '#2d3748';  // Color de texto original en el contenedor
            });

            // Revertir el color del botón "Ingresar"
            submitButton.style.backgroundColor = '#007bff';  // Azul accesible original
            submitButton.style.color = '#ffffff';  // Texto blanco

            // Revertir el color del botón "Cambiar Colores"
            colorToggleBtn.style.backgroundColor = '#ff0000';  // Rojo brillante
            colorToggleBtn.style.color = '#ffffff';  // Texto blanco
        } else {
            // Cambiar a colores accesibles
            body.classList.add('color-inverted');
            body.style.backgroundColor = '#007bff';  // Fondo azul saturado
            body.style.color = '#ffffff';  // Texto blanco fuerte
            container.style.backgroundColor = '#000000';  // Fondo negro saturado para el contenedor
            container.style.borderColor = '#000000';  // Borde negro para el contenedor

            // Cambiar el color de los textos y campos
            document.querySelectorAll('input, select, button').forEach(el => {
                el.style.backgroundColor = '#003d79';  // Azul aún más oscuro para los campos
                el.style.color = '#ffffff';  // Texto blanco fuerte
                el.style.borderColor = '#002c5e';  // Borde azul muy oscuro
            });

            // Cambiar el color del texto en el contenedor
            container.querySelectorAll('label, h1').forEach(el => {
                el.style.color = '#ffffff';  // Texto blanco fuerte
            });

            // Cambiar el color del botón "Ingresar"
            submitButton.style.backgroundColor = '#ff0000';  // Rojo brillante accesible
            submitButton.style.color = '#ffffff';  // Texto blanco

            // Cambiar el color del botón "Cambiar Colores"
            colorToggleBtn.style.backgroundColor = '#ff0000';  // Rojo brillante
            colorToggleBtn.style.color = '#ffffff';  // Texto blanco
        }
    });
});
