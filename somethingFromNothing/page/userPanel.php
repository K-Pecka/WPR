<?php
session_start();
require_once '../module/setPage.php';
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
        <?php echo checkRole($_SESSION['id'], 'admin') ?>
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