<?php

$config = json_decode(file_get_contents("../config/config.json"));
if (isset($_COOKIE['lang']) && file_exists("../config/" . $_COOKIE['lang'] . "/config.json") && isset($_SESSION['id'])) {
    $config = json_decode(file_get_contents("../config/" . $_COOKIE['lang'] . "/config.json"));
}
