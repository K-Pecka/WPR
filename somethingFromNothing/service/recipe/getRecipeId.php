<?php
$config = json_decode(file_get_contents('../../config/config.json'));
class Recipe
{
    private $title;
    private $time;
    private $image;
    private $description;
    private $rating;
    private $favorite;
    private $preparations;
    private $ingridients;
    private $review;

    public function __construct($title, $time, $image, $description, $rating, $review, $favorite, $preparations, $ingridients)
    {
        $this->title = $title;
        $this->time = $time;
        $this->image = $image;
        $this->description = $description;
        $this->rating = $rating;
        $this->review = $review;
        $this->favorite = $favorite;
        $this->preparations = $preparations;
        $this->ingridients = $ingridients;
    }
    public function getPreparations()
    {
        $preparationsData = array();
        foreach ($this->preparations as $preparation) {
            $preparationsData[] = $preparation->get();
        }
        return $preparationsData;
    }
    public function get()
    {
        $data = array(
            'title' => $this->title,
            'time' => $this->time,
            'image' => $this->image,
            'description' => $this->description,
            'rating' => $this->rating,
            'review' => $this->review,
            'favorite' => $this->favorite,
            'ingridients' => $this->ingridients,
            'preparations' => $this->getPreparations()
        );

        return json_encode($data);
    }
}

class Preparation
{
    private $description;
    private $time;

    public function __construct($description, $time)
    {
        $this->description = $description;
        $this->time = $time;
    }
    public function get()
    {
        $data = array(
            'description' => $this->description,
            'time' => $this->time,
        );

        return $data;
    }
}


try {
    $pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = isset($_GET['id_recipe']) ? $_GET['id_recipe'] : 10;
    $query =
        'SELECT `name` as "title", `image`, SUBSTRING(`recipe`.`description`, 1, 1000) as "description", FLOOR(AVG(`rating`)) as "rating", COUNT(*) as "review", SUM(`time`) as "time"
        FROM `recipe`
        JOIN `rating` ON `recipe`.`id` = `rating`.`id_recipe`
        JOIN `preparation` ON `recipe`.`id` = `preparation`.`id_recipe`
        WHERE `recipe`.`id` = :id
        GROUP BY `recipe`.`id`';

    $statement = $pdo->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);

    $query = 'SELECT `name` FROM `ingredient_for_recipe` JOIN `ingredient` ON `ingredient_for_recipe`.`id_ingredient`=`ingredient`.`id` WHERE `id_recipe` = :id';
    $statement = $pdo->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $ingridients = $statement->fetchAll(PDO::FETCH_ASSOC);

    $query = 'SELECT `time`,`description` FROM `preparation` WHERE `preparation`.`id_recipe`=:id ORDER BY `no` ASC';
    $statement = $pdo->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $preparations = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!$data || !$ingridients || !$preparations) {
        echo json_encode(['error' => 'Recipe not found']);
        exit();
    }
    foreach ($ingridients as $ingridient) {
        $ingridientsArray[] = $ingridient['name'];
    }
    foreach ($preparations as $preparation) {
        if (is_array($preparation) && isset($preparation['description']) && isset($preparation['time'])) {
            $preparationsArray[] = new Preparation($preparation['description'], $preparation['time']);
        } else {
            var_dump($preparation);
        }
    }

    $recipe = new Recipe($data['title'], $data['time'], $data['image'], $data['description'], $data['rating'], $data['review'], false, $preparationsArray, $ingridientsArray);

    header('Content-Type: application/json');

    echo $recipe->get();
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection error: ' . $e->getMessage()]);
}
