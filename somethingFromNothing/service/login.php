<?php
session_start();
$config = json_decode(file_get_contents('../config/config.json'));
require_once 'function.php';
if (isset($_POST['login']) && isset($_POST['pass'])) {
    try {
        $pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['pass']);

        // Pobranie hasła użytkownika z bazy danych na podstawie loginu
        $query = "SELECT * FROM user WHERE nickName = :login";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['pass'])) {
            $response = ['success' => true, 'message' => 'Logowanie udane'];
            setSignUp($user['id']);
            echo json_encode($response);
        } else {
            // Błędne dane logowania
            $response = ['success' => false, 'message' => 'Nieprawidłowa nazwa użytkownika lub hasło'];
            echo json_encode($response);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        $error = ['error' => 'Błąd połączenia z bazą danych: ' . $e->getMessage(), 'code' => 'ERR_DB_CONNECTION'];
        echo json_encode($error);
    }
} else {
    http_response_code(400);
    $error = ['error' => 'Nieprawidłowe żądanie: nie wszystkie pola zostały przesłane.', 'code' => 'ERR_INVALID_REQUEST'];
    echo json_encode($error);
}
