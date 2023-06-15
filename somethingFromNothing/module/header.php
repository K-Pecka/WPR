<?php
$header = '<div><h1>' . $config->HTML->h1 . '</h1>';
foreach ($HTML->header as $p) {
	$header .= "<p>$p</p>";
}
$header .=	'</div>';
