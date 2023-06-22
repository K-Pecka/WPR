<?php
session_start();
$config = json_decode(file_get_contents("../../config/config.json"));
if (isset($_COOKIE['lang']) && file_exists("../../config/" . $_COOKIE['lang'] . "/config.json") && isset($_SESSION['id'])) {
    $config = json_decode(file_get_contents("../../config/" . $_COOKIE['lang'] . "/config.json"));
}
header('Content-Type: application/json');
if (isset($_GET['noData'])) {
    echo json_encode(["error" => $config->error->noData]);
}
if (isset($_GET['errorServer'])) {
    echo json_encode(["error" => $config->error->errorServer]);
}
if (isset($_GET['notFound'])) {
    echo json_encode(["error" => $config->error->notFound]);
}
