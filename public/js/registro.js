document.addEventListener('DOMContentLoaded', function() {
    // Obtener el mensaje de estado de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const error = urlParams.get('error');

    if (status) {
        showAlert(decodeURIComponent(status));
    }

    if (error) {
        showAlert(decodeURIComponent(error));
    }
});
function validateInput(input) {
    // Función de validación que ya existe
}

document.addEventListener('DOMContentLoaded', function() {
    const perfilSelect = document.getElementById('perfil');
    const codigoRegistroDiv = document.getElementById('codigoRegistro');

    perfilSelect.addEventListener('change', function() {
        if (perfilSelect.value === 'Administrador') {
            codigoRegistroDiv.style.display = 'block';
        } else {
            codigoRegistroDiv.style.display = 'none';
        }
    });
});
