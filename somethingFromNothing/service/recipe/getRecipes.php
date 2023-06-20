<?php
session_start();
$config = json_decode(file_get_contents("../../config/config.json"));
try {
    $pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $where = 'WHERE `status`.`name` = "public"';

    if (isset($_GET['phrase']))
        $where .= 'AND `recipe`.`name` LIKE "%' . $_GET['phrase'] . '%" OR `recipe`.`description` LIKE "%' . $_GET['phrase'] . '%"';
    else if (isset($_GET['status'])) $where = 'WHERE `recipe`.`id_user` = "' . $_SESSION['id'] . '"';
    else if (isset($_GET['favorite'])) $where = 'WHERE `favorite_recipe`.`id_user` = "' . $_SESSION['id'] . '"';

    $query =
        'SELECT `recipe`.`id`,`recipe`.`name` as "title",`image`,SUBSTRING(`recipe`.`description`,1,250) as "description",FLOOR(AVG(`rating`)) as "rating",COUNT(*) as "review", SUM(`time`) as "time",`favorite_recipe`.`id_user` 
        FROM `favorite_recipe` 
        RIGHT JOIN `recipe` ON `favorite_recipe`.`id_recipe` = `recipe`.`id`
        JOIN `status` ON `status`.`id` = `recipe`.`status`
        LEFT JOIN `preparation` ON `preparation`.`id_recipe` = `recipe`.`id` 
        JOIN `rating` ON `recipe`.`id`=`rating`.`id_recipe`
        ' . $where . '
        GROUP BY `recipe`.`id`';
    $statement = $pdo->query($query);
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($data);

    header('Content-Type: application/json');
    echo $json;
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection error: ' . $e->getMessage()]);
}
