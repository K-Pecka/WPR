<?php
session_start();
require_once '../../module/photo.php';
$config = json_decode(file_get_contents("../../config/config.json"));
try {
    $pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $where = 'WHERE `s`.`name` = "public"';

    if (isset($_GET['phrase']))
        $where .= 'AND `recipe`.`name` LIKE "%' . $_GET['phrase'] . '%" OR `recipe`.`description` LIKE "%' . $_GET['phrase'] . '%"';
    else if (isset($_GET['status'])) $where = 'WHERE `r`.`id_user` = "' . $_SESSION['id'] . '"';
    else if (isset($_GET['favorite'])) $where = 'WHERE `f`.`id_user` = "' . $_SESSION['id'] . '"';

    $query =
        'SELECT `r`.`accepted`,`r`.`id`,`r`.`name` as "title",SUBSTRING(`r`.`description`,1,250) as "description",`p`.`time`,SUM(`time`) "time",FLOOR(AVG(`rg`.`rating`)) as "review"
        FROM `recipe` as `r`
        LEFT JOIN `status` as `s` ON `r`.`status`=`s`.`id`
        LEFT JOIN `preparation` as `p` ON `r`.`id`=`p`.`id_recipe`
        LEFT JOIN `rating` as `rg` ON `rg`.`id_recipe`=`r`.`id`
        LEFT JOIN `favorite_recipe` as `f` ON `r`.`id` = `f`.`id_recipe`
        ' . $where . '
        GROUP BY `r`.`id`';
    $statement = $pdo->query($query);
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as &$row) {
        $row['image'] = getPhoto('../../data/recipe.csv', $row['id'], 'random.jpg');
    }
    $json = json_encode($data);

    header('Content-Type: application/json');
    echo $json;
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection error: ' . $e->getMessage()]);
}
