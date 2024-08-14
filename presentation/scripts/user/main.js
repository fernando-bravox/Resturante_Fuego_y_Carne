async function getUsuarios() {
    try {
      const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swUser.php');
      const data = await response.json();
  
      const usuarios = data;
  
      const tableBody = document.querySelector('#table-usuario tbody');
      tableBody.innerHTML = '';
      let cont=1
  
      usuarios.forEach(usuario => {
       
        // Create table row
        const row = document.createElement('tr');


  
        // Create cells for each usuario property
        const id = document.createElement('td');
        id.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
        id.textContent = cont;
        cont++;
  
        const cedula = document.createElement('td');
        cedula.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
        cedula.textContent = usuario.cedula;
  
        const firstName = document.createElement('td');
        firstName.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
        firstName.textContent = usuario.firstName;
  
        const lastName = document.createElement('td');
        lastName.classList.add('py-3', 'px-6', 'text-left', 'text-wrap');
        lastName.textContent = usuario.lastName;

        const email = document.createElement('td');
        email.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
        email.textContent = usuario.email;
  
        const password = document.createElement('td');
        password.classList.add('py-3', 'px-6', 'text-left', 'text-wrap');
        password.textContent = usuario.password;

        const telefono = document.createElement('td');
        telefono.classList.add('py-3', 'px-6', 'text-left', 'whitespace-nowrap');
        telefono.textContent = usuario.telefono;
  
        const perfil = document.createElement('td');
        perfil.classList.add('py-3', 'px-6', 'text-left', 'text-wrap');
        perfil.textContent = usuario.perfil;
  
        // Create action cell with icons
        const actionsCell = document.createElement('td');
  
        // edit icon
        const editIcon = document.createElement('i');
        editIcon.classList.add('fas', 'fa-edit', 'text-blue-500', 'cursor-pointer', 'mr-2');
        editIcon.setAttribute('title', 'Editar');
        editIcon.addEventListener('click', () => openEditForm(usuario));
  
        // delete icon
        const deleteIcon = document.createElement('i');
        deleteIcon.classList.add('fas', 'fa-trash-alt', 'text-red-500', 'cursor-pointer', 'mr-2');
        deleteIcon.setAttribute('title', 'Eliminar');
        deleteIcon.addEventListener('click', () => deleteUsuario(usuario.id));

  
        // Add icons to the action cell
        actionsCell.appendChild(editIcon);
        actionsCell.appendChild(deleteIcon);
        
        
        // Add cells to row
        row.appendChild(id);
        row.appendChild(cedula);
        row.appendChild(firstName);
        row.appendChild(lastName);
        row.appendChild(email);
        row.appendChild(password);
        row.appendChild(telefono);
        row.appendChild(perfil);
        row.appendChild(actionsCell);
  
        // Add row to table
        tableBody.appendChild(row);
      });
  
    } catch (error) {
      console.error('Error al obtener usuarios:', error);
    }
  }
  
  // usuario delete function
  async function deleteUsuario(usuarioId) {
    const confirmDelete = confirm('¿Estás seguro de que deseas eliminar este usuario?');
    if (confirmDelete) {
      try {
        const response = await fetch(`http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swUser.php?id=${usuarioId}`, {
          method: 'DELETE'
        });
        getUsuarios();
      } catch (error) {
        console.error('Error al eliminar el usuario:', error);
      }
    }
  }
  
  //Open Update form
  
  function openEditForm(usuario) {
    const newWindow = window.open('../user/actualizarUsuario.php', '_blank', 'width=600,height=600');
  
    newWindow.onload = function() {
      newWindow.postMessage(usuario, '*');
    };
  
    newWindow.onbeforeunload = function() {
      getUsuarios();
    };
  }
  
  document.addEventListener('DOMContentLoaded', getUsuarios);