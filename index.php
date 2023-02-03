<!DOCTYPE html>

<?php include 'header.php';?>

<head> 
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <!-- Main container -->
    <div class="main-body">
    
    <div class="featured-recipe-list basic-flex flex-column">
        <h1>Popular recipes</h1>
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
    
    <div class="filtering-recipes basic-flex" style="">
        <a class="anchor" id="for-you"></a>
        <div class="ingredients-selector basic-flex flex-column">
            <h1>Recipes <i>for you</i></h1>
            <h4>Tell us what Little Green Larder ingredients you have:</h4>
            
            <div class="flex-buttons-container scroller">
            <?php
                $ingredients = $_GET;
                $stmt = $pdo->prepare("SELECT IngredientName, Ingredients.IngredientID FROM recipeIngredients JOIN Ingredients on Ingredients.IngredientID=RecipeIngredients.IngredientID WHERE Ingredients.isSpice=0 GROUP BY IngredientID ORDER BY COUNT(RecipeIngredients.IngredientID) DESC;");
                $stmt->execute();
                $ingredients_names = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($ingredients_names as $ingr_row) {
                    if (in_array($ingr_row['IngredientID'], $ingredients)) {
                        include 'php_templates/checkbox.php';
                    }
                }
                foreach ($ingredients_names as $ingr_row) {
                    if (!in_array($ingr_row['IngredientID'], $ingredients)) {
                        include 'php_templates/checkbox.php';
                    }
                }
            ?>
            </div>

            <h4>Anything to exclude?</h4>

            <div class="flex-buttons-container">
            <?php
                $stmt = $pdo->prepare("SELECT AllergenID, AllergenName FROM Allergens WHERE AllergenName != 'None';");
                $stmt->execute();
                $allergens_names = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($allergens_names as $ingr_row) {
                    include 'php_templates/checkbox.php';
                }
            ?>
            </div>

            <h4>Any seasonal preferences?</h4>

            <div class="flex-buttons-container">
            <?php
                $stmt = $pdo->prepare("SELECT SeasonID, SeasonName from Seasons;");
                $stmt->execute();
                $seasons_names = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($seasons_names as $ingr_row) {
                    include 'php_templates/checkbox.php';
                }
            ?>
            </div>
        </div>

        <div class="suggestions basic-flex flex-column">
            <?php
                // Refresh $products based on user's selected ingredients

                $allergens = preg_grep('/^allergen\d*/', $ingredients);
                $seasons = preg_grep('/^season\d*/', $ingredients);
                $actual_ingredients = array_diff($ingredients, array_merge($allergens, $seasons));

                $allergens = preg_filter('/^allergen(\d*)/', '$1', $allergens);
                $seasons = preg_filter('/^season(\d*)/', '$1', $seasons);

                if (empty($actual_ingredients)) {
                    echo '<div class="recipe-row"> <h2>Select any ingredients to get suggested recipes </h2></div>';
                } else {
                    $select_query = "SELECT RecipeName, Recipes.RecipeID FROM Recipes";

                    if (!empty($seasons)) {
                        $select_query .= " JOIN RecipeSeasonal ON Recipes.RecipeID=RecipeSeasonal.RecipeID WHERE SeasonID IN (" .
                        implode(', ', array_fill(0, count($seasons), '?')) . ') AND Recipes.RecipeID IN ';
                    } else {
                        $select_query .= " WHERE RecipeID IN ";
                    }
                    
                    $select_query .= implode(' AND Recipes.RecipeID IN ', array_fill(0, count($actual_ingredients), '(SELECT RecipeID FROM RecipeIngredients WHERE IngredientID = ?)'));
                    
                    if (!empty($allergens)) {
                        $select_query .= ' AND Recipes.RecipeID NOT IN (SELECT DISTINCT recipeid FROM RecipeIngredients ' . 
                        'WHERE IngredientID IN (SELECT Ingredients.IngredientID FROM RecipeIngredients ' . 
                        'JOIN Ingredients ON Ingredients.IngredientID=RecipeIngredients.IngredientID WHERE AllergenID IN (' .
                        implode(', ', array_fill(0, count($allergens), '?')) . ')))';
                    }

                    $select_query .= ";";

                    $stmt = $pdo->prepare($select_query);
                    
                    try {
                        $stmt->execute(array_merge($seasons, $actual_ingredients, $allergens));
                    } catch(Exception $e) {
                        print_r("<br>Error encountered, with SQL statement '" . $select_query . "'<br>Message: " . $e->getMessage());
                    }
                    
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (empty($products)) {
                        echo '<div class="recipe-row" style="justify-items:center"><h2>No recipes with these filters :(</h2></div>';
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
                <h2>WIP // maybe something you can cook with ONLY selected ingredients if possible?</h1>
                <div class="basic-flex flex-column flex-end flex-small">
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php include './footer.php';?>

</body>
