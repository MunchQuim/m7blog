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
        /* echo var_dump($user); */
        ?>
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Usuario</h2>
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-gray-800">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-gray-800">Username</th>
                        <th class="border border-gray-300 px-4 py-2 text-gray-800">Email</th>
                        <th class="border border-gray-300 px-4 py-2 text-gray-800">Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($user) {
                        echo "<tr>
                        <td class='border border-gray-300 px-4 py-2 text-gray-600'>{$user['id']}</td>
                        <td class='border border-gray-300 px-4 py-2 text-gray-600'>{$user['username']}</td>
                        <td class='border border-gray-300 px-4 py-2 text-gray-600'>{$user['email']}</td>
                        <td class='border border-gray-300 px-4 py-2 text-gray-600'>{$user['role']}</td>
                        </tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>

        <!-- Posts Section -->
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl mb-6">
            <button
                class="accordion-header flex justify-between items-center w-full p-4 text-left text-gray-800 border border-gray-300 rounded"
                onclick="toggleAccordion(this)">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Posts</h2>
                <span class="accordion-icon">+</span>
            </button>
            <div class="accordion accordion-content hidden">
                <div class="accordion-item rounded mb-2">
                    <?php
                    
                    if (count($posts)>0) {
                        foreach ($posts as $post) {
                            echo
                                '<button class="accordion-header flex justify-between items-center w-full p-4 text-left text-gray-800 focus:outline-none" onclick="toggleAccordion(this)">
                                    ' . "<span><strong>{$post['title']}</strong></span>" .
                                '<span class="accordion-icon">+</span>
                            </button>
                            <div class="accordion-content hidden p-4 text-gray-600 bg-gray-50">
                            <a class="w-2/5 flex flex-col items-center overflow-y-auto" href="/2DAW/Practica6-blog/posts/view/' . $post['post_id'] . '">
                                    <p class="text-sm text-gray-500 uppercase tracking-wide">' . htmlspecialchars($post['tema']) . '</p>
                                    <p class="text-gray-600 mt-4">' . htmlspecialchars($post['post_message']) . '</p>
                            </a>
                            </div>';
                        }
                    } else {
                        echo '<p class="text-gray-600 mt-4"> Sin Posts</p>';
                    }
                    ?>

                </div>
            </div>

        </div>

        <!-- Comments Section -->
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl mb-6">
            <button
                class="accordion-header flex justify-between items-center w-full p-4 text-left text-gray-800 border border-gray-300 rounded"
                onclick="toggleAccordion(this)">
                <h2 class="text-xl font-bold text-gray-800 mb-4">comentarios</h2>
                <span class="accordion-icon">+</span>
            </button>
            <div class="accordion accordion-content hidden">
                <div class="accordion-item rounded mb-2">
                    <?php
                    if ($comments) {
                        foreach ($comments as $comment) {
                            echo
                                '
                            <div class="accordion-content hidden p-4 text-gray-600 bg-gray-50">
                                    <p class="text-gray-600 mt-4">' . htmlspecialchars($comment['comment_message']) . '</p>
                            </div>';
                        }
                    } else {
                        echo '<p class="text-gray-600 mt-4"> Sin comentarios</p>';
                    }
                    ?>

                </div>
            </div>

        </div>
    </main>


    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; 2024 Monlau Blog. Todos los derechos reservados.</p>
    </footer>
</body>
<script>
    function toggleAccordion(button) {
        const content = button.nextElementSibling;
        const icon = button.querySelector('.accordion-icon');

        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.textContent = '-';
        } else {
            content.classList.add('hidden');
            icon.textContent = '+';
        }
    }
</script>

</html>