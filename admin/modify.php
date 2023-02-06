<!DOCTYPE html>
<html lang="en">
<head>

<?php

error_reporting(E_ALL ^ E_WARNING);
$title = "Management"; // Page title text
$recipe_name = "";

include '../config/database.php';
session_start();
if ($_SESSION['loggedIn'] == "false") {
    header("Location: ./index.php", true, 301);
    exit();
}

$op_type;
$itemType;
$id;
if(isset($_SESSION['op_type']) && isset($_SESSION['item_type']) && isset($_SESSION['item_id'])) {
    $op_type = $_SESSION['op_type'];
    $itemType = $_SESSION['item_type'];
    $id = $_SESSION['item_id'];
}

function print_recipe_name() {
    global $op_type;
    global $item_id;
    global $item_type;
    global $pdo;
    if (!isset($op_type) || $op_type == "add" || !($op_type == "edit")) {return;}
    if($item_type == "Recipe"){
        $fetchRecipeName = "SELECT RecipeName FROM Recipes WHERE RecipeID = ?";
        $stmt = $pdo->prepare($fetchRecipeName);
        $stmt->execute([$item_id]);
        $recipe = $stmt->fetch();
        echo $recipe['RecipeName'];
    }
}

function print_recipe_desc() {}
try{
    $op_type = $_POST['op_type'];
    $item_id = $_POST['item_id'];
    $item_type = $_POST['item_type'];
    $_SESSION['recipe_ID'] = $_POST['item_id'];
}catch(ErrorException $e){

}
function print_description() {
    
    global $op_type;
    global $item_id;
    global $item_type;
    global $pdo;
    if (!isset($op_type) || $op_type == "add" || !($op_type == "edit")) {return;}
    if($item_type == "Recipe"){
        $fetchRecipe = "SELECT Instructions FROM Recipes WHERE RecipeID = ?";
        $stmt = $pdo->prepare($fetchRecipe);
        $stmt->execute([$item_id]);
        $recipe = $stmt->fetch();
        echo $recipe['Instructions'];
    }
}

function print_ingredients(){
    global $op_type;
    global $item_id;
    global $item_type;
    global $pdo;

    if (!isset($op_type) || $op_type == "add" || !($op_type == "edit")) {return;}
        $fetchIngredients = "SELECT IngredientName, Quantity, measurementType, AllergenName FROM v_Ingredients_to_recipe WHERE RecipeID = ?";
        $stmtFetch = $pdo->prepare($fetchIngredients);
        $stmtFetch->execute([$item_id]);
            $a = 0;
        $ids = fetchIngredientIDS();
        while($ingredient = $stmtFetch->fetch()){            
            echo
                '
                <tr class="ingredient" id=' . '"ingredient-' . $a . '">
                    <th class="property"><input type="hidden" name="ingredientID-'. $a . '" value="'. $ids[$a] . '">' . $ingredient['IngredientName'] . '</th>
                    <th><input class="quantity-input property" type="number" min="0" step="0.1" name="ingredientQuantity-' . $a . '"onkeypress="return event.keyCode != 13;" style="width:50%" value=' . $ingredient['Quantity'] . '></th>
                    <th>
                        <div class="input-group">
                            <select name = "ingredientMeasurement-' . $a . '"class = "form-select property">
                            <option hidden="true">'.$ingredient['measurementType'].'</option>';
                            fetchmeasurements();
                    echo    '        
                            </select>
                        </div>
                    </th>
                    <th>
                        <div class="input-group">
                            <select class = "form-select property" name="ingredientAllergen-' . $a . '">
                            <option hidden="true">'.$ingredient['AllergenName'].'</option>';
                            fetchallergens();
                    echo
                            '
                            </select>
                        </div>
                    </th>
                    <th>
                        <button aria-label="${json[i].id}" name="ingredient-'. $a . '" onclick="remIngredient(this)" class="btn btn-danger" type="button">
                            X
                        </button>
                    </th>
                </tr>
                ';
            $a++;
        }
        $_SESSION['index'] = $a;
        $a = 0;
}
function fetchIngredientIDS(){
    global $pdo;
    global $item_id;
    $fetchIngredientIDS = "SELECT IngredientID FROM recipeingredients WHERE RecipeID = ?";
    $stmt = $pdo->prepare($fetchIngredientIDS);
    $stmt->execute([$item_id]);

    $ids = array();
    while($row = $stmt->fetch()) {
        array_push($ids, $row['IngredientID']);
    }

    return $ids;
}
function fetchmeasurements(){
    global $pdo;
    
    $query = "SELECT measurementType FROM measurements" ;
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach( $result as $measurement ) {
        echo "<option value=".$measurement['measurementType'].">".$measurement['measurementType'].'</option>';
    }
}
function fetchallergens(){
    global $pdo;
    
    $query = "SELECT allergenName FROM allergens" ;
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach( $result as $allergen ) {
        echo "<option id=".$allergen['allergenName']." value=".$allergen['allergenName'].">".$allergen['allergenName'].'</option>';
    }

}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>

    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
     <!-- AJAX JS link -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Bootstrap scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- Local jQuery script link - Firefox fix -->
    <script src="../js/jQuery/jquery-3.6.3.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <!-- <link rel="stylesheet" href="../../css/main.css"> -->

    <link rel="stylesheet" href="./css/admin.css">

    <!-- Custom JS scripts -->
    <script src="./js/logout.js"></script>
    <script type="text/javascript" src="../js\jQuery/datahandler.js" defer></script>
    <link rel="./css/management.css">
    <script type="text/javascript" src="../js\jQuery/loadprogress.js"></script>
    
