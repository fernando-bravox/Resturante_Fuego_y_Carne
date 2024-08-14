<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Completo con Tailwind CSS</title>
    <link href="../../styles/tailwind.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <?php include('../../components/navigation.php');?>

    <div class="container mx-auto py-2">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-3xl font-bold text-white">Gestión de Usuarios</h1>
            <a href="addUser.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Crear Usuario</a>
        </div>

        <div class="bg-white shadow-md rounded my-6 mx-auto" style="max-width: 90%;">
            <table class="min-w-full bg-white" id="table-usuario">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-6 text-left">Id</th>
                        <th class="py-2 px-6 text-left">Cédula</th>
                        <th class="py-2 px-6 text-left">Nombre</th>
                        <th class="py-2 px-6 text-left">Apellido</th>
                        <th class="py-2 px-6 text-left">Correo</th>
                        <th class="py-2 px-6 text-left">Contraseña</th>
                        <th class="py-2 px-6 text-left">Teléfono</th>
                        <th class="py-2 px-6 text-left">Perfil</th>
                        <th class="py-6 px-6 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                </tbody>
            </table>
        </div>
    </div>

    <script src="../../scripts/user/main.js"></script>
</body>
</html>