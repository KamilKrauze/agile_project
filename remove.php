<?php
    include '../config/database.php';
    if(isset($_GET['id'])) {
        $rid = $_GET['id'];
        $dfr = $pdo->prepare("DELETE FROM Recipes WHERE RecipeID=?");
        $dfr->bindParam(1, $rid, PDO::PARAM_INT);
        $dfr->execute();

        $dfr = $pdo->prepare("DELETE FROM recipeingredients WHERE RecipeID=?");
        $dfr->bindParam(1, $rid, PDO::PARAM_INT);
        $dfr->execute();

        include "search.php";
    }
    else{
        //no id wompwomp:(
    }
?>
