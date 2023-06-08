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
      <li>{{ADD_RECIPE}}</li>
      <li>
        <label for="label"><img src="../image/icon/lupe.png" class="icon"></label>
        <input type="text" placeholder="Wciśnij Enter, aby odnaleźć przepis lub #, aby pokazać wszystkie przepisy" id="label">
        <button>SZUKAJ</button>
      </li>
    </ol>
    <div class="slider-container">
      <input type="checkbox" id="toggle" class="toggle-checkbox">
      <label for="toggle" class="toggle-label"></label>
    </div>
  </nav>';
$addRecipe = isset($_SESSION['id']) ? "<a href=\"" . $config->path->addRecipePath . "\" target=\"_blank\"><img src=\"../image/icon/add.png\" class=\"icon\"\"></a>" : "";

$nav = str_replace("{{TITLE}}", $config->title, $nav);
$nav = str_replace("{{ADD_RECIPE}}", $addRecipe, $nav);
$nav = str_replace("{{banner_IMG}}", $config->mainIcon, $nav);