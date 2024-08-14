async function eliminarUsuario() {
    const userId = document.querySelector('[data-user-id]').getAttribute('data-user-id');

    try {
        const response = await fetch(`../../businessLogic/swUser.php?id=${userId}`, {
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
