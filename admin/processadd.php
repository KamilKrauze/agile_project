<?php
include '../config/database.php';

if(isset($_POST["submitted"])){
    if($_POST["submitted"] == "submit"){
        if(isset($_POST["an"]) AND isset($_POST["sd"])){
            $sendAllergen = $pdo->prepare("INSERT INTO allergens (AllergenName, ShortDesc) VALUES (?,?);");
            $sendAllergen->bindParam(1, $_POST["an"], PDO::PARAM_STR);
            $sendAllergen->bindParam(2, $_POST["sd"], PDO::PARAM_STR);
            $sendAllergen->execute();
            header("Location: ./search.php", true, 301);
            exit();
        }
        else if(isset($_POST["sn"]) AND isset($_POST["aid"]) AND isset($_POST["sl"])){
            //send_spice($_POST["sn"], $_POST["aid"], $_POST["sl"]);
            $sendSpice = $pdo->prepare("INSERT INTO ingredients (IngredientName, AllergenID, ShopLink, isSpice) VALUES (?,?,?,1);");
            $sendSpice->bindParam(1, $_POST["sn"], PDO::PARAM_STR);
            $sendSpice->bindParam(2, $_POST["aid"], PDO::PARAM_INT);
            $sendSpice->bindParam(3, $_POST["sl"], PDO::PARAM_STR);
            $sendSpice->execute();
            header("Location: ./search.php", true, 301);
            exit();
        }
        else if(isset($_POST["in"]) AND isset($_POST["aid"]) AND isset($_POST["sl"])){
            $sendIngredient = $pdo->prepare("INSERT INTO ingredients (IngredientName, AllergenID, ShopLink, isSpice) VALUES (?,?,?,0);");
            $sendIngredient->bindParam(1, $_POST["in"], PDO::PARAM_STR);
            $sendIngredient->bindParam(2, $_POST["aid"], PDO::PARAM_INT);
            $sendIngredient->bindParam(3, $_POST["sl"], PDO::PARAM_STR);
            $sendIngredient->execute();
            header("Location: ./search.php", true, 301);
            exit();
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

            // $getRecipeID = $pdo->prepare("SELECT RecipeID FROM recipes WHERE RecipeName = ?;");
            // $getRecipeID->bindParam(1, $_POST["rn"], PDO::PARAM_STR);
            // $getRecipeID->execute(); 
            // $item_id = $getRecipeID->fetch()['RecipeID'];
            // $item_type = "Recipe";
            // $op_type = "edit";
            header("Location: ./search.php", true, 301);
            exit();
        }
        else{ echo 'oh no nothings working ;,(';}
    }
    else{
        header("Location: ./search.php", true, 301);
        exit();
    }
}
else{
    //how did u get here >:0
}
?>