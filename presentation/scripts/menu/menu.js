document.addEventListener('DOMContentLoaded', function() {
    fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swProductos.php')
        .then(response => response.json())
        .then(data => {
            const productosDiv = document.getElementById('productos');
            data.forEach(producto => {
                const productoDiv = document.createElement('div');
                productoDiv.classList.add('bg-white', 'rounded-lg', 'shadow-md', 'p-6', 'flex', 'flex-col', 'items-center');
                
                productoDiv.innerHTML = `
                    <img src="../../../businessLogic/${producto.imagen_producto}" alt="${producto.nombre_producto}" class="w-32 h-32 object-cover mb-4">
                    <h2 class="text-lg font-bold mb-2">${producto.nombre_producto}</h2>
                    <p class="text-gray-600 mb-4">${producto.descripcion_producto}</p>
                    <p class="text-gray-800 font-bold mb-4">$${producto.precio_producto}</p>
                    <input type="number" id="cantidad_${producto.id}" name="cantidad" min="1" value="1" class="w-full px-3 py-2 border rounded-lg text-gray-700 mb-4">
                    <button onclick="agregarAlCarrito(${producto.id})" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Agregar al Carrito</button>
                `;
                productosDiv.appendChild(productoDiv);
            });
        })
        .catch(error => console.error('Error al cargar productos:', error));
});

function agregarAlCarrito(productoId) {
    const cantidad = document.getElementById(`cantidad_${productoId}`).value;
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const productoEnCarrito = carrito.find(producto => producto.id === productoId);

    if (productoEnCarrito) {
        productoEnCarrito.cantidad += parseInt(cantidad);
    } else {
        carrito.push({ id: productoId, cantidad: parseInt(cantidad) });
    }

    localStorage.setItem('carrito', JSON.stringify(carrito));
    alert('Producto agregado al carrito');
}
