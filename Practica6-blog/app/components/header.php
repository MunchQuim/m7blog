<?php 
$logSign = '<button id="register" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Registrarse</button>
<button id="login" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">Iniciar
sesión</button>';
$logout = '<button id="logout" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">Cerrar
        sesión</button>';
$usersBtn = '<button id="usuarios" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
    Usuarios</button>';
$postsBtn = '<button id="posts" class="bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-4 rounded">
    Posts</button>';
$crear = '<button class="bg-green-500 text-white px-4 py-2 relative left-0 rounded hover:bg-green-700">Crear un nuevo blog</button>';
?>
<script src='/2DAW/Practica6-blog/public/js/register-login.js' defer></script>
<header class="bg-gray-800 text-white py-4 px-6 flex justify-between items-center">
    <h1 id="home" class="text-xl font-bold cursor-pointer">Monlau Blog</h1>
    <div class="space-x-4">
      <?php
      if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
        if (comprobarRol('admin')) {
          echo $usersBtn;
          echo $postsBtn;
        }
        echo "<a href='/2DAW/Practica6-blog/posts/create'>$crear</a>";
        echo $logout;
      } else {
        echo $logSign;
      }
      ?>
    </div>
  </header>