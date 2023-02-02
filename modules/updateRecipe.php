
<?php
include '../config/database.php';
//header("location: ../admin/modify.php");
if(isset($_POST["modifyRecipe"]) && isset($_POST['recipeName'])){
    echo $_POST['recipeName'] . '<br>';
    echo $_POST['recipeInstructions'] . '<br>';
    echo $_POST['recipeID'] . '<br>';
    
    //header("location: ../admin/modify.php");

    $update_recipe = "UPDATE recipes SET RecipeName = :name, Instructions = :desc WHERE RecipeID = :id";
    $stmt = $pdo->prepare($update_recipe);
    $stmt->bindParam(':name', $_POST['recipeName'], PDO::PARAM_STR);
    $stmt->bindParam(':desc', $_POST['recipeInstructions'], PDO::PARAM_STR);
    $stmt->bindParam(':id', $_POST['recipeID'], PDO::PARAM_STR);
    $stmt->execute();
    $i = 0;
    while(isset($_POST["ingredientID-".(string)$i])){
        $selectExisting = "SELECT COUNT(ingredientName) FROM v_ingredients_to_recipe WHERE (RecipeID = ? AND ingredientName =  (SELECT IngredientName FROM ingredients WHERE IngredientID = ?))";
        $compareExisting = $pdo->prepare($selectExisting);
        $compareExisting->execute([$_POST['recipeID'],$_POST['ingredientID-'.(string)$i]]);
        if($compareExisting->fetch() == 0){
            $insertIngredient = "INSERT INTO recipeingredients (RecipeID, IngredientID ,Quantity, measurementID) VALUES (?,?,?,(SELECT measurementID FROM measurements WHERE measurementType = ?))";
            $isertingNew = $pdo->prepare($insertIngredient);
            $isertingNew->execute([$_POST['recipeID'], $_POST['ingredientID-' . (string) $i], $_POST['ingredientQuantity-' . (string) $i], $_POST['ingredientMeasurement-' . (string) $i]]);
        }elseif($compareExisting->fetch() == 1){
            $update_Ingredients = "UPDATE v_ingredients_to_recipe SET Quantity = ?, measurementType = ?, allergenName = ? WHERE RecipeID = ?";
            $update_Ingr = $pdo->prepare($update_Ingredients);
            $update_Ingr->execute([$_POST['ingredientQuantity-'.(string)$i], $_POST['ingredientMeasurement-'.(string)$i],$_POST['ingredientAllergen-'.(string)$i]]);
        }
        
        $i++;
    }
    $i = 0;
}
?>