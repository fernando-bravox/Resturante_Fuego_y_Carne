document.addEventListener('DOMContentLoaded', function () {
    // Selecciona todos los contenedores y el botón de eliminación
    const zoomableContainers = document.querySelectorAll('.bg-gray-50, .bg-gray-200, .bg-blue-500, .text-lg, .text-2xl');
    const deleteButton = document.querySelector('button.bg-red-700');
    const colorToggleBtn = document.getElementById('colorToggleBtn');
    const profileContainer = document.querySelector('.bg-white'); // Contenedor de la información
    const profileHeader = document.querySelector('h2.text-2xl'); // Encabezado "Perfil del Cliente"

    // Guarda los colores originales para revertir
    const originalColors = {
        bodyBackgroundColor: '#ffffff',
        profileContainerBackgroundColor: '#ffffff',
        profileContainerBorderColor: '#e2e8f0',
        profileTextColor: '#1a202c',
        profileHeaderTextColor: '#ffffff', // Color original del encabezado
        deleteButtonTextColor: '#ffffff',
        fieldBackgroundColor: '#e2e8f0',
        fieldTextColor: '#1a202c'
    };

    // Función para aplicar el efecto de zoom
    function applyZoomEffect(element) {
        element.style.transition = 'transform 0.2s';
        element.style.transformOrigin = 'center center'; // Escalar desde el centro
    }

    // Añadir el efecto de zoom a los contenedores
    zoomableContainers.forEach(function (element) {
        applyZoomEffect(element);

        element.addEventListener('mouseenter', function () {
            element.style.transform = 'scale(1.1)';  // Agranda el elemento a 1.1 veces su tamaño original
        });

        element.addEventListener('mouseleave', function () {
            element.style.transform = 'scale(1)';  // Vuelve al tamaño original
        });
    });

    // Añadir el efecto de zoom al botón "Eliminar Cuenta"
    applyZoomEffect(deleteButton);

    deleteButton.addEventListener('mouseenter', function () {
        deleteButton.style.transform = 'scale(1.4)';  // Agranda el botón a 1.4 veces su tamaño original
    });

    deleteButton.addEventListener('mouseleave', function () {
        deleteButton.style.transform = 'scale(1)';  // Vuelve al tamaño original
    });

    // Añadir el efecto de zoom al botón de cambiar colores
    applyZoomEffect(colorToggleBtn);

    colorToggleBtn.addEventListener('mouseenter', function () {
        colorToggleBtn.style.transform = 'scale(1.1)';  // Agranda el botón a 1.1 veces su tamaño original
    });

    colorToggleBtn.addEventListener('mouseleave', function () {
        colorToggleBtn.style.transform = 'scale(1)';  // Vuelve al tamaño original
    });

    // Añadir funcionalidad de cambio de colores al botón de cambiar colores
    colorToggleBtn.addEventListener('click', () => {
        const body = document.body;

        // Verifica si el modo de alto contraste está activado
        if (body.classList.contains('color-inverted')) {
            // Revertir a los colores originales
            body.classList.remove('color-inverted');
            body.style.backgroundImage = 'url("../../styles/img/fondo.jpg")'; // Restaurar imagen de fondo
            body.style.backgroundColor = originalColors.bodyBackgroundColor; // Restaurar color de fondo

            profileContainer.style.backgroundColor = originalColors.profileContainerBackgroundColor; // Fondo original del contenedor
            profileContainer.style.borderColor = originalColors.profileContainerBorderColor; // Borde original del contenedor

            // Restaurar el color de texto original en el perfil
            profileContainer.querySelectorAll('.text-lg, .text-2xl').forEach(el => {
                el.style.color = originalColors.profileTextColor; // Color de texto original
            });

            // Restaurar el color del encabezado
            if (profileHeader) {
                profileHeader.style.color = originalColors.profileHeaderTextColor;
            }

            // Restaurar el color del botón "Eliminar Cuenta"
            deleteButton.style.backgroundColor = originalColors.deleteButtonBackgroundColor; // Rojo original
            deleteButton.style.color = originalColors.deleteButtonTextColor; // Texto blanco

            // Restaurar el color de los campos
            document.querySelectorAll('.bg-blue-500').forEach(el => {
                el.style.backgroundColor = originalColors.fieldBackgroundColor; // Color original de fondo de los campos
                el.style.color = originalColors.fieldTextColor; // Texto negro
            });

        } else {
            // Cambiar a colores accesibles
            body.classList.add('color-inverted');
            profileContainer.style.backgroundColor = '#000000'; // Fondo negro saturado
            profileContainer.style.borderColor = '#000000'; // Borde negro

            // Cambiar el color de texto en el perfil
            profileContainer.querySelectorAll('.text-lg, .text-2xl').forEach(el => {
                el.style.color = '#000000'; // Texto blanco fuerte
            });

            // Cambiar el color del encabezado
            if (profileHeader) {
                profileHeader.style.color = '#ffffff';
            }

            // Cambiar el color del botón "Eliminar Cuenta"
            deleteButton.style.backgroundColor = '#ff0000'; // Rojo brillante accesible
            deleteButton.style.color = '#ffffff'; // Texto blanco

            // Cambiar el color de los campos
            document.querySelectorAll('.bg-blue-500').forEach(el => {
                el.style.backgroundColor = '#003d79'; // Azul saturado
                el.style.color = '#ffffff'; // Texto blanco
            });
        }
    });
});
