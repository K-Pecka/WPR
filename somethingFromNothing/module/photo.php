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
function addRecord($csvFile, $data, $id_user, $photoName)
{
    $lastRecord = [];
    $id = 1;

    if (file_exists($csvFile)) {
        $file = fopen($csvFile, 'r');
        $lastLine = '';

        while (!feof($file)) {
            $lastLine = fgets($file);
        }

        fclose($file);

        if (!empty($lastLine)) {
            $lastRecord = str_getcsv($lastLine, ';');
            $id = intval($lastRecord[0]) + 1;
        }
    }

    $record = [$id, $data, $id_user, $photoName];
    $file = fopen($csvFile, 'a');
    fputcsv($file, $record, ';');
    fwrite($file, "\n");
    fclose($file);
}
