<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : "ENG";
setcookie('lang', strtoupper($lang), time() + 3600);
echo json_encode(['success' => 'success']);
