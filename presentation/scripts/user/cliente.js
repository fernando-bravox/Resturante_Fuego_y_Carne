document.addEventListener('DOMContentLoaded', function () {
    const zoomables = document.querySelectorAll('.shadow, .border, .input-field, label, h1, p, button, h2');

    zoomables.forEach(function (element) {
        element.addEventListener('mouseenter', function () {
            element.style.transform = 'scale(1.2)';  // Agranda el elemento a 1.2 veces su tamaño original
            element.style.transition = 'transform 0.2s';
        });

        element.addEventListener('mouseleave', function () {
            element.style.transform = 'scale(1)';  // Vuelve al tamaño original
            element.style.transition = 'transform 0.2s';
        });
    });

    // Nueva funcionalidad para cambiar los colores
    const colorToggleBtn = document.getElementById('colorToggleBtn');

    colorToggleBtn.addEventListener('click', () => {
        const body = document.body;
        const formContainer = document.querySelector('.bg-white'); // Selecciona el contenedor del formulario

        // Verifica si el modo de alto contraste está activado
        if (body.classList.contains('color-inverted')) {
            // Revertir a los colores originales
            body.classList.remove('color-inverted');
            body.style.backgroundColor = '#f7fafc';  // Color original del fondo
            body.style.color = '#2d3748';  // Color original del texto
            if (formContainer) {
                formContainer.style.backgroundColor = '#ffffff';  // Fondo original del contenedor
                formContainer.style.borderColor = '#e2e8f0';  // Borde original del contenedor
            }
            document.querySelectorAll('input, select, button').forEach(el => {
                el.style.backgroundColor = '';  // Revertir color de fondo original de los campos
                el.style.color = '';  // Revertir color de texto original de los campos
                el.style.borderColor = '';  // Revertir color de borde original de los campos
            });

            // Restaurar el color de texto original en el contenedor
            if (formContainer) {
                formContainer.querySelectorAll('label, h1').forEach(el => {
                    el.style.color = '#2d3748';  // Color de texto original en el contenedor
                });
            }


            // Revertir el color del botón "Cambiar Colores"
            colorToggleBtn.style.backgroundColor = '#ff0000';  // Azul accesible original
            colorToggleBtn.style.color = '#ffffff';  // Texto blanco
        } else {
            // Cambiar a colores accesibles
            body.classList.add('color-inverted');
            body.style.backgroundColor = '#000000';  // Fondo negro para alto contraste
            body.style.color = '#000000';  // Texto blanco para alto contraste
            if (formContainer) {
                formContainer.style.borderColor = '#555555';  // Borde gris más claro para el contenedor
            }
            document.querySelectorAll('input, select, button').forEach(el => {
                el.style.backgroundColor = '#003d79';  // Fondo gris oscuro para los campos
                el.style.color = '#ffffff';  // Texto blanco para los campos
                el.style.borderColor = '#777777';  // Borde gris claro para los campos
            });

            // Cambiar color de texto en el contenedor
            if (formContainer) {
                formContainer.querySelectorAll('label, h1').forEach(el => {
                    el.style.color = '#ffffff';  // Texto blanco en el contenedor
                });
            }



            // Cambiar el color del botón "Cambiar Colores"
            colorToggleBtn.style.backgroundColor = '#ff0000';  // Naranja brillante para el botón de cambiar colores
            colorToggleBtn.style.color = '#ffffff';  // Texto blanco
        }
    });
});