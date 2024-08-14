document.addEventListener('DOMContentLoaded', function() {
    cargarCarrito();
});

function cargarCarrito() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const carritoDiv = document.getElementById('carrito');
    carritoDiv.innerHTML = '';
    let total = 0;

    carrito.forEach(producto => {
        fetch(`http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swProductos.php?id=${producto.id}`)
            .then(response => response.json())
            .then(data => {
                const productoDiv = document.createElement('div');
                productoDiv.classList.add('flex', 'justify-between', 'items-center', 'mb-4');
                
                productoDiv.innerHTML = `
                    <div class="flex items-center">
                        <img src="../../../businessLogic/${data.imagen_producto}" alt="${data.nombre_producto}" class="w-16 h-16 object-cover mr-4">
                        <div>
                            <h2 class="text-lg font-bold">${data.nombre_producto}</h2>
                            <p class="text-gray-600">Cantidad: ${producto.cantidad}</p>
                            <p class="text-gray-800 font-bold">$${data.precio_producto * producto.cantidad}</p>
                        </div>
                    </div>
                    <button onclick="eliminarDelCarrito(${producto.id})" class="px-4 py-2 bg-red-500 text-white rounded-lg">Eliminar</button>
                `;
                carritoDiv.appendChild(productoDiv);

                total += data.precio_producto * producto.cantidad;
                const totalDiv = document.createElement('div');
                totalDiv.classList.add('text-right', 'mt-4');
                totalDiv.innerHTML = `<p class="text-2xl font-bold">Total: $${total}</p>`;
                carritoDiv.appendChild(totalDiv);
            })
            .catch(error => console.error('Error al cargar producto del carrito:', error));
    });
}

function eliminarDelCarrito(productoId) {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    carrito = carrito.filter(producto => producto.id !== productoId);
    localStorage.setItem('carrito', JSON.stringify(carrito));
    cargarCarrito();
}

function reservar() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    if (carrito.length === 0) {
        alert('El carrito está vacío');
        return;
    }

    const total = carrito.reduce((acc, producto) => acc + (producto.precio * producto.cantidad), 0);
    alert(`Compra realizada. Total: $${total}`);
    localStorage.setItem('totalCompra', total);
    localStorage.removeItem('carrito');
    window.location.href = 'confirmation.php';
}
