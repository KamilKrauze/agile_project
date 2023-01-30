<!DOCTYPE html>

<?php
    $ingredients = $_POST['ingredientSelection'];
    if(empty($ingredients)) 
    {
        // echo("You didn't select any ingredients.");
    } 
    else 
    {
        $query_result = http_build_query($ingredients);  
        header('Location: '. $_SERVER['PHP_SELF'] . '?' . $query_result . '#for-you');
    }

    $ingredients = $_GET;
?>

<?php include 'header.php';?>

<head> 
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <!-- Main container -->
    <div class="main-body">
    
    <div class="featured-recipe-list basic-flex flex-column">
        <h1>List of recipes</h1>
        <?php
            $stmt = $pdo->prepare("SELECT RecipeID, RecipeName FROM recipes ORDER BY numberOfViews DESC;");
        
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($products as &$row) {
                $ingredients_stmt = $pdo->prepare("SELECT IngredientName FROM Ingredients JOIN recipeIngredients ON Ingredients.IngredientID = recipeIngredients.IngredientID WHERE RecipeID = :RecipeID;");
                $ingredients_stmt->bindValue(":RecipeID", $row['RecipeID']);
                $ingredients_stmt->execute();
                $ingredients_result = $ingredients_stmt->fetchAll(PDO::FETCH_ASSOC);
                $row['Ingredients']=implode(", ", array_map(function($x) {return $x['IngredientName'];}, $ingredients_result));
            }
            include 'php_templates/recipe-row.php';
        ?>
    </div>
    
    <form action="" class="filtering-recipes basic-flex" style="" method="POST">
        <a class="anchor" id="for-you"></a>
        <div class="ingredients-selector basic-flex flex-column">
            <h1>Recipes <i>for you</i></h1>
            <h4>Tell us what Little Green Larder ingredients you have:</h4>
            
            <div class="flex-buttons-container scroller">
            <?php
            $stmt = $pdo->prepare("SELECT IngredientID, IngredientName FROM Ingredients;");
            $stmt->execute();
            $ingredients_names = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($ingredients_names as $ingr_row) {
                include 'php_templates/checkbox.php';
            }
            ?>
            </div>

            <h4>Any other ingredients?</h4>
            <h4>Anything to exclude?</h4>
        </div>

        <div class="suggestions basic-flex flex-column">
            <?php
                // Refresh $products based on user's selected ingredients
                if (empty($ingredients)) {
                    echo '<div class="recipe-row"> <h2>Select any ingredients to get suggested recipes </h2></div>';
                } else {
                    $select_query = "SELECT RecipeName, Recipes.RecipeID FROM Recipes JOIN (" . 
                    implode('<br>INTERSECT <br>', array_fill(0, count($ingredients), 'SELECT RecipeID FROM RecipeIngredients WHERE IngredientID = ?')) . 
                    ") r ON Recipes.RecipeID=r.RecipeID;";

                    $stmt = $pdo->prepare($select_query);
                    $stmt->execute($ingredients);
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if (empty($products)) {
                        echo '<div class="recipe-row"><center><h2>No recipes with these ingredients :(</h2></center></div>';
                    } else {
                        foreach ($products as &$row) {
                            $ingredients_stmt = $pdo->prepare("SELECT IngredientName FROM Ingredients JOIN recipeIngredients ON Ingredients.IngredientID = recipeIngredients.IngredientID WHERE RecipeID = :RecipeID;");
                            $ingredients_stmt->bindValue(":RecipeID", $row['RecipeID']);
                            $ingredients_stmt->execute();
                            $ingredients_result = $ingredients_stmt->fetchAll(PDO::FETCH_ASSOC);
                            $row['Ingredients']=implode(", ", array_map(function($x) {return $x['IngredientName'];}, $ingredients_result));
                        }

                        include 'php_templates/recipe-row.php';
                    }
                }
            ?>
            <div class="additional-ingredients basic-flex flex-column">
                <h2>Suggested ingredients</h1>
                <div class="basic-flex flex-column flex-end flex-small">
                    <div class="basic-flex flex-small">
                        <h5>7 more recipes unlocked with</h5>
                        <div class="flex-buttons-container">
                        <?php
                            $dontgrow = true; $name = 'Potato';
                            include 'php_templates/checkbox.php';
                            $dontgrow = true; $name = 'Tomato';
                            include 'php_templates/checkbox.php';
                        ?>
                        </div>
                    </div>
                    <div class="basic-flex flex-small">
                        <h5>5 more with</h5>
                        <div class="flex-buttons-container">
                        <?php
                            $dontgrow = true; $name = 'Raisins';
                            include 'php_templates/checkbox.php';
                        ?>
                        </div>
                    </div>
                    <div class="basic-flex flex-small">
                        <h5>2 more with</h5>
                        <div class="flex-buttons-container">
                        <?php
                            $dontgrow = true; $name = 'Rice';
                            include 'php_templates/checkbox.php';
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>

    <?php include './footer.php';?>

</body>
