<?php
include_once __DIR__ . '/../../utils/auth.php';
if (session_status() == 1) {
    session_start();
}
$borrar = '<button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Borrar</button>';
/*  */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monlau Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../public/js/register-login.js" defer></script>
</head>

<body class="flex flex-col min-h-screen">
    <!-- Header -->
    <?php
  require_once 'app/components/header.php';
  ?>

    <!-- Main Content -->
    <main class="flex-grow bg-gray-100 p-6 flex flex-col items-center overflow-y-auto">
        <?php
        if (count($post) > 0) {
            echo '
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-sm mb-4">
          <p class="text-sm text-gray-500 uppercase tracking-wide">' . htmlspecialchars($post['tema']) . '</p>
          <h1 class="text-xl font-bold text-gray-800 mt-2">' . htmlspecialchars($post['title']) . '</h1>
          <p class="text-gray-600 mt-4">' . htmlspecialchars($post['message']) . '</p>
        ';
        if (comprobarOwnership($post['id']) || comprobarRol('admin')) {
            echo "<form action='/2DAW/Practica6-blog/posts/delete/{$post['id']}' method='POST' onsubmit=\"return confirm('¿Estás seguro de que deseas eliminar este post?');\">
                            <button type='submit' class='text-red-500 hover:underline'>{$borrar}</button></form>";
        }
        echo "</div>";
            /* seguir aqui con mensajes */
            if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
                echo '
        <form method="POST" action="" class="bg-white shadow-md rounded-lg p-4 w-full max-w-sm mb-4">

          <textarea placeholder="añadir un comentario" id="comment" name="comment" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4" required></textarea>
          <input type="hidden" name="post_id" value="' . $post['id'] . '">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
            Enviar
          </button>
        </form>';
            } else {
                echo '
        <form method="POST" action="" class="bg-white shadow-md rounded-lg p-4 w-full max-w-sm mb-4">

          <textarea placeholder="Inicia sesión para poder añadir un comentario" id="comment" name="comment" class="shadow resize-none appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4" required disabled></textarea>
          
        </form>
        ';
            }

           
            if (count($comments) > 0) {
                echo '<div class="bg-white shadow-md rounded-lg p-2 w-full max-w-sm mb-4">';
                foreach ($comments as $comment) {
                    echo '
                    <div class="bg-gray-100 p-2 rounded m-2" ><p class="text-sm text-gray-500">Usuario: <span class="font-bold text-gray-800">' . $comment['username'] . ' </span></p>
              <p class="text-gray-600 mt-2"> <span class="text-gray-700"> ' . $comment['message'] . '</span></p>
                    </div>
              
           
            ';
                }

            }
            echo ' </div>';


        } else {
            echo '<p class="text-gray-600 text-lg">Parece el post al cual estas intentando acceder no existe</p>';
        }
        ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; 2024 Monlau Blog. Todos los derechos reservados.</p>
    </footer>
</body>

</html>