</head>

<header class="container-fluid">
    <nav class="navbar navbar-expand-lg underline-grey">
        <div class="col-xs-12 col-md-4">
            <a href="../../index.php">
                <img class="img-fluid" oncontextmenu="return false" src="../media/img/littleGreenLogo_180x.avif" alt="The Little Green shop logo">
            </a>
        </div>

        <div class="col-xs-12 col-md-1 offset-md-7">
            <button type="button" class="btn btn-green" onclick="logout()">Log out</button>
        </div>
    </nav>
</header>

<body>
    <div class="container-fluid my-4">
        <h1></h1>
        <form class="p-4" method="post" action="../modules/updateRecipe.php">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-5 col-lg-4">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="recipeName" placeholder="Title" value="<?php print_recipe_name() ?>">
                        <input type="hidden" name="recipeID" value="<?php echo $item_id?>">
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <div class="form-group mt-md-0 mt-sm-3">
                        <input type="submit" class="btn btn-danger" name="cancelChange" id="cancelButton" value="cancel">
                        <input type="submit" class="btn btn-success" id="submitButton" name = "modifyRecipe" value="submit">
                    </div>
                </div>
            </div>

            <div class="row mb-3" id="description">
                <!-- Ingredient List -->
                <div class="col-xs-12 col-md-12 col-lg-5 my-sm-2" style="max-height: 615px; overflow-y: auto;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Ingredient</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Measurement</th>
                                <th scope="col">Allergens</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                        <tbody id="ingredientList">
                            <?php print_ingredients();?>
                        </tbody>
                    </table>
                </div>

                <div class="col-xs-12 col-md-12 col-lg-7 my-sm-2">
                    <textarea type="text" rows="25" class="form-control" id="Description" name="recipeInstructions" aria-describedby="description text box" placeholder="Description"><?php print_description();?></textarea>
                </div>   
            </div>
            <div class="row mb-3" id="additionalInfo">
                <div class="col-md-12 my-xs-12">
                    <div class="input-group">
                        <input type="text" style="max-width:45vw;" id="ingredient" class="form-control" placeholder="Ingredient">
                        <input type="number" style="max-width:15vw;"id="quantity" class="form-control quantity-input" min="1" onkeypress="return event.keyCode != 13;">
                        <select id="measurementType" class = "form-select" style="max-width:20vw;">
                            <option  hidden="true" value=""></option>
                        <?php
                        fetchmeasurements();
                        ?>
                        </select>
                        <select id="allergenType" class = "form-select" style="max-width:20vw;">
                            <option hidden = "true" value="" >Allergen Tag</option>
                        <?php 
                        fetchallergens();
                        ?>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" onclick="onclickAdd()" id="addIngredient" type="button">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <!-- <input type="file" class="form-control-file" id="uploadImage"/> -->
            </div>
        </form>
    </div>

    <footer class="footer bg-grey px-2">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-sm-12 col-md-6">
                    <p>Created by: </p>
                    <p>&copy Andrii Sultanov, Daryna Hnatenko, Dimitar Valkov, Kamil Krauze, Maria Mara Gatillo, Vera Borvinski, Victor Iyida</p>
                </div>
                <div class="col-sm-12 col-md-6 justify-content-xs-start justify-content-md-end">
                    <p>Some copyright content</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>