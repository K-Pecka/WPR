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
$user = getUser();
if (isset($user['image'])) $user['image'] = '';
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

      .user-panel {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        margin-top: 30px;
      }

      .user-profile {
        text-align: center;
        margin-right: 30px;
      }

      .avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
      }

      h2,
      p {
        margin: 5px 0;
      }

      .edit-profile {
        display: inline-block;
        padding: 5px 10px;
        background-color: #f5f5f5;
        color: #333;
        text-decoration: none;
      }

      .panel-user-menu {
        margin-top: 20px;
        width: 80%;
      }

      .panel-user-menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
      }

      .panel-user-menu li {
        margin-bottom: 10px;
      }

      .panel-user-menu a {
        display: block;
        padding: 10px 10px;
        background-color: #f5f5f5;
        color: #333;
        text-decoration: none;
      }

      .panel-user-menu a:hover {
        background-color: #e0e0e0;
      }

      .user-section {
        display: block;
        padding: 20px;
        background-color: #f5f5f5;
        margin-top: 20px;
      }

      #footer {
        background-color: #f5f5f5;
        padding: 10px;
        text-align: center;
        font-size: 12px;
        color: #333;
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
          <img src=<?php echo "../image/public/user/" . $user['img'][0]; ?> alt="User Avatar" class="avatar">
          <h2><?php echo $user['user']['nickName'] ?></h2>
          <p><?php echo $user['user']['email'] ?></p>
          <a href="#" class="edit-profile">dodaj zdjęcie</a>
        </div>
        <nav class="panel-user-menu">
          <ul>
            <li><a href="#user-section-2">Edytuj dane</a></li>
            <li><a href="#user-section-3">Historia działań</a></li>
            <li><a href="#user-section-4">Zarządzanie przepisami</a></li>
            <li><a href="#user-section-5">Ustawienia</a></li>
            <li><a href="#" onclick="logout()">Wyloguj</a></li>
          </ul>
        </nav>
      </section>

      <section id="user-section-1" class="user-section">
        <h3>Panel użytkownika</h3>
        <?php var_dump($user) ?>
        <?php var_dump($_SESSION) ?>
        <!-- Zawartość sekcji "Panel użytkownika" -->
      </section>

      <section id="user-section-2" class="user-section">
        <h3>Ulubione</h3>
        <!-- Zawartość sekcji "Ulubione" -->
      </section>

      <section id="user-section-3" class="user-section">
        <h3>Historia działań</h3>
        <!-- Zawartość sekcji "Historia działań" -->
      </section>

      <section id="user-section-4" class="user-section">
        <h3>Zarządzanie przepisami</h3>
        <!-- Zawartość sekcji "Zarządzanie przepisami" -->
      </section>

      <section id="user-section-5" class="user-section">
        <h3>Ustawienia</h3>
        <!-- Zawartość sekcji "Ustawienia" -->
      </section>
    </main>
    <?php echo $footer; ?>
  </body>

  </html>