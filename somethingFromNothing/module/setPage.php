<?php
$config = json_decode(file_get_contents("../config/config.json"));
if (isset($_COOKIE['lang']) && file_exists("../config/" . $_COOKIE['lang'] . "/config.json")) {
    $config = json_decode(file_get_contents("../config/" . $_COOKIE['lang'] . "/config.json"));
}
$HTML = $config->HTML;
require_once 'footer.php';
require_once 'nav.php';
require_once 'head.php';
require_once 'header.php';
