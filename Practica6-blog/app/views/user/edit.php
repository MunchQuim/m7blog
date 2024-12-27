

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
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Crear Usuario</h2>
    <form action="" method="POST" class="space-y-4">
      <!-- Username -->
      <div>
        <label for="username" class="block text-gray-700 font-semibold mb-2">Nombre de Usuario</label>
        <input type="text" id="username" name="username"
          class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
          placeholder="Escribe tu nombre de usuario" required value="<?php echo $user['username']?>">
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
        <input type="email" id="email" name="email"
          class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
          placeholder="Escribe tu correo electrónico" required value="<?php echo $user['email']?>">
      </div>

      <!-- Role -->
      <div>
        <label for="role" class="block text-gray-700 font-semibold mb-2">Rol</label>
        <select id="role" name="role"
          class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
          required>
          <option value="">Seleccione un rol</option>
          <option value="admin">Administrador</option>
          <option value="user">Usuario</option>
        </select>
      </div>

      <!-- Botón de enviar -->
      <div>
        <button type="submit"
          class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Actualizar</button>
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