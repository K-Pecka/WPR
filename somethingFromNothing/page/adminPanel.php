<?php
session_start();
$config = json_decode(file_get_contents('../config/config.json'));

require_once '../module/html.php';
if (!isset($nav) || !isset($head) || !isset($footer) || !isset($footer)) {
    header('Location: error.php');
}
if (!isset($_SESSION['id'])) {
    header('Location: /');
}
require_once '../service/user.php';
require_once '../service/function.php';
$user = getUser();
if (isset($user['image'])) $user['image'] = '';
if (!checkRole($_SESSION['id'], 'admin')) {
    header('Location: ./');
}
?>
<DOCTYPE html>
    <html>

    <head>
        <?php echo $head; ?>
        <style>
            header {
                margin: 5% 0;
            }

            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            #content {
                margin-top: 20px;
            }
        </style>
    </head>

    <body>
        <?php echo $nav; ?>
        <main id="content">
            <header>
                <h1>Panel użytkownika</h1>
            </header>
            <section class="user-panel">
                <div class="user-profile">
                    <img src=<?php echo "../image/public/user/random.jpg"; ?> alt="User Avatar" class="avatar">
                    <h2><?php echo $user['user']['nickName'] ?></h2>
                    <p><?php echo $user['user']['email'] ?></p>
                    <a href="#" class="edit-profile">dodaj zdjęcie</a>
                </div>
                <nav class="panel-user-menu">
                    <ul>
                        <li><a href="#admin-section-1">Zarządzanie uprawnieniami</a></li>
                        <li><a href="#admin-section-2">Dodaj role</a></li>
                        <li><a href="#admin-section-3">Akceptacja</a></li>
                        <li><a href="#admin-section-4">wiadomości</a></li>
                    </ul>
                </nav>
            </section>

            <section id="user-section-1" class="user-section">
                <h3>Zarządzanie uprawnieniami</h3>

            </section>

            <section id="user-section-2" class="user-section">
                <h3>Dodaj role</h3>
            </section>

            <section id="user-section-3" class="user-section">
                <h3>Akceptacja</h3>
            </section>

            <section id="user-section-4" class="user-section">
                <h3>wiadomości</h3>
            </section>

        </main>
        <?php echo $footer; ?>
    </body>

    </html>