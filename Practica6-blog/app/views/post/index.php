<?php
include_once __DIR__ . '/../../utils/auth.php';
comprobarSesion();

$ver = '<button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Ver</button>';
$editar = '<button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700">Editar</button>';
$borrar = '<button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Borrar</button>';
$crear = '<button class="bg-green-500 text-white px-4 py-2 mb-6 rounded hover:bg-green-700">Crear un nuevo blog</button>';

$crudBtns = $ver . $editar . $borrar;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monlau Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="public/js/register-login.js" defer></script>
</head>

<body class="flex flex-col min-h-screen">
    <!-- Header -->
    <?php
  require_once 'app/components/header.php';
  ?>

    <!-- Main Content -->
    <main class="flex-grow bg-gray-100 p-6">
        <div class="container mx-auto p-6">
            <h1 class="text-2xl font-bold mb-4">Gestión de Blogs</h1>
            <?php 
            echo "<a href='/2DAW/Practica6-blog/posts/create'>$crear</a>";
            ?>
            <!-- Tabla de Usuarios -->
            <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Title</th>
                        <th class="px-4 py-2 text-left">Theme</th>
                        <th class="px-4 py-2 text-left">Owner</th>
                        <th class="px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($posts as $post) {
                        echo "<tr><td class='px-4 py-2'>{$post['id']}</td>";
                        echo "<td class='px-4 py-2'>{$post['title']}</td>";
                        echo "<td class='px-4 py-2'>{$post['tema']}</td>";
                        echo "<td class='px-4 py-2'>{$post['username']}</td>";
                        echo "<td class='px-4 py-2 flex space-x-2'> 
                                <a href='/2DAW/Practica6-blog/posts/view/{$post['id']}'>{$ver}</a>
                                <a href='/2DAW/Practica6-blog/posts/edit/{$post['id']}'>{$editar}</a>
                                <form action='/2DAW/Practica6-blog/posts/delete/{$post['id']}' method='POST' onsubmit=\"return confirm('¿Estás seguro de que deseas eliminar este post?');\">
                                <button type='submit' class='text-red-500 hover:underline'>{$borrar}</button>
                                </form>
                            </td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; 2024 Monlau Blog. Todos los derechos reservados.</p>
    </footer>
</body>

</html>