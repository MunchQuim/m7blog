<?php
include_once __DIR__ . '/../../utils/auth.php';
if (session_status() == 1) {
  session_start();
}

/*  */

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monlau Blog</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen">
  <!-- Header -->
  <?php
  require_once 'app/components/header.php';
  ?>
  <!-- Main Content -->
  <main id="main" class="flex-grow bg-gray-100 p-6 flex flex-col items-center overflow-y-auto relative "
    style="max-height: calc(100vh - 8rem);">
    <?php

    /* die (var_dump($posts)); */
    if (count($posts) > 0) {
      foreach ($posts as $post) {
        echo '
        <a class="w-2/5 flex flex-col items-center overflow-y-auto" href="/2DAW/Practica6-blog/posts/view/' . $post['id'] . '">
        <div class="bg-white shadow-md rounded-lg p-6 w-full  mb-4">
          <p class="text-sm text-gray-500 uppercase tracking-wide">' . htmlspecialchars($post['tema']) . '</p>
          <h1 class="text-xl font-bold text-gray-800 mt-2">' . htmlspecialchars($post['title']) . '</h1>
          <p class="text-gray-600 mt-4">' . htmlspecialchars($post['message']) . '</p>
        </div></a>
        
        ';
      }
    } else {
      echo '<p class="text-gray-600 text-lg">Bienvenido a Monlau Blog</p>';
    }
    if(isset($_SESSION['username'])&& isset($_SESSION['user_id'])){
      require_once 'app/components/chat.php';
    }
    
    ?>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white text-center py-4">
    <p>&copy; 2024 Monlau Blog. Todos los derechos reservados.</p>
  </footer>
</body>

</html>