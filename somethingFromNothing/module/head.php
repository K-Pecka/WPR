<?php
require_once 'script.php';
require_once 'style.php';
$head = '
    <meta charset="UTF-8">
    <link rel="icon" type="image/jpeg" href="../image/icon/mainIcon.jpg">
    <title>{{TITLE}}</title>';
$head = str_replace("{{TITLE}}", $config->title, $head);
$head = str_replace("{{banner_IMG}}", $config->mainIcon, $head);

$head .= $style . $script;
