document.getElementById('loginForm').addEventListener('submit', async (event) => {
    event.preventDefault();
    await loginUser();
});

async function loginUser() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (!email || !password) {
        Swal.fire({
            icon: 'warning',
            title: 'Campos incompletos',
            text: 'Por favor, complete todos los campos.',
        });
        return;
    }

    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);

    try {
        const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swLogin.php', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();
        
        if (data.success) {
            const perfil = data.user.perfil;
            Swal.fire({
                icon: 'success',
                title: 'Login exitoso',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                if (perfil === 'administrador') {
                    window.location.href = '../../../presentation/pages/administrador/OptionsList.php';
                } else if (perfil === 'cliente') {
                    window.location.href = '../../../presentation/pages/user/cliente.php';
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Credenciales incorrectas',
                text: 'El email o la contraseña son incorrectos.',
            });
        }
    } catch (error) {
        console.error('Error al iniciar sesión:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al intentar iniciar sesión. Por favor, intente de nuevo más tarde.',
        });
    }
}

// Nueva funcionalidad para agrandar los campos al pasar el mouse
document.addEventListener('DOMContentLoaded', function () {
    const zoomables = document.querySelectorAll('.shadow, .border, .input-field, label, h1');

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

    // Añadir funcionalidad de zoom al botón "Login"
    const loginButton = document.querySelector('button[type="submit"]');

    loginButton.addEventListener('mouseenter', function () {
        loginButton.style.transform = 'scale(1.2)';  // Agranda el botón a 1.2 veces su tamaño original
        loginButton.style.transition = 'transform 0.2s';
    });

    loginButton.addEventListener('mouseleave', function () {
        loginButton.style.transform = 'scale(1)';  // Vuelve al tamaño original
        loginButton.style.transition = 'transform 0.2s';
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
        const formContainer = document.querySelector('.bg-white'); // Selecciona el contenedor del formulario

        // Verifica si el modo de alto contraste está activado
        if (body.classList.contains('color-inverted')) {
            // Revertir a los colores originales
            body.classList.remove('color-inverted');
            body.style.backgroundColor = '#f7fafc';  // Color original del fondo
            body.style.color = '#2d3748';  // Color original del texto
            formContainer.style.backgroundColor = '#ffffff';  // Fondo original del contenedor
            formContainer.style.borderColor = '#e2e8f0';  // Borde original del contenedor
            document.querySelectorAll('input, select, button').forEach(el => {
                el.style.backgroundColor = '';  // Revertir color de fondo original de los campos
                el.style.color = '';  // Revertir color de texto original de los campos
                el.style.borderColor = '';  // Revertir color de borde original de los campos
            });

            // Restaurar el color de texto original en el contenedor
            formContainer.querySelectorAll('label, h1').forEach(el => {
                el.style.color = '#2d3748';  // Color de texto original en el contenedor
            });

            // Revertir el color del botón "Login"
            loginButton.style.backgroundColor = '#007bff';  // Azul accesible original
            loginButton.style.color = '#ffffff';  // Texto blanco

            // Revertir el color del botón "Cambiar Colores"
            colorToggleBtn.style.backgroundColor = '#ff0000';  // Rojo brillante
            colorToggleBtn.style.color = '#ffffff';  // Texto blanco
        } else {
            // Cambiar a colores accesibles
            body.classList.add('color-inverted');
            body.style.backgroundColor = '#007bff';  // Fondo azul saturado
            body.style.color = '#ffffff';  // Texto blanco fuerte
            formContainer.style.backgroundColor = '#000000';  // Fondo negro saturado para el contenedor
            formContainer.style.borderColor = '#000000';  // Borde negro para el contenedor

            // Cambiar el color de los textos y campos
            document.querySelectorAll('input, select, button').forEach(el => {
                el.style.backgroundColor = '#003d79';  // Azul aún más oscuro para los campos
                el.style.color = '#ffffff';  // Texto blanco fuerte
                el.style.borderColor = '#002c5e';  // Borde azul muy oscuro
            });

            // Cambiar el color del texto en el contenedor
            formContainer.querySelectorAll('label, h1').forEach(el => {
                el.style.color = '#ffffff';  // Texto blanco fuerte
            });

            // Cambiar el color del botón "Login"
            loginButton.style.backgroundColor = '#ff0000';  // Rojo brillante accesible
            loginButton.style.color = '#ffffff';  // Texto blanco

            // Cambiar el color del botón "Cambiar Colores"
            colorToggleBtn.style.backgroundColor = '#ff0000';  // Rojo brillante
            colorToggleBtn.style.color = '#ffffff';  // Texto blanco
        }
    });
});

















/*
ESTO NO TIENE ALERTAS Y ES MAS CORTO
document.getElementById('loginForm').addEventListener('submit', async (event) => {
    event.preventDefault();
    await loginUser();
});

async function loginUser() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);

    try {
        const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swUser.php', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();
        
        if (data.success) {
            const perfil = data.user.perfil;
            if (perfil === 'administrador') {
                window.location.href = '../../../presentation/pages/administrador/OptionsList.php';
            } else if (perfil === 'cliente') {
                window.location.href = '../../../presentation/pages/categoria/addCategoria.php';
            }
        } else {
            alert('Credenciales incorrectas');
        }
    } catch (error) {
        console.error('Error al iniciar sesión:', error);
    }
}
*/