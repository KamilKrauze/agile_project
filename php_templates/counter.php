<?php 
    //default recipe id set to 1
    if(isset($_GET['id'])) {
        $rid = $_GET['id'];
    }
    else{
        $rid = 1;
    }
    $findrv = $pdo->prepare("SELECT * FROM recipes WHERE RecipeID = ?");
    $findrv->bindParam(1, $rid, PDO::PARAM_INT);
    $findrv->execute();

    $recipeviews = $findrv->fetch(PDO::FETCH_ASSOC)['numberOfViews'];

    if(is_null($recipeviews)){
        $recipeviews = 1;
    } else{
        $recipeviews++;
    }

    $sendrv = $pdo->prepare("UPDATE recipes
                                SET numberOfViews = ?
                                WHERE RecipeID = ?;");
    $sendrv->bindParam(1, $recipeviews, PDO::PARAM_INT);
    $sendrv->bindParam(2, $rid, PDO::PARAM_INT);
    $sendrv->execute();

    echo '<h3 style="text-align:right; flex-grow: 1;">Views: ' . $recipeviews . '</h3>';
?>