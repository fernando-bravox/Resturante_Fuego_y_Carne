document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('mostrar-reservas').addEventListener('click', toggleReservas);
});

async function toggleReservas() {
    const reservasModal = document.getElementById('reservas-modal');
    reservasModal.style.display = reservasModal.style.display === 'none' ? 'flex' : 'none';

    if (reservasModal.style.display === 'flex') {
        await cargarReservas();
    }
}

async function cargarReservas() {
    try {
        const response = await fetch(`http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swReservas.php?usuario_id=${userId}`);
        const reservas = await response.json();
        const reservasGrid = document.getElementById('reservas-grid');
        reservasGrid.innerHTML = '';

        reservas.forEach(reserva => {
            const productos = JSON.parse(reserva.productos);
            let productosHTML = '';
            productos.forEach(producto => {
                productosHTML += `
                    <div class="flex justify-between">
                        <span>${producto.nombre} x${producto.cantidad}</span>
                        <span>$${(producto.precio * producto.cantidad).toFixed(2)}</span>
                    </div>
                `;
            });

            const total = parseFloat(reserva.total);

            const reservaDiv = document.createElement('div');
            reservaDiv.classList.add('bg-gray-100', 'p-6', 'rounded-lg', 'shadow-md');
            reservaDiv.innerHTML = `
                <h3 class="text-2xl font-bold mb-4">Reserva #${reserva.id}</h3>
                <div class="mb-4">${productosHTML}</div>
                <div class="flex justify-between mb-4">
                    <span class="font-bold">Total a pagar:</span>
                    <span class="font-bold">$${total.toFixed(2)}</span>
                </div>
                ${reserva.comprobante ? `<img src="../../../businessLogic/${reserva.comprobante}" alt="Comprobante de Pago" class="mb-4 w-full rounded-lg">` : ''}
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="mostrarSubirComprobante(${reserva.id})">Subir Comprobante</button>
            `;
            reservasGrid.appendChild(reservaDiv);
        });
    } catch (error) {
        console.error('Error al cargar reservas:', error);
    }
}

function mostrarSubirComprobante(reservaId) {
    const modalHTML = `
        <div id="comprobante-modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h3 class="text-2xl font-bold mb-4">Subir Comprobante de Pago</h3>
                <p class="mb-4">Banco Pichincha</p>
                <p class="mb-4">Cuenta de ahorro transaccional</p>
                <p class="mb-4">Número: 2209380812</p>
                <form id="comprobante-form">
                    <input type="hidden" name="reserva_id" value="${reservaId}">
                    <input type="file" name="comprobante" class="mb-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Subir</button>
                    <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-4" onclick="cerrarComprobanteModal()">Cancelar</button>
                </form>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', modalHTML);

    document.getElementById('comprobante-form').addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        try {
            const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swSubirComprobante.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                alert('Comprobante subido exitosamente');
                cerrarComprobanteModal();
                await cargarReservas(); // Recargar reservas para mostrar el comprobante subido
            } else {
                alert('Error al subir el comprobante: ' + result.message);
            }
        } catch (error) {
            console.error('Error al subir el comprobante:', error);
            alert('Error al subir el comprobante');
        }
    });
}

function cerrarModal() {
    const reservasModal = document.getElementById('reservas-modal');
    reservasModal.style.display = 'none';
}

function cerrarComprobanteModal() {
    const comprobanteModal = document.getElementById('comprobante-modal');
    if (comprobanteModal) {
        comprobanteModal.remove();
    }
}
