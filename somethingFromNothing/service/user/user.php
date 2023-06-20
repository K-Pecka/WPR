<?php
session_start();
function getImage($id)
{
    $found_images = 'random.jpg';
    if (($handle = fopen('../../data/user.csv', 'r')) !== false) {
        while (($data = fgetcsv($handle, 0, ';')) !== false) {
            if ($data[2] == $id) {
                $found_images = $data[3];
            }
        }
        fclose($handle);
    }

    return $found_images;
}
function getUser($json = null)
{
    $config = json_decode(file_get_contents('../../config/config.json'));
    if (!isset($_SESSION['id'])) exit();
    $id = $_SESSION['id'];
    try {
        $pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);

        $query = 'SELECT nickName,email FROM user WHERE id=?';
        $statement = $pdo->prepare($query);
        $statement->execute([$id]);
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($json == 'json') return json_encode(['user' => $data[0], 'image' => getImage($id)]);
        return ['user' => $data[0], 'img' => getImage($id)];
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database connection error: ' . $e->getMessage()]);
    }
}
if (isset($_SESSION['id'])) {
    echo getUser('json');
} else {
    echo json_encode(['error' => 'authorization problem']);
}
