function editField(field, currentValue) {
    Swal.fire({
        title: 'Editar ' + field,
        input: 'text',
        inputLabel: 'Nuevo ' + field,
        inputValue: currentValue,
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar',
        inputValidator: (value) => {
            if (!value) {
                return '¡El campo no puede estar vacío!';
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const newValue = result.value;
            updateField(field, newValue);
        }
    });
}

async function updateField(field, newValue) {
    const userId = document.querySelector('[data-user-id]').getAttribute('data-user-id');
    const usuario = {
        id: userId,
        field: field,
        newValue: newValue
    };

    try {
        const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swUser.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(usuario)
        });
        
        const data = await response.json();
        console.log('Respuesta del servidor:', data);
        
        if (data.success) {
            document.getElementById(`${field}-value`).textContent = newValue;
            Swal.fire({
                icon: 'success',
                title: 'Actualizado',
                text: 'El campo ha sido actualizado correctamente.',
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al actualizar el campo.',
            });
        }
    } catch (error) {
        console.error('Error al actualizar el campo:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al intentar actualizar el campo. Por favor, intente de nuevo más tarde.',
        });
    }
}
