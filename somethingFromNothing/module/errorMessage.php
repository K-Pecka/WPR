<?php

$message = '';
$class = '';
if (isset($_SESSION['mess']['logOut'])) {
    $message = $config->message->logOut;
    $class = 'class="sucessfullMess"';
    session_destroy();
} else if (!isset($_SESSION['id'])) {
    $message = $config->error->authorization->noSession;
} else if (isset($_SESSION['error']['authorization'])) {
    $message = $config->error->authorization->noPermissions;
}
unset($_SESSION['error']);
$errorBannner = '<div id="error-banner" ' . $class . '><span>' . $message . '</span></div>';
