<?php
session_start();
$config = json_decode(file_get_contents('../../config/config.json'));

$data = json_decode($_POST['data']);

$pdo = new PDO("mysql:host=" . $config->database->host . ";dbname=" . $config->database->db . ";port=" . $config->database->port . ";charset=utf8", $config->database->name, $config->database->pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->beginTransaction();

try {
    $fileName = "";
    if (!empty($_FILES['file']['name'])) {
        require_once '../../module/photo.php';
        $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $fileName = $_SESSION['id'] . "_" . time() . "." . $fileExtension;
        $filePath = '../../image/public/recipe/' . $fileName;

        if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            throw new Exception('Failed to upload the file.');
        }
        addRecord("../../data/recipe.csv", date("Ymd"), $_SESSION['id'], $fileName);
    }

    $insertRecipeStatement = $pdo->prepare("INSERT INTO `recipe` (`name`, `description`, `id_user`, `status`) VALUES 
    (:title, :description, :user, 1)");
    $insertRecipeStatement->bindValue(':title', $data->title, PDO::PARAM_STR);
    $insertRecipeStatement->bindValue(':description', $data->description, PDO::PARAM_STR);
    $insertRecipeStatement->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);
    $insertRecipeStatement->execute();

    $idRecipe = $pdo->lastInsertId();

    $insertIngredients = [];
    $existingIngredients = [];

    foreach ($data->ingridents as $ingredient) {
        $lowercaseIngredientName = strtolower($ingredient->name);

        $selectIngredientStatement = $pdo->prepare("SELECT `id` FROM `ingredient` WHERE LOWER(`name`) = :name");
        $selectIngredientStatement->bindValue(':name', $lowercaseIngredientName, PDO::PARAM_STR);
        $selectIngredientStatement->execute();
        $existingIngredientId = $selectIngredientStatement->fetchColumn();

        if ($existingIngredientId) {
            $existingIngredients[] = $existingIngredientId;
        } else {
            $insertIngredientStatement = $pdo->prepare("INSERT INTO `ingredient` (`name`, `unite`) VALUES (:name, :unite)");
            $insertIngredientStatement->bindValue(':name', $lowercaseIngredientName, PDO::PARAM_STR);
            $insertIngredientStatement->bindValue(':unite', $ingredient->unite, PDO::PARAM_INT);
            $insertIngredientStatement->execute();
            $newIngredientId = $pdo->lastInsertId();
            $existingIngredients[] = $newIngredientId;
            $insertIngredients[] = [$idRecipe, $newIngredientId, $ingredient->unite, $ingredient->value];
        }
    }

    $insertIngredientsStatement = $pdo->prepare("INSERT INTO `ingredient_for_recipe` (`id_recipe`, `id_ingredient`, `unit_id`, `value`) VALUES (?, ?, ?, ?)");
    foreach ($insertIngredients as $ingredientValues) {
        $insertIngredientsStatement->execute($ingredientValues);
    }

    $insertPreparations = [];
    $preparationNo = 1;

    foreach ($data->preparations as $preparation) {
        $insertPreparations[] = [$idRecipe, $preparationNo++, $preparation->description, $preparation->time];
    }

    $insertPreparationsStatement = $pdo->prepare("INSERT INTO `preparation` (`id_recipe`, `no`, `description`, `time`) VALUES (?, ?, ?, ?)");
    foreach ($insertPreparations as $preparationValues) {
        $insertPreparationsStatement->execute($preparationValues);
    }

    $pdo->commit();

    $response = [
        'status' => true,
        'message' => 'Recipe added successfully. zostaniesz przekierowany na stronę główną za 5s'
    ];
} catch (Exception $e) {
    $pdo->rollBack();

    $response = [
        'success' => false,
        'message' => 'Error adding recipe: ' . $e->getMessage()
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
