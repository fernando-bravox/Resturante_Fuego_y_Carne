window.addEventListener('message', (event) => {
    const producto = event.data;
    document.getElementById('id').value = producto.id;
    document.getElementById('nombre_producto').value = producto.nombre_producto;
    document.getElementById('descripcion_producto').value = producto.descripcion_producto;
    document.getElementById('precio_producto').value = producto.precio_producto;
    document.getElementById('imagen_producto').value = producto.imagen_producto;
    document.getElementById('categoria_id').value = producto.categoria_id;

  });
  
  async function actualizarProducto(event) {
    event.preventDefault();
    
    const id = document.getElementById('id').value;
    const nombre_producto = document.getElementById('nombre_producto').value;
    const descripcion_producto = document.getElementById('descripcion_producto').value;
    const precio_producto = document.getElementById('precio_producto').value;
    const imagen_producto = document.getElementById('imagen_producto').value;
    const categoria_id = document.getElementById('categoria_id').value;


    const producto = {
        id: id,
        nombre_producto: nombre_producto,
        descripcion_producto: descripcion_producto,
        precio_producto: precio_producto,
        imagen_producto: imagen_producto,
        categoria_id:categoria_id
    };

    console.log(producto)
  
    try {
        const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swProductos.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(producto)
        });
        window.close();
        
    } catch (error) {
        console.error('Error al actualizar usuario:', error);
    }
}
  //Para que detecte la id de la categoria
document.addEventListener("DOMContentLoaded", function() {
    fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swCategoria.php')
        .then(response => response.json())
        .then(data => {
            const categoriaSelect = document.getElementById('categoria_id');
            data.forEach(categoria => {
                const option = document.createElement('option');
                option.value = categoria.id;
                option.textContent = categoria.nombre_categoria;
                categoriaSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar categorías:', error));

   
});
  document.getElementById('actualizarProductoForm').addEventListener('submit', actualizarProducto);