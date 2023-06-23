<?php
require_once '../../module/photo.php';
$config = json_decode(file_get_contents('../../config/config.json'));

class Recipe
{
    private $title;
    private $time;
    private $image;
    private $description;
    private $rating;
    private $review;
    private $favorite;
    private $preparations;
    private $ingredients;

    public function __construct($title, $time, $image, $description, $rating, $review, $favorite, $preparations, $ingredients)
    {
        $this->title = $title;
        $this->time = $time;
        $this->image = $image;
        $this->description = $description;
        $this->rating = $rating;
        $this->review = $review;
        $this->favorite = $favorite;
        $this->preparations = $preparations;
        $this->ingredients = $ingredients;
    }

    public function getPreparations()
    {
        return array_map(function ($preparation) {
            return $preparation->get();
        }, $this->preparations);
    }

    public function get()
    {
        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'image' => $this->image,
            'description' => $this->description,
            'rating' => $this->rating,
            'review' => $this->review,
            'favorite' => $this->favorite,
            'ingredients' => $this->ingredients,
            'preparations' => $this->getPreparations()
        ];

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
        return [
            'description' => $this->description,
            'time' => $this->time
        ];
    }
}

try {
    $pdo = new PDO(
        "mysql:host={$config->database->host};dbname={$config->database->db};port={$config->database->port};charset=utf8",
        $config->database->name,
        $config->database->pass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET['id_recipe'] ?? 10;

    $query = '
        SELECT r.`id`,r.`name` as "title", SUBSTRING(r.`description`, 1, 1000) as "description",
               FLOOR(AVG(rt.`rating`)) as "rating", COUNT(rt.`rating`) as "review", SUM(p.`time`) as "time"
        FROM `recipe` r
        LEFT JOIN `rating` rt ON r.`id` = rt.`id_recipe`
        LEFT JOIN `preparation` p ON r.`id` = p.`id_recipe`
        WHERE r.`id` = :id
        GROUP BY r.`id`
    ';

    $statement = $pdo->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo json_encode(['error' => 'Recipe not found']);
        exit();
    }

    $query = '
        SELECT i.`name`, u.`name` as "unit", ir.`value`
        FROM `ingredient_for_recipe` ir
        JOIN `ingredient` i ON ir.`id_ingredient` = i.`id`
        JOIN `unite` u ON i.`unite` = u.`id`
        WHERE ir.`id_recipe` = :id
    ';

    $statement = $pdo->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $ingredients = $statement->fetchAll(PDO::FETCH_ASSOC);

    $ingredientsArray = array_map(function ($ingredient) {
        return [
            'name' => $ingredient['name'],
            'unit' => $ingredient['unit'],
            'value' => $ingredient['value']
        ];
    }, $ingredients);

    if (empty($ingredientsArray)) {
        $ingredientsArray[] = [
            'name' => 'Not found',
            'unit' => 'N/A',
            'value' => 'N/A'
        ];
    }

    $preparations = $pdo->prepare('
        SELECT p.`time`, p.`description`
        FROM `preparation` p
        WHERE p.`id_recipe` = :id
        ORDER BY p.`no` ASC
    ');

    $preparations->bindValue(':id', $id, PDO::PARAM_INT);
    $preparations->execute();
    $preparations = $preparations->fetchAll(PDO::FETCH_ASSOC);

    $preparationsArray = array_map(function ($preparation) {
        return new Preparation($preparation['description'], $preparation['time']);
    }, $preparations);

    if (empty($preparationsArray)) {
        $preparationsArray[] = new Preparation("Not found", 0);
    }

    $recipe = new Recipe(
        $data['title'],
        $data['time'],
        getPhoto('../../data/recipe.csv', $data['id'], 'random.jpg'),
        $data['description'],
        $data['rating'],
        $data['review'],
        false,
        $preparationsArray,
        $ingredientsArray // Zaktualizowano zmienną na $ingredientsArray
    );

    header('Content-Type: application/json');
    echo $recipe->get();
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection error: ' . $e->getMessage()]);
}
