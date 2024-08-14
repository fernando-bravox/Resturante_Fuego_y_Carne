console.log("hola");
async function getProductos() {
    try {
      const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swProductos.php');
      const data = await response.json();
  
      const productos = data;
  
      const tableBody = document.querySelector('#table-productos tbody');
      tableBody.innerHTML = '';
      let cont=1
  
      productos.forEach(producto => {
       
        // Create table row
        const row = document.createElement('tr');
  
        // Create cells for each producto property
        const id = document.createElement('td');
        id.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
        id.textContent = cont;
        cont++;
  
        const nombre = document.createElement('td');
        nombre.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
        nombre.textContent = producto.nombre_producto;
  
        const descripcion = document.createElement('td');
        descripcion.classList.add('py-3', 'px-6', 'text-left', 'text-wrap');
        descripcion.textContent = producto.descripcion_producto;
  
        const precio = document.createElement('td');
        precio.classList.add('py-3', 'px-6', 'text-left', 'text-wrap');
        precio.textContent = producto.precio_producto;

        
        const categoria = document.createElement('td');
        categoria.classList.add('py-3', 'px-6', 'text-left', 'text-wrap');
        categoria.textContent = producto.categoria_id;

        // Create action cell with icons
        const actionsCell = document.createElement('td');
  
        // edit icon
        const editIcon = document.createElement('i');
        editIcon.classList.add('fas', 'fa-edit', 'text-blue-500', 'cursor-pointer', 'mr-2');
        editIcon.setAttribute('title', 'Editar');
        editIcon.addEventListener('click', () => openEditForm(producto));
  
        // delete icon
        const deleteIcon = document.createElement('i');
        deleteIcon.classList.add('fas', 'fa-trash-alt', 'text-red-500', 'cursor-pointer', 'mr-2');
        deleteIcon.setAttribute('title', 'Eliminar');
        deleteIcon.addEventListener('click', () => deleteProducto(producto.id));
  
        // Photo icon
        const photoIcon = document.createElement('i');
        photoIcon.classList.add('fa-regular', 'fa-file-image', 'text-green-500', 'cursor-pointer');
        photoIcon.setAttribute('title', 'Foto de Producto');
        photoIcon.addEventListener('click', () => showUserPhotos(producto.imagen_producto));
  
        // Add icons to the action cell
        actionsCell.appendChild(editIcon);
        actionsCell.appendChild(deleteIcon);
        actionsCell.appendChild(photoIcon);
  
        // Add cells to row
        row.appendChild(id);
        row.appendChild(nombre);
        row.appendChild(descripcion);
        row.appendChild(precio);
        row.appendChild(categoria);
        row.appendChild(actionsCell);
  
        // Add row to table
        tableBody.appendChild(row);
      });
  
    } catch (error) {
      console.error('Error al obtener productos:', error);
    }
  }
  
  // producto delete function
  async function deleteProducto(productoId) {
    const confirmDelete = confirm('¿Estás seguro de que deseas eliminar este producto?');
    if (confirmDelete) {
      try {
        const response = await fetch(`http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swProductos.php?id=${productoId}`, {
          method: 'DELETE'
        });
        getProductos();
      } catch (error) {
        console.error('Error al eliminar el producto:', error);
      }
    }
  }
  
  //Open Update form
  
  function openEditForm(producto) {
    const newWindow = window.open('../producto/actualizarProducto.php', '_blank', 'width=600,height=600');
  
    newWindow.onload = function() {
      newWindow.postMessage(producto, '*');
    };
  
    newWindow.onbeforeunload = function() {
      getProductos();
    };
  }
  
  //Show Photo
  
  async function showUserPhotos(imagen_producto) {
    
    const imageUrl ="../../../businessLogic/"+imagen_producto;
  
    const newWindow = window.open('', '_blank', 'width=600,height=600');
    newWindow.document.write(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta nombre="viewport" content="width=device-width, initial-scale=1.0">
            <title>Foto de Producto</title>
            <style>
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                    background-color: #f0f0f0;
                }
                img {
                    max-width: 100%;
                    max-height: 100%;
                }
            </style>
        </head>
        <body>
            <img src="${imageUrl}" alt="Foto de Producto">
        </body>
        </html>
    `);
    newWindow.document.close();
  }
  
  document.addEventListener('DOMContentLoaded', getProductos);