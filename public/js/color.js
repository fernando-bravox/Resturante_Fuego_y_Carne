// color.js

// Función para alternar la paleta de colores para usuarios con daltonismo
function toggleDaltonismMode() {
    document.body.classList.toggle('daltonism-mode');
}

// Event listener para el botón de alternar modo daltonismo
document.addEventListener('DOMContentLoaded', function() {
    const daltonismButton = document.getElementById('daltonismButton');
    if (daltonismButton) {
        daltonismButton.addEventListener('click', toggleDaltonismMode);
    }
});
