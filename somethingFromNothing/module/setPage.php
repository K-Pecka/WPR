<?php
require_once 'setLang.php';

$HTML = $config->HTML;
$errorBannner = '';
if (isset($_SESSION['error']) || isset($_SESSION['mess'])) {
    require_once 'errorMessage.php';
}
require_once 'footer.php';
require_once 'nav.php';
require_once 'head.php';
require_once 'header.php';
require_once 'bannerCookies.php';

require_once 'photo.php';


if (!isset($nav) || !isset($head) || !isset($footer)) {
    header('Location: ./error.php');
}

$path = explode('/', $_SERVER['PHP_SELF']);
$file = end($path);

$public = array('index.php', 'recipe.php');

if (isset($_SESSION['logOut'])) {
    $_SESSION['mess']['logOut'] = true;
} else if (!in_array($file, $public) && !isset($_SESSION['id'])) {
    $_SESSION['error']['authorization'] = true;
    header('Location: ./');
}
