<?php
session_start();
$config = json_decode(file_get_contents('../../config/config.json'));

try {
    $pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = 'DELETE FROM `favorite_recipe` WHERE `id_recipe` = :id_recipe AND `id_user` = :id_user';

    $statement = $pdo->prepare($query);
    $statement->bindParam(':id_recipe', $_GET['recipe'], PDO::PARAM_INT);
    $statement->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_INT);
    $statement->execute();
    echo json_encode(['status' => 'ok', 'id_user' => $_SESSION['id'], 'id_recipe' => $_GET['recipe']]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection error: ' . $e->getMessage()]);
}
