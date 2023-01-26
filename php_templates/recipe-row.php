<div class="recipe-row">
    <?php 
        foreach ($products as $recipe) {
            echo '<a href="./recipe.php?id=' . $recipe['RecipeID'] . '"' . 'class="recipe-card">
            <img class="card-image">
            <h2>' . $recipe['RecipeName'] . '</h2>
            <h3>' . $recipe['Ingredients'] . '</h3></a>';
        }
    ?>

    <div class="fade-out"></div>
</div>