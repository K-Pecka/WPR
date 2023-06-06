<?php
$head = '
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{BANER_IMG}}">
    <title>{{TITLE}}</title>';
$head = str_replace("{{TITLE}}", $config->title, $head);
