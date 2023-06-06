<?php
$config = json_decode(file_get_contents('../config/config.json'));


try {
    $pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = 'SELECT * FROM `ingredient`';

    $statement = $pdo->query($query);
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($data);

    header('Content-Type: application/json');
    echo $json;
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection error: ' . $e->getMessage()]);
}
