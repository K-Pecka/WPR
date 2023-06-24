<?php

function getPhoto($path, $id, $default)
{
    $csvFile = file($path);
    $lastPhotoName = $default;

    foreach ($csvFile as $line) {
        $data = explode(';', $line);
        if (isset($data[2])) {
            if ($data[2] == $id) {
                $lastPhotoName = $data[3];
            }
        }
    }

    return $lastPhotoName;
}
function addRecord($csvFile, $date, $id_user, $photoName)
{
    $lastRecord = [];
    $lastRecord[0] = 1;

    if (file_exists($csvFile)) {
        $file = fopen($csvFile, 'r');
        $lastLine = '';

        while (!feof($file)) {
            $lastLine = fgets($file);
        }

        fclose($file);
        $lastRecord = str_getcsv($lastLine, ';');
        $id = intval($lastRecord[0]) + 1;
    }

    $record = [$id, $date, $id_user, $photoName];
    $file = fopen($csvFile, 'a');
    fputcsv($file, $record, ';');
    fclose($file);
}
