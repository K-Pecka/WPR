<?php


function emailVerification($email)
{
    return preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email) && strlen($email) > 0;
}

function somePasswords($passOne, $passTwo)
{
    return $passOne === $passTwo && strlen($passOne) >= 8 && strlen($passOne) <= 30;
}

function nickName($nick)
{
    return preg_match('/^[a-zA-Z0-9_-]+$/', $nick) && strlen($nick) >= 3 && strlen($nick) <= 20;
}
function setSignUp($id)
{
    $_SESSION['id'] = $id;
}

function checkRole($id, $role)
{
    $config = json_decode(file_get_contents('../config/config.json'));
    $pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $query = 'SELECT `role`.`name` as "role" FROM `user` JOIN `role` ON `role`.`id`= `role` WHERE `user`.`id` = ?';

    $statement = $pdo->prepare($query);

    $statement->execute([$id]);

    $data = $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    return $data["role"]  == $role;
}
