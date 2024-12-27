<?php
require_once 'app/controllers/UserController.php';
require_once 'app/config/Database.php';
use models\User;
use config\Database;
$database = new Database();
$db = $database->getConnection();
$chatUsers = new User($db);
$colores = ['bg-gray-50', 'bg-gray-300'];
$friends = $chatUsers->read();
?>
<script src="public/js/chat.js" defer></script>
<div id="user_container" class="bg-gray-300 rounded absolute bottom-0 right-0 p-4 w-80">
    <h1 class="text-xl font-bold pb-4 px-4">Usuarios</h1><!-- de seguir mejorandolo tendrian que ser "amigos" -->
    <div id="friends_container">
        <?php
        $index = 0;
        foreach ($friends as $friend) {

            if ($friend['id'] != $_SESSION['user_id']) {
                echo "<button class='friend_btn w-full' data-id='{$friend['id']}'><div class='{$colores[$index]} rounded font-bold p-2 hover:bg-gray-800 hover:text-white'>{$friend['username']}</div></button>";

                $index = $index + 1;
                if ($index >= count($colores)) {
                    $index = 0;
                }
            }

        }
        ?>

    </div>
    <script>
        const userId = <?php echo json_encode($_SESSION['user_id']); ?>;
    </script>

</div>