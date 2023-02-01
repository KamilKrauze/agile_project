<?php
    include '../config/database.php';
    if(isset($_GET['rid'])) {
        $rid = $_GET['rid'];
        $dfr = $pdo->prepare("DELETE FROM Recipes WHERE RecipeID=?");
        $dfr->bindParam(1, $rid, PDO::PARAM_INT);
        $dfr->execute();

        $dfr = $pdo->prepare("DELETE FROM recipeingredients WHERE RecipeID=?");
        $dfr->bindParam(1, $rid, PDO::PARAM_INT);
        $dfr->execute();

        include "search.php";
    }
    else if(isset($_GET['iid'])) {
        $iid = $_GET['iid'];
        $dfr = $pdo->prepare("DELETE FROM ingredients WHERE ingredientID=?");
        $dfr->bindParam(1, $iid, PDO::PARAM_INT);
        $dfr->execute();

        $dfr = $pdo->prepare("DELETE FROM recipeingredients WHERE ingredientID=?");
        $dfr->bindParam(1, $iid, PDO::PARAM_INT);
        $dfr->execute();

        include "search.php";
    }
    else{
        //no id wompwomp:(
        include "search.php";
    }
?>
