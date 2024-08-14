document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggle-form-button');
    const formContainer = document.getElementById('form-container');

    toggleButton.addEventListener('click', function() {
        if (formContainer.style.display === 'none' || formContainer.style.display === '') {
            formContainer.style.display = 'block';
        } else {
            formContainer.style.display = 'none';
        }
    });

    // Asegurarse de que el formulario esté oculto al cargar la página
    formContainer.style.display = 'none';
});