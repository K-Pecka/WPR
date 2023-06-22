<?php
$banner = '';
if (!isset($_COOKIE['accepted'])) {
    $banner = '
    <div id="cookie-banner">
        <p id="cookie-message">' . $HTML->cookies->p . '</p>
        <button id="cookie-accept">' . $HTML->cookies->button . '</button>
    </div>';
}
