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

<body>
    <?php include 'header.php';?>

    <!-- Main container -->
    <div class="main-body">
    
    <div class="featured-recipe-list basic-flex flex-column">
        <h1>List of recipes</h1>
        <?php include 'php_templates/recipe-row.php';?>
    </div>
    
    <form action="" class="filtering-recipes basic-flex"  style="padding:32px 16px;" method="POST">
        <a class="anchor" id="for-you"></a>
        <div class="ingredients-selector basic-flex flex-column">
            <h1>Recipes <i>for you</i></h1>
            <h4>Tell us what Little Green Larder ingredients you have:</h4>
            
            <div class="flex-buttons-container">
            <?php
            $name = 'Tomato';
            include 'php_templates/checkbox.php';
            
            $name = 'Cucumber';
            include 'php_templates/checkbox.php';

            $name = 'Spaghetti';
            include 'php_templates/checkbox.php';

            $name = 'Rice';
            include 'php_templates/checkbox.php';

            $name = 'Chickpeas';
            include 'php_templates/checkbox.php';

            $name = 'Organic Bulgur Wheat';
            include 'php_templates/checkbox.php';

            $name = 'Sweet Potato';
            include 'php_templates/checkbox.php';

            $name = 'Green Lentils';
            include 'php_templates/checkbox.php';

            $name = 'Raisins';
            include 'php_templates/checkbox.php';

            $name = 'Potato';
            include 'php_templates/checkbox.php';

            $name = 'Whole Wheat Pasta Organic';
            include 'php_templates/checkbox.php';
            ?>
            </div>

            <h4>Any other ingredients?</h4>
            <h4>Anything to exclude?</h4>
        </div>

        <div class="suggestions basic-flex flex-column">
            <?php include 'php_templates/recipe-row.php';?>
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

    <?php include 'footer.php';?>
    </div>

</body>
