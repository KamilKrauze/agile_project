<div class="recipe-row">
    <?php 
        foreach ($products as $recipe) {
            echo '<a href="./recipe.php?id=' . $recipe['RecipeID'] . '"' . 'class="recipe-card">
            '.'<img src="./media/img/recipes/'. $recipe['RecipeID']. '.jpg" ' . 'alt="a picture of ' . $recipe['RecipeName'] . '" '.'class="card-image">
            <h2>' . $recipe['RecipeName'] . '</h2>
            <h3>' . $recipe['Ingredients'] . '</h3></a>';
        }
    ?>

    <div class="fade-out"></div>
</div>