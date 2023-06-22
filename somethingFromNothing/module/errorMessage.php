<?php

$message = '';
if (!isset($_SESSION['id'])) {
    $message = $config->error->authorization->noSession;
} else if (isset($_SESSION['error']['authorization'])) {
    $message = $config->error->authorization->noPermissions;
}
unset($_SESSION['error']);
$errorBannner = '<div id="error-banner"><span>' . $message . '</span></div>';
