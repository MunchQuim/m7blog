<?php

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
  <main class="flex-grow bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Crear Blog</h2>
      <form action="" method="POST" class="space-y-4">
        <!-- Título -->
        <div>
          <label for="title" class="block text-gray-700 font-semibold mb-2">Título</label>
          <input type="text" id="title" name="title"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
            placeholder="Escribe el título de tu publicación" required>
        </div>

        <!-- Texto -->
        <div>
          <label for="message" class="block text-gray-700 font-semibold mb-2">Texto</label>
          <textarea id="message" name="message" rows="6"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
            placeholder="Escribe el contenido de tu publicación" required></textarea>
        </div>

        <!-- Tema -->
        <div>
          <label for="theme_id" class="block text-gray-700 font-semibold mb-2">Tema</label>
          <select id="theme_id" name="theme_id"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
            required>
            <?php
            foreach ($themes as $theme) {
              echo "<option  value='" . $theme['id'] . "'>" . $theme['tema'] . "</option>";
            }
            ?>


          </select>
        </div>

        <!-- Botón de enviar -->
        <div>
          <button type="submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Publicar</button>
        </div>
      </form>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white text-center py-4">
    <p>&copy; 2024 Monlau Blog. Todos los derechos reservados.</p>
  </footer>
</body>

</html>