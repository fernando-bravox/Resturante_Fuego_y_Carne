function confirmDeletion() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esta acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteUser();
        }
    });
}

async function deleteUser() {
    const userId = document.querySelector('[data-user-id]').getAttribute('data-user-id');

    try {
        const response = await fetch(`http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swUser.php?id=${userId}`, {
            method: 'DELETE'
        });
        
        const data = await response.json();
        console.log(data);
        
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Eliminado',
                text: 'La cuenta ha sido eliminada correctamente.',
            }).then(() => {
                window.location.href = 'login.php';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al eliminar la cuenta.',
            });
        }
    } catch (error) {
        console.error('Error al eliminar la cuenta:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al intentar eliminar la cuenta. Por favor, intente de nuevo más tarde.',
        });
    }
}
