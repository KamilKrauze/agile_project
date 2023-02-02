<div class="recipe-row">
    <?php 
        foreach ($products as $recipe) {
            $imgpath = './media/img/recipes/'.$recipe['RecipeID'].'.jpg';
            if (!file_exists($imgpath)){
                $imgpath = './media/img/littleGreenLogo_180x.avif';
            }

            echo '<a href="./recipe.php?id=' . $recipe['RecipeID'] . '"' . 'class="recipe-card">
            '.'<img src="' . $imgpath. '" alt="a picture of ' . $recipe['RecipeName'] . '" '.'class="card-image">
            <h2>' . $recipe['RecipeName'] . '</h2>
            <h3>' . $recipe['Ingredients'] . '</h3></a>';
        }
    ?>

    <div class="fade-out"></div>
</div>


