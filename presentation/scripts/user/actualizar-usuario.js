window.addEventListener('message', (event) => {
    const usuario = event.data;
    document.getElementById('id').value = usuario.id;
    document.getElementById('cedula').value = usuario.cedula;
    document.getElementById('firstName').value = usuario.firstName;
    document.getElementById('lastName').value = usuario.lastName;
    document.getElementById('email').value = usuario.email;
    document.getElementById('password').value = usuario.password;
    document.getElementById('telefono').value = usuario.telefono;
    document.getElementById('perfil').value = usuario.perfil;
  });
  
  async function actualizarUsuario(event) {
    event.preventDefault();
    
    const id = document.getElementById('id').value;
    const cedula = document.getElementById('cedula').value;
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const telefono = document.getElementById('telefono').value;
    const perfil = document.getElementById('perfil').value;


    const usuario = {
        id: id,
        cedula: cedula,
        firstName: firstName,
        lastName: lastName,
        email: email,
        password: password,
        telefono: telefono,
        perfil: perfil
    };

  
    try {
        const response = await fetch('http://localhost/Practica_Orientada_Eventos_PHP10/businessLogic/swUser.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(usuario)
        });
        window.close();
        
    } catch (error) {
        console.error('Error al actualizar usuario:', error);
    }
}
  
  document.getElementById('actualizarUsuarioForm').addEventListener('submit', actualizarUsuario);