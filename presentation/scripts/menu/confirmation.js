document.addEventListener('DOMContentLoaded', function() {
    const total = localStorage.getItem('totalCompra');
    const confirmacionDiv = document.getElementById('confirmacion');

    confirmacionDiv.innerHTML = `
        <h2 class="text-2xl font-bold mb-4">Compra realizada con éxito</h2>
        <p class="text-gray-800 mb-4">Total: $${total}</p>
        <a href="index.php" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Volver al Menú</a>
    `;

    localStorage.removeItem('totalCompra');
});
