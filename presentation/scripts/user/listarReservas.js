document.addEventListener('DOMContentLoaded', function () {
    const reservasList = document.getElementById('reservas-list');

    fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swReservasList.php')
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                data.forEach(reserva => {
                    const reservaItem = document.createElement('div');
                    reservaItem.className = 'p-4 rounded-lg shadow-lg bg-gray-50';

                    const productos = JSON.parse(reserva.productos).map(producto => 
                        `<li>${producto.nombre} - Precio: ${producto.precio}, Cantidad: ${producto.cantidad}</li>`
                    ).join('');

                    const reservaInfo = `
                        <p><strong>ID de Reserva:</strong> ${reserva.id}</p>
                        <p><strong>Usuario ID:</strong> ${reserva.usuario_id}</p>
                        <p><strong>Productos:</strong></p>
                        <ul>${productos}</ul>
                        <p><strong>Total:</strong> ${reserva.total}</p>
                        <p><strong>Fecha:</strong> ${reserva.fecha}</p>
                        <p><strong>Comprobante:</strong> ${reserva.comprobante ? `<a href="../../../businessLogic/${reserva.comprobante}" target="_blank">Ver Comprobante</a>` : 'No disponible'}</p>
                    `;

                    reservaItem.innerHTML = reservaInfo;
                    reservasList.appendChild(reservaItem);
                });
            } else {
                const errorMessage = document.createElement('p');
                errorMessage.className = 'text-red-500 text-center';
                errorMessage.textContent = 'No se encontraron reservas.';
                reservasList.appendChild(errorMessage);
            }
        })
        .catch(error => {
            console.error('Error al cargar las reservas:', error);
            const errorMessage = document.createElement('p');
            errorMessage.className = 'text-red-500 text-center';
            errorMessage.textContent = 'No se pudieron cargar las reservas. Por favor, inténtalo de nuevo más tarde.';
            reservasList.appendChild(errorMessage);
        });
});
