window.addEventListener('message', (event) => {
    const categoria = event.data;
    document.getElementById('id').value = categoria.id;
    document.getElementById('nombre_categoria').value = categoria.nombre_categoria;
    document.getElementById('descripcion_categoria').value = categoria.descripcion_categoria;
    document.getElementById('imagen_categoria').value = categoria.imagen_categoria;
  });
  
  async function actualizarCategoria(event) {
    event.preventDefault();
    
    const id = document.getElementById('id').value;
    const nombre_categoria = document.getElementById('nombre_categoria').value;
    const descripcion_categoria = document.getElementById('descripcion_categoria').value;
    const imagen_categoria = document.getElementById('imagen_categoria').value;

    const categoria = {
        id: id,
        nombre_categoria: nombre_categoria,
        descripcion_categoria: descripcion_categoria,
        imagen_categoria: imagen_categoria
    };

    console.log(categoria)
  
    try {
        const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swCategoria.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(categoria)
        });
        window.close();
        
    } catch (error) {
        console.error('Error al actualizar usuario:', error);
    }
}
  
  document.getElementById('actualizarCategoriaForm').addEventListener('submit', actualizarCategoria);