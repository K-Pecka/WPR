<?php
$nav =
  '<nav id="main-nav">
    <div id="banner">
        <img src="{{banner_IMG}}" alt="banner.jpg" class="icon">
        <div id="title">{{TITLE}}</div>
    </div>
    <div id="menu-toggle">
      <input type="checkbox" id="menu-checkbox">
      <label for="menu-checkbox">&#9776;</label>
    </div>
    <ol id="menu-items">
      <li>
        <label for="label"><img src="../image/icon/lupe.png" class="icon"></label>
        <input type="text" placeholder="' . $HTML->search->placeholder . '" id="label">
        <button>' . $HTML->search->button->title . '</button>
      </li>
    </ol>
      <div class="slider-container">
        <input type="checkbox" id="toggle" class="toggle-checkbox">
        <label for="toggle" class="toggle-label"></label>
      </div>
      <div class="user-menu">
      <div class="lang-select">
        {{USER_MENU}}
      </div>
  </nav>
  <div id="login-popup">
    <div id="login-content">
      
    </div>
  </div>
';

$userMenu = isset($_SESSION['id']) ?
  '<img src="../image/public/user/random.jpg" alt="User Image" class="user-image user-menu userMenu">
    <ul class="user-dropdown">
        <li><a href="userPanel.php">Panel użytkownika</a></li>
        <li>
          <a href=" ' . $config->path->addRecipePath . ' " target=_blank>
            <img src="../image/icon/add.png" class="icon icon-min">Dodaj przepis
          </a>
        </li>
        <li>
        <div class="lang-select">
        <select>
          <option value="pl">PL</option>
          <option value="eng" selected>ENG</option>
        </select>
      </div>
        </li>
        <li><a href="#" class="logOut">Wyloguj</a></li>
      </ul>' :
  '<div id="login-button">
    <button onclick="showLoginPopup()">' . $HTML->login . '</button>
  </div>';

$nav = str_replace("{{TITLE}}", $config->title, $nav);
$nav = str_replace("{{banner_IMG}}", $config->mainIcon, $nav);
$nav = str_replace("{{USER_MENU}}", $userMenu, $nav);
