<?php
require_once '../module/photo.php';
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
  <input type="search" placeholder="' . $HTML->search->placeholder . '" id="nav-search">
  <button class="btn nav-search-btn">' . $HTML->search->button->title . '</button>
</li>
</ol>';
$mainMenu = '';
foreach ($HTML->mainMenu->li as $li) {
  $mainMenu .= "<li>
  <a " . (isset($li->href) ? "href='" . $li->href . "'" : "") . "" . (isset($li->class) ? "class='" . $li->class . "'" : "") . ">
  " . $li->content . "</a>
  </li>";
}
$mainMenu = str_replace("{{SELCT LANG}}", "
<div class='lang-select'>
  <select>
    {{LANG}}
  </select>
</div>", $mainMenu);

$userMenu = isset($_SESSION['id']) ?
  '<img src="../image/public/user/' . getPhoto('../data/user.csv', $_SESSION['id'], 'random.jpg') . '" alt="User Image" class="user-image user-menu userMenu">
    <ul class="user-dropdown">
        <li>
        <div class="slider-container">
          <input type="checkbox" id="toggle" class="toggle-checkbox">
          <label for="toggle" class="toggle-label"></label>
        </div>
        </li>
        {{MAIN MENU}}
      </ul>' :
  '<div id="login-button">
    <button onclick="showLoginPopup()">' . $HTML->login . '</button>
  </div>';
$userMenu = str_replace("{{MAIN MENU}}", $mainMenu, $userMenu);
$pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
$result = $pdo->query("SELECT `initials` as 'lang' FROM `lang`");
$langDb = $result->fetchAll(PDO::FETCH_ASSOC);
$lang = '';
foreach ($langDb as $language) {
  $lang .= "<option value='" . $language['lang'] . "'" . (isset($_COOKIE['lang']) && $language['lang'] == $_COOKIE['lang'] ? "selected" : "") . ">" . $language['lang'] . "</option>";
}
$userMenu  = str_replace("{{LANG}}", $lang, $userMenu);
$nav = str_replace("{{SEARCH}}", $search, $nav);
$nav = str_replace("{{TITLE}}", $config->title, $nav);
$nav = str_replace("{{banner_IMG}}", $config->mainIcon, $nav);
$nav = str_replace("{{USER_MENU}}", $userMenu, $nav);
