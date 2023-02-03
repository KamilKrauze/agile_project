<?php
include '../config/database.php';

if (!isset($_POST['ingredient_name'])) {echo "CUSTOM_ERROR: Value could not be found";}

$ingredient_name = ucfirst($_POST['ingredient_name']);
try {
    $fetchIngredientByName = "SELECT IngredientID, IngredientName FROM ingredients WHERE IngredientName = :name";
    $stmt = $pdo->prepare($fetchIngredientByName);
    $stmt->bindParam(":name", $ingredient_name, PDO::PARAM_STR);
    $stmt->execute();

    $id = "";
    $name = "";

    while($row = $stmt->fetch()) {
        $id = $row['IngredientID'];
        $name = $row['IngredientName'];
    }

    if ($id == "" && $name == "") {
        echo json_encode(array('exists' => "false"));
    } else {
        echo json_encode(array('exists' => "true", 'id' => $id, 'name' => $name));
    }
}
catch (PDOException $exception) {
    echo $exception;
    die("ERROR: Could not prepare/execute query. \n{$exception->getMessage()}");
}

?>