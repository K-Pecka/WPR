<?php
session_start();
$config = json_decode(file_get_contents('../../config/config.json'));
require_once 'function.php';
if (isset($_POST['nickName']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordVerification'])) {
    try {
        $pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $nickname = htmlspecialchars($_POST['nickName']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $verification = htmlspecialchars($_POST['passwordVerification']);

        if (!emailVerification($email)) {
            http_response_code(400);
            $error = ['error' => 'Nieprawidłowy adres e-mail.', 'code' => 'ERR_EMAIL_INVALID'];
        } else if (!somePasswords($password, $verification)) {
            http_response_code(400);
            $error = ['error' => 'Hasła nie są zgodne lub puste.', 'code' => 'ERR_PASSWORD_MISMATCH'];
        } else if (!nickName($nickname)) {
            http_response_code(400);
            $error = ['error' => 'Nieprawidłowy nick.', 'code' => 'ERR_NICK_INVALID'];
        } else {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE nickname = ?");
            $stmt->execute([$nickname]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                http_response_code(400);
                $error = ['error' => 'Użytkownik o podanym nicku już istnieje.', 'code' => 'ERR_NICK_EXISTS'];
                echo json_encode($error);
                exit();
            }
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO user (nickName, email, pass) VALUES (?, ?, ?)");
            $stmt->execute([$nickname, $email, $hashedPassword]);
            http_response_code(200);
            $success = ['success' => 'Użytkownik został dodany.'];
            setSignUp($pdo->lastInsertId());
            echo json_encode($success);
            exit();
        }

        echo json_encode($error);
    } catch (PDOException $e) {
        http_response_code(500);
        $error = ['error' => 'Database connection error: ' . $e->getMessage(), 'code' => 'ERR_DB_CONNECTION'];
        echo json_encode($error);
    }
} else {
    http_response_code(400);
    $error = ['error' => 'Nieprawidłowe żądanie: nie wszystkie pola zostały przesłane.', 'code' => 'ERR_INVALID_REQUEST'];
    echo json_encode($error);
}
