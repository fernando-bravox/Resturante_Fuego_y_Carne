document.addEventListener('DOMContentLoaded', () => {
    cargarProductos();
    document.getElementById('mostrar-carrito').addEventListener('click', toggleCarrito);
    document.getElementById('minimizar-carrito').addEventListener('click', minimizarCarrito);
    document.querySelector('.bg-green-500').addEventListener('click', guardarReserva);
});

let carrito = [];

async function cargarProductos() {
    try {
        const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swProductos.php');
        const productos = await response.json();
        const productosGrid = document.getElementById('productos-grid');
        productosGrid.innerHTML = '';

        productos.forEach(producto => {
            const productoDiv = document.createElement('div');
            productoDiv.classList.add('bg-white', 'text-black', 'p-6', 'rounded-lg', 'shadow-md', 'transition', 'transform', 'hover:scale-105');
            productoDiv.innerHTML = `
                <h3 class="text-2xl font-bold mb-4">${producto.nombre_producto}</h3>
                <p class="mb-4">${producto.descripcion_producto}</p>
                <p class="font-bold mb-4">$${producto.precio_producto}</p>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="agregarAlCarrito(${producto.id}, '${producto.nombre_producto}', ${producto.precio_producto})">Agregar al Carrito</button>
            `;
            productosGrid.appendChild(productoDiv);
        });
    } catch (error) {
        console.error('Error al cargar productos:', error);
    }
}

function agregarAlCarrito(id, nombre, precio) {
    const productoExistente = carrito.find(producto => producto.id === id);
    if (productoExistente) {
        productoExistente.cantidad++;
    } else {
        carrito.push({ id, nombre, precio, cantidad: 1 });
    }
    actualizarCarrito();
}

function actualizarCarrito() {
    const carritoProductos = document.getElementById('carrito-productos');
    carritoProductos.innerHTML = '';

    let total = 0;

    carrito.forEach(producto => {
        const productoDiv = document.createElement('div');
        productoDiv.classList.add('flex', 'justify-between', 'items-center', 'mb-4', 'bg-gray-100', 'p-4', 'rounded-lg', 'space-x-4');
        productoDiv.innerHTML = `
            <span class="w-1/4">${producto.nombre} x${producto.cantidad}</span>
            <div class="w-1/2 flex justify-around space-x-2">
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="modificarCantidad(${producto.id}, 'decrementar')">-</button>
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded" onclick="modificarCantidad(${producto.id}, 'incrementar')">+</button>
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="eliminarDelCarrito(${producto.id})">Eliminar</button>
            </div>
            <span class="w-1/4 text-right">$${(producto.precio * producto.cantidad).toFixed(2)}</span>
        `;
        carritoProductos.appendChild(productoDiv);
        total += producto.precio * producto.cantidad;
    });

    document.getElementById('carrito-total').textContent = `$${total.toFixed(2)}`;
}

function modificarCantidad(id, accion) {
    const producto = carrito.find(producto => producto.id === id);
    if (producto) {
        if (accion === 'incrementar') {
            producto.cantidad++;
        } else if (accion === 'decrementar') {
            producto.cantidad--;
            if (producto.cantidad === 0) {
                carrito = carrito.filter(producto => producto.id !== id);
            }
        }
    }
    actualizarCarrito();
}

function eliminarDelCarrito(id) {
    carrito = carrito.filter(producto => producto.id !== id);
    actualizarCarrito();
}

function toggleCarrito() {
    const carritoDiv = document.getElementById('carrito');
    carritoDiv.style.display = carritoDiv.style.display === 'none' ? 'block' : 'none';
}

function minimizarCarrito() {
    const carritoDiv = document.getElementById('carrito');
    carritoDiv.style.display = 'none';
}

async function guardarReserva() {
    const usuario_id = userId;  // Utilizamos el ID del usuario pasado desde PHP
    const total = parseFloat(document.getElementById('carrito-total').textContent.replace('$', ''));

    const data = {
        usuario_id,
        productos: carrito,
        total
    };

    try {
        const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swReservas.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        if (result.success) {
            alert('Reserva guardada exitosamente');
            carrito = [];
            actualizarCarrito();
        } else {
            alert('Error al guardar la reserva: ' + result.message);
            console.error('Error:', result.message);
        }
    } catch (error) {
        console.error('Error al guardar la reserva:', error);
        alert('Error al guardar la reserva');
    }
}
