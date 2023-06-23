<?php
session_start();
$config = json_decode(file_get_contents('../../config/config.json'));
try {
    $pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT nickName, email FROM user WHERE id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['id']);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($userData);
} catch (PDOException $e) {
    echo 'Błąd połączenia lub zapytania: ' . $e->getMessage();
}
