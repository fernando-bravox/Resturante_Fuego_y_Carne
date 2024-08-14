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
    <?php include ('../../components/navegacionlogin.php'); ?>

    <div class="container mx-auto max-w-2xl py-8">
        <!-- Encabezado -->
        <div class="bg-white shadow-md rounded px-16  pt-6 pb-8 mb-4">
            <div class="flex items-center justify-between mb-4 text-justify ">
                <h1 class="text-3xl font-bold text-gray-800">Ingresar Usuario</h1>
                                <!-- Botón para cambiar los colores -->
                                <div class="flex items-center justify-between">
                <button id="colorToggleBtn" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-4">
    Cambiar Colores
</button>
                </div>
            </div>
            <form id="usuarioForm" class="">
                <div class="mb-4 zoomable">
                    <label for="Cedula" class="block text-gray-700 text-sm font-bold mb-2">Cedula :</label>
                    <input type="text" id="cedula" name="cedula" placeholder="Ingrese su cedula"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4 zoomable">
                    <label for="firstName" class="block text-gray-700 text-sm font-bold mb-2">Nombre :</label>
                    <input type="text" id="firstName" name="firstName" placeholder="Ingrese su nombre"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4 zoomable">
                    <label for="lastName" class="block text-gray-700 text-sm font-bold mb-2">Apellido :</label>
                    <input type="text" id="lastName" name="lastName" placeholder="Ingrese su apellido"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4 zoomable">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email :</label>
                    <input type="text" id="email" name="email" placeholder="Ingrese su correo"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4 zoomable">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña :</label>
                    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4 zoomable">
                    <label for="telefono" class="block text-gray-700 text-sm font-bold mb-2">Telefono :</label>
                    <input type="text" id="telefono" name="telefono" placeholder="Ingrese su telefono"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                
                <div class="mb-4 zoomable">
                    <label for="perfil" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Cuenta:</label>
                    <select id="perfil" name="perfil" class="input-field w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="cliente">Cliente</option>
                        <option value="administrador">Administrador</option>
                    </select>
                </div>
                
                <div class="flex items-center justify-between mb-4">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Ingresar</button>
                </div>
                

            </form>
        </div>
    </div>

</body>
<script src="../../scripts/user/add-user.js"></script>
</html>
