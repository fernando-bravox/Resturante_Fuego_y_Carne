// js/eliminar_producto.js

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.eliminar-producto').forEach(function(button) {
        button.addEventListener('click', function() {
            const productoId = this.getAttribute('data-id');
            eliminarProducto(productoId);
        });
    });
});

function eliminarProducto(productoId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`php/eliminar_producto.php?id=${productoId}`, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire(
                        'Eliminado!',
                        'El producto ha sido eliminado.',
                        'success'
                    ).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire(
                        'Error!',
                        'No se pudo eliminar el producto.',
                        'error'
                    );
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire(
                    'Error!',
                    'Ocurrió un error al eliminar el producto.',
                    'error'
                );
            });
        }
    });
}
