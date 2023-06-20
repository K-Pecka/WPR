<?php
$nav =
  '<nav id="main-nav">
    <div id="banner">
        <img src="{{banner_IMG}}" alt="banner.jpg" class="icon">
        <div id="title">{{TITLE}}</div>
    </div>
    {{SEARCH}}
      <div class="user-menu">
        {{USER_MENU}}
      </div>
  </nav>
  <div id="login-popup">
    <div id="login-content">
      
    </div>
  </div>
';
$arrayNotSearch = array('recipe.php');
$path = explode('/', $_SERVER['PHP_SELF']);
$file = end($path);
$search = in_array($file, $arrayNotSearch) ? '' : '
<ol id="menu-items">
<li>
  <label for="nav-search"><img src="../image/icon/lupe.png" class="icon"></label>
  <input type="text" placeholder="' . $HTML->search->placeholder . '" id="nav-search">
  <button class="btn nav-search-btn">' . $HTML->search->button->title . '</button>
</li>
</ol>';

$userMenu = isset($_SESSION['id']) ?
  '<img src="../image/public/user/random.jpg" alt="User Image" class="user-image user-menu userMenu">
    <ul class="user-dropdown">
        <li>
        <div class="slider-container">
          <input type="checkbox" id="toggle" class="toggle-checkbox">
          <label for="toggle" class="toggle-label"></label>
        </div>
        <div id="menu-toggle">
          <input type="checkbox" id="menu-checkbox">
          <label for="menu-checkbox">&#9776;</label>
        </div>
        </li>
        <li><a href="userPanel.php">Panel użytkownika</a></li>
        <li><a href="favorite.php">Ulubione</a></li>
        <li><a href="userRecipe.php">Twoje przepisy</a></li>
        <li>
          <a href=" ' . $config->path->addRecipePath . ' " target=_blank>
            <img src="../image/icon/add.png" class="icon icon-min">Dodaj przepis
          </a>
        </li>
        <li>
          <div class="lang-select">
            <select>
              {{LANG}}
            </select>
          </div>
        </li>
        <li><a href="#" class="logOut">Wyloguj</a></li>
      </ul>' :
  '<div id="login-button">
    <button onclick="showLoginPopup()">' . $HTML->login . '</button>
  </div>';
$pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
$result = $pdo->query("SELECT `initials` as 'lang' FROM `lang`");
$langDb = $result->fetchAll(PDO::FETCH_ASSOC);
$lang = '';
foreach ($langDb as $language) {
  $lang .= "<option value='" . $language['lang'] . "'" . ($language['lang'] == $_COOKIE['lang'] ? "selected" : "") . ">" . $language['lang'] . "</option>";
}
$userMenu  = str_replace("{{LANG}}", $lang, $userMenu);
$nav = str_replace("{{SEARCH}}", $search, $nav);
$nav = str_replace("{{TITLE}}", $config->title, $nav);
$nav = str_replace("{{banner_IMG}}", $config->mainIcon, $nav);
$nav = str_replace("{{USER_MENU}}", $userMenu, $nav);
