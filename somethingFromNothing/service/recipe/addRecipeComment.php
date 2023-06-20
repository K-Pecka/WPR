<?php
session_start();
$config = json_decode(file_get_contents('../../config/config.json'));
if (!isset($_SESSION['id'])) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Autohorization problem']);
}
try {
    $pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO comments (id_recipe, content,id_user) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['id_recipe'], $_POST['comment'], $_SESSION['id']]);

    header('Content-Type: application/json');
    echo json_encode(['id' => 'id_recipe=' . $_POST['id_recipe']]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection error: ' . $e->getMessage()]);
}
