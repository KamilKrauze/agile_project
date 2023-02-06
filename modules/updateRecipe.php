
<?php
include '../config/database.php';
//header("location: ../admin/modify.php");
if(isset($_POST["cancelChange"])){
    header("location: ../admin/search.php");
}
if (isset($_POST["modifyRecipe"]) && isset($_POST['recipeName'])) {

    $update_recipe = "UPDATE recipes SET RecipeName = :name, Instructions = :desc WHERE RecipeID = :id";
    $stmt = $pdo->prepare($update_recipe);
    $stmt->bindParam(':name', $_POST['recipeName'], PDO::PARAM_STR);
    $stmt->bindParam(':desc', $_POST['recipeInstructions'], PDO::PARAM_STR);
    $stmt->bindParam(':id', $_POST['recipeID'], PDO::PARAM_STR);
    $stmt->execute();
    $i = 0;
    $ingredientsExisting = array();
    while ($i < 50) {
        if(isset($_POST["ingredientID-" . (string) $i])){
            array_push($ingredientsExisting, $_POST['ingredientID-' . (string) $i]);
            $selectExisting = "SELECT COUNT(ingredientID) FROM recipeingredients WHERE (RecipeID = ? AND ingredientID = ?)";
            $compareExisting = $pdo->prepare($selectExisting);
            $compareExisting->execute([$_POST['recipeID'], $_POST['ingredientID-' . (string) $i]]);
            if ($compareExisting->fetch()[0] == 0) {
                $insertIngredient = "INSERT INTO recipeingredients (RecipeID, IngredientID, Quantity, measurementID) VALUES (?,?,?,(SELECT measurementID FROM measurements WHERE measurementType = ?))";
                $isertingNew = $pdo->prepare($insertIngredient);
                $isertingNew->execute([$_POST['recipeID'], (int)$_POST['ingredientID-' . (string) $i], $_POST['ingredientQuantity-' . (string) $i], $_POST['ingredientMeasurement-' . (string) $i]]);
            } else {
                $update_Ingredients = "UPDATE recipeingredients SET Quantity = ?, measurementID = (SELECT measurementID FROM measurements WHERE measurementType = ?) WHERE (RecipeID = ? AND IngredientID = ?)";
                $update_Ingr = $pdo->prepare($update_Ingredients);
                $update_Ingr->execute([$_POST['ingredientQuantity-' . (string) $i], $_POST['ingredientMeasurement-' . (string) $i],$_POST['recipeID'],$_POST["ingredientID-" . (string) $i]]);
            } 
        }else{
        }
        $i++;
    }
    $i = 0;
    $selectAllIngr = "SELECT IngredientID FROM recipeingredients WHERE RecipeID = ?";
    $selectIngredients = $pdo->prepare($selectAllIngr);
    $selectIngredients->execute([$_POST['recipeID']]);
    while($selectIngredientsToUpdate = $selectIngredients->fetch()){
        if(in_array($selectIngredientsToUpdate['IngredientID'],$ingredientsExisting) == false){
            $deleteIngredient = $pdo->prepare("DELETE FROM recipeingredients WHERE (IngredientID = ? AND RecipeID = ?)");
            $deleteIngredient->execute([$selectIngredientsToUpdate['IngredientID'], $_POST['recipeID']]);
        }
    }
    header("location: ../admin/search.php");
    exit();
    // $deleteZeros = $pdo->prepare("DELETE FROM recipeingredients WHERE IngredientID = 0");
    // $deleteZeros->execute(); 
    //$deleteIngredients = array_diff($ingredientsExisting, $selectIngredientsToUpdate);
    //var_dump($deleteIngredients);
}
?>