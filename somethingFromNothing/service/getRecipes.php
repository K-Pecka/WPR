<?php
$config = json_decode(file_get_contents('../config/config.json'));


try {
    $pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query =
        'SELECT `recipe`.`id`,`name` as "title",`image`,SUBSTRING(`recipe`.`description`,1,250) as "description",FLOOR(AVG(`rating`)) as "rating",COUNT(*) as "review", SUM(`time`) as "time" FROM `recipe` JOIN `rating` ON `recipe`.`id`=`rating`.`id_recipe` LEFT JOIN `preparation` ON `recipe`.`id`=`preparation`.`id_recipe` GROUP BY `recipe`.`id`';

    $statement = $pdo->query($query);
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($data);

    header('Content-Type: application/json');
    echo $json;
} catch (PDOException $e) {
    // Obsługa błędów
    echo "{}";
    //echo "Błąd połączenia z bazą danych: " . $e->getMessage();
}
