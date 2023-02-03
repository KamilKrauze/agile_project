<?php
include '../config/database.php';
/*
function send_recipe($rn, $sd, $pt, $ct, $s, $i){
    $sendRecipe = $pdo->prepare("INSERT INTO recipes (RecipeName, ShortDesc, PrepTime, CookTime, TotalTime, Servings, Instructions) VALUES (?,?,?,?,?,?,?);");
    $sendRecipe->bindParam(1, $rn, PDO::PARAM_STR);
    $sendRecipe->bindParam(2, $sd, PDO::PARAM_STR);
    $sendRecipe->bindParam(3, $pt, PDO::PARAM_INT);
    $sendRecipe->bindParam(4, $ct, PDO::PARAM_INT);
    $tt = $pt +$ct;
    $sendRecipe->bindParam(5, $tt, PDO::PARAM_INT);
    $sendRecipe->bindParam(6, $s, PDO::PARAM_INT);
    $sendRecipe->bindParam(7, $i, PDO::PARAM_STR);
    $sendRecipe->execute();
}

function send_recipeingredients($rn, $is, $m, $q){
    $getRecipeID = $pdo->prepare("SELECT recipeID FROM Recipes WHERE recipeName = ?;");
    $getRecipeID->bindParam(1, $rn, PDO::PARAM_STR); 
    $getRecipeID->execute();

    foreach($is as $ingredient){
        $getIngredientID = $pdo->prepare("SELECT ingredientID FROM Ingredients WHERE IngredientName = ?;");
        $getIngredientID->bindParam(1, $ingredient, PDO::PARAM_STR); 
        $getIngredientID->execute();
        $sendRecipeIngredient = $pdo->prepare("INSERT INTO recipeIngredients (RecipeID, IngredientID, measurement, quantity) VALUES (?,?,?,?);");
        $sendRecipeIngredient->bindParam(1, $ri, PDO::PARAM_INT);
        $sendRecipeIngredient->bindParam(2, $getIngredientID->fetch()["ingredientID"], PDO::PARAM_INT);
        $sendRecipeIngredient->bindParam(3, $m, PDO::PARAM_INT);
        $sendRecipeIngredient->bindParam(4, $q, PDO::PARAM_INT);
        $sendRecipeIngredient->execute();
    }
}
*/
if(isset($_POST["submitted"])){
    if($_POST["submitted"] == "submit"){
        if(isset($_POST["an"]) AND isset($_POST["sd"])){
            $sendAllergen = $pdo->prepare("INSERT INTO allergens (AllergenName, ShortDesc) VALUES (?,?);");
            $sendAllergen->bindParam(1, $_POST["an"], PDO::PARAM_STR);
            $sendAllergen->bindParam(2, $_POST["sd"], PDO::PARAM_STR);
            $sendAllergen->execute();
            include "search.php";
        }
        else if(isset($_POST["sn"]) AND isset($_POST["aid"]) AND isset($_POST["sl"])){
            //send_spice($_POST["sn"], $_POST["aid"], $_POST["sl"]);
            $sendSpice = $pdo->prepare("INSERT INTO ingredients (IngredientName, AllergenID, ShopLink, isSpice) VALUES (?,?,?,1);");
            $sendSpice->bindParam(1, $_POST["sn"], PDO::PARAM_STR);
            $sendSpice->bindParam(2, $_POST["aid"], PDO::PARAM_INT);
            $sendSpice->bindParam(3, $_POST["sl"], PDO::PARAM_STR);
            $sendSpice->execute();
            include "search.php";
        }
        else if(isset($_POST["in"]) AND isset($_POST["aid"]) AND isset($_POST["sl"])){
            $sendIngredient = $pdo->prepare("INSERT INTO ingredients (IngredientName, AllergenID, ShopLink, isSpice) VALUES (?,?,?,0);");
            $sendIngredient->bindParam(1, $_POST["in"], PDO::PARAM_STR);
            $sendIngredient->bindParam(2, $_POST["aid"], PDO::PARAM_INT);
            $sendIngredient->bindParam(3, $_POST["sl"], PDO::PARAM_STR);
            $sendIngredient->execute();
            include "search.php";
        }
        else if(isset($_POST["rn"]) AND isset($_POST["sd"]) AND isset($_POST["pt"]) AND isset($_POST["ct"]) /*AND isset($_POST["s"])*/){
            $sendRecipe = $pdo->prepare("INSERT INTO recipes (RecipeName, ShortDesc, PrepTime, CookTime, TotalTime, Servings) VALUES (?,?,?,?,?,?);");
            $sendRecipe->bindParam(1, $_POST["rn"], PDO::PARAM_STR);
            $sendRecipe->bindParam(2, $_POST["sd"], PDO::PARAM_STR);
            $sendRecipe->bindParam(3, $_POST["pt"], PDO::PARAM_INT);
            $sendRecipe->bindParam(4, $_POST["ct"], PDO::PARAM_INT);
            $tt = (int)$_POST["pt"] + (int)$_POST["ct"];
            $sendRecipe->bindParam(5, $tt, PDO::PARAM_INT);
            $sendRecipe->bindParam(6, $_POST["s"], PDO::PARAM_INT);
            $sendRecipe->execute();   

            $getRecipeID = $pdo->prepare("SELECT recipeID FROM Recipes WHERE RecipeName = ?;");
            $getRecipeID->bindParam(1, $_POST["rn"], PDO::PARAM_STR);
            $getRecipeID->execute(); 
            $item_id = $getRecipeID->fetch()['RecipeID'];
            echo $item_id;  
            $item_type = "Recipe";
            $op_type = "edit";
            include "modify.php"; 
        }
        else{ echo 'oh no nothings working ;,(';}
    }
    else{
        include "search.php";
    }
}
else{
    //how did u get here >:0
}
?>