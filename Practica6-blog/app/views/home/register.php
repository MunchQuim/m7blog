<?php
include_once  __DIR__.'/../../utils/auth.php';
if (session_status() == 1) {
  session_start();
}

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

  <main class="flex-grow bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white shadow-md rounded p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Registro</h2>
      <form action="#" method="POST" class="space-y-4">
        <!-- Nombre de usuario -->
        <div>
          <label for="username" class="block text-gray-700 font-semibold mb-2">Nombre de Usuario</label>
          <input type="text" id="username" name="username"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
            placeholder="Tu nombre de usuario" required>
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
          <input type="email" id="email" name="email"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
            placeholder="Tu correo electrónico" required>
        </div>

        <!-- Contraseña -->
        <div>
          <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
          <input type="password" id="password" name="password"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
            placeholder="Tu contraseña" required>
        </div>

        <!-- Confirmar Contraseña -->
        <div>
          <label for="confirm_password" class="block text-gray-700 font-semibold mb-2">Confirmar Contraseña</label>
          <input type="password" id="confirm_password" name="confirm_password"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
            placeholder="Confirma tu contraseña" required>
        </div>

        <!-- Botón de enviar -->
        <div>
          <button type="submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Registrarse</button>
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