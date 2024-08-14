<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Tailwind CSS</title>
    <!-- Incluye Tailwind CSS -->
    <link href="../../styles/tailwind.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Barra de navegación -->
    <?php include ('../../components/navigation.php'); ?>

    <div class="container mx-auto max-w-md py-8">
        <!-- Encabezado -->
        <div class="flex items-center justify-between mb-4 text-justify">
            <h1 class="text-3xl font-bold text-gray-800">Actualizar Usuarios</h1>
        </div>

        <form id="actualizarUsuarioForm" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <input type="hidden" id="id" name="id" value="">
        <div class="mb-4">
                <label for="cedula" class="block text-gray-700 text-sm font-bold mb-2">Cedula :</label>
                <input type="text" id="cedula" name="cedula" placeholder=" Ingrese su Cedula"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>    
        <div class="mb-4">
                <label for="firstName" class="block text-gray-700 text-sm font-bold mb-2">Nombre :</label>
                <input type="text" id="firstName" name="firstName" placeholder=" Ingrese su nombre"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="lastName" class="block text-gray-700 text-sm font-bold mb-2">Apellido :</label>
                <input type="text" id="lastName" name="lastName" placeholder="Ingrese su apellido"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo :</label>
                <input type="email" id="email" name="email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña :</label>
                <input type="password" id="password" name="password" placeholder="Ingrese su contraseña"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="telefono" class="block text-gray-700 text-sm font-bold mb-2">Telefono :</label>
                <input type="text" id="telefono" name="telefono" placeholder="Ingrese su telefono"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="perfil" class="block text-gray-700 text-sm font-bold mb-2">Perfil :</label>
                <input type="text" id="perfil" name="perfil" placeholder="Ingrese su perfil"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Actualizar Usuario</button>
            </div>
        </form>
    </div>
    <script src="../../scripts/user/actualizar-usuario.js"></script>
</body>

</html>