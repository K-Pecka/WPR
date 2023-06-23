<?php
session_start();
$config = json_decode(file_get_contents('../../config/config.json'));
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $nickName = $_POST['nickName'];
        $email = $_POST['email'];
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

        $query = "UPDATE user SET nickName = :nickName, email = :email, pass = :pass WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nickName', $nickName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);

        // Wykonaj zapytanie aktualizacji danych
        if ($stmt->execute()) {
            // Dane użytkownika zostały zaktualizowane
            $response['success'] = true;
            $response['message'] = 'Dane użytkownika zostały zaktualizowane.' . $nickName;
        } else {
            // Wystąpił błąd podczas aktualizacji danych
            $response['success'] = false;
            $response['message'] = 'Wystąpił błąd podczas aktualizacji danych użytkownika.';
        }
        // Formularz nie został wysłany
    } catch (PDOException $e) {
        $response['success'] = false;
        $response['message'] = 'Wystąpił błąd połączenia z bazą danych: ' . $e->getMessage();
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Formularz nie został wysłany.';
}

header('Content-Type: application/json');
echo json_encode($response);
