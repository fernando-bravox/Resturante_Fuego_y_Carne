document.addEventListener('DOMContentLoaded', () => {
    const userId = document.querySelector('[data-user-id]').getAttribute('data-user-id');

    document.getElementById('actualizarUsuarioForm').addEventListener('submit', (event) => actualizarUsuario(event, userId));
});

async function actualizarUsuario(event, id) {
    event.preventDefault();

    const cedula = document.getElementById('cedula-value').innerText;
    const firstName = document.getElementById('firstName-value').innerText;
    const lastName = document.getElementById('lastName-value').innerText;
    const telefono = document.getElementById('telefono-value').innerText;

    const usuario = {
        id: id,
        cedula: cedula,
        firstName: firstName,
        lastName: lastName,
        telefono: telefono
    };

    try {
        const response = await fetch('../../businessLogic/swUser.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(usuario)
        });

        const result = await response.json();
        if (result.success) {
            Swal.fire('Éxito', 'Usuario actualizado correctamente', 'success');
        } else {
            Swal.fire('Error', 'No se pudo actualizar el usuario', 'error');
        }
    } catch (error) {
        console.error('Error al actualizar usuario:', error);
    }
}

async function confirmDeletion() {
    const result = await Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar'
    });

    if (result.isConfirmed) {
        eliminarUsuario();
    }
}

async function eliminarUsuario() {
    const userId = document.querySelector('[data-user-id]').getAttribute('data-user-id');

    try {
        const response = await fetch(`http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swUser.php?id=${userId}`, {
            method: 'DELETE'
        });

        const result = await response.json();
        if (result.success) {
            Swal.fire('Eliminado', 'Usuario eliminado correctamente', 'success').then(() => {
                window.location.href = '../../logout.php';
            });
        } else {
            Swal.fire('Error', 'No se pudo eliminar el usuario', 'error');
        }
    } catch (error) {
        console.error('Error al eliminar el usuario:', error);
    }
}
