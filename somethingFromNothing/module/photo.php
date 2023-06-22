<?php

function getPhoto($path, $id, $default)
{
    $csvFile = file($path);
    $lastPhotoName = $default;

    foreach ($csvFile as $line) {
        $data = explode(';', $line);
        if ($data[0] == $id) {
            $lastPhotoName = $data[3];
        }
    }

    return $lastPhotoName;
}
