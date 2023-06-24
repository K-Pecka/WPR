<?php
session_start();
require_once '../module/setPage.php';
?>
<DOCTYPE html>
  <html>

  <head>
    <?php echo $head; ?>
    <style>
      h2 {
        color: red;
        font-size: 24px;
        margin-bottom: 20px;
      }

      form {
        width: 300px;
        margin: 0 auto;
      }

      label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
      }

      input[type="text"],
      input[type="email"],
      input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
      }

      button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
      }

      button[type="submit"]:hover {
        background-color: #45a049;
      }
    </style>

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

      section {
        display: none;
        transition: all 0.5s;
      }

      section:target {
        display: block;
        transition: all 0.5s;
      }

      input[type="file"] {
        display: none;
      }

      .panel-user-menu {
        max-width: 100%;
      }

      h2 {
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
      }

      form {
        width: 70%;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
      }

      label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        flex-basis: 40%;
      }

      input[type="text"],
      input[type="email"],
      input[type="password"] {
        width: calc(50% - 5px);
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
      }

      button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 5%;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        flex-basis: 80%;
        margin: 5% auto;
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
          <img src="../image/public/user/<?php echo getPhoto('../data/user.csv', $_SESSION['id'], 'random.jpg') ?>" alt="User Avatar" class="avatar">
          <h2>Kacper</h2>
          <p>w@wp.pl</p>
          <label>
            <input type="file">dodaj zdjęcie
          </label>


        </div>
        <nav class="panel-user-menu">
          <ul>
            <li><a href="#user-section-updateData">Edytuj dane</a></li>
            <li><a href="#user-section-2">Historia działań</a></li>
            <li><a href="#user-section-3">Usuń konto</a></li>
          </ul>
        </nav>
      </section>

      <section id="user-section-updateData" class="user-section">

      </section>
      <section id="user-section-2" class="user-section">
        <h3>Działania na koncie</h3>
        <!-- Zawartość sekcji "Panel użytkownika" -->
      </section>
      <section id="user-section-3" class="user-section">
        <h3>Usuń konto</h3>
        <!-- Zawartość sekcji "Panel użytkownika" -->
      </section>
    </main>
    <?php echo $footer; ?>
  </body>

  </html>