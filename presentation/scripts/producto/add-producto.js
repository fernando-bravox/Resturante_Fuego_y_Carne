const productoForm = document.getElementById('productoForm');
productoForm.addEventListener('submit', (event) => {
    event.preventDefault();
    agregarProducto(event);
});
//crea una funcion nueva, no tiene nd que ver con el back
async function agregarProducto(event) {
    const nombre_producto = document.getElementById('nombre_producto').value;
    const descripcion_producto = document.getElementById('descripcion_producto').value;
    const precio_producto = document.getElementById('precio_producto').value;
    const imagen_producto = document.getElementById('imagen_producto');
    const categoria_id = document.getElementById('categoria_id').value;

    const file = imagen_producto.files[0];
    //setear para que funcione
    const formData = new FormData();
    formData.append('nombre_producto', nombre_producto);
    formData.append('descripcion_producto', descripcion_producto);
    formData.append('precio_producto', precio_producto);
    formData.append('imagen_producto', file);
    formData.append('categoria_id', categoria_id);
    console.log(formData);
    //Le ponemos el link y detecta el post y el formData es creado en la funcion reciente
    try {
        const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swProductos.php', {
            method: 'POST',
            body: formData
        });
    } catch (error) {
        console.error('Error al registrar producto:', error);
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