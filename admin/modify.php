<!DOCTYPE html>
<html lang="en">
<head>

<?php

$title = "Management"; // Page title text

include '../config/database.php';
session_start();
/*if ($_SESSION['loggedIn'] == "false") {
    header("Location: ./index.php", true, 301);
    exit();
}*/
/*
$op_type;
$itemType;
$id;

echo "<h1>" . $_SESSION['op_type'] . "</h1>";
echo "<h1>" . $_SESSION['item_type'] . "</h1>";
echo "<h1>". strval($_SESSION['item_id']) . "</h1>";

if(isset($_SESSION['op_type']) && isset($_SESSION['item_type']) && isset($_SESSION['item_id'])) {
    echo "<h1> Hello </h1>";
    $op_type = $_SESSION['op_type'];
    $itemType = $_SESSION['item_type'];
    $id = $_SESSION['item_id'];
    echo $itemType . "</b>";
}else{
    echo "<h1> Hello 0_0</h1>";
}
*/
function print_ingredient_desc() {}

function print_recipe_desc() {}
    $op_type = $_POST['op_type'];
    $item_id = $_POST['item_id'];
    $item_type = $_POST['item_type'];
function print_description() {
    
    global $op_type;
    global $item_id;
    global $item_type;
    global $pdo;
    if (!isset($op_type) || $op_type == "add" || !($op_type == "edit")) {return;}
    if($item_type == "Recipe"){
        $fetchRecipe = "SELECT RecipeName, Instructions FROM Recipes WHERE RecipeID = ?";
        $stmt = $pdo->prepare($fetchRecipe);
        $stmt->execute([$item_id]);
        echo $stmt->fetch()['Instructions'];
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
        if(count($stmtFetch->fetch())!=0){
            $a=0;
        while($row = $stmtFetch->fetch()){

            $igredientNames[$a] = $row['IngredientName'];
            $quantity[$a] = $row['Quantity'];
            $measurmentTypes[$a] = $row['measurementType'];
            $allergens[$a] = $row['AllergenName'];
            $a++;
        }
        for ($i = 0; $i < $a - 1; $i++) {
            echo $igredientNames[$i] . " " . $quantity[$i] . " " . $measurmentTypes[$i] . "\n";
        }
    } else {
        return;}
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
    <script type="text/javascript" src="../js\jQuery/onclickEvents.js" defer></script>
    <link rel="./css/management.css">

    
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
        <form class="p-4" method="post">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-5 col-lg-4">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Title" value="Item name...">
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <div class="form-group mt-md-0 mt-sm-3">
                        <input type="submit" class="btn btn-danger" id="cancelButton" value="cancel">
                        <input type="submit" class="btn btn-success" id="submitButton" value="submit">
                    </div>
                </div>
            </div>

            <div class="row mb-3" id="description">
                <!-- Ingredient List -->
                <div class="col-xs-12 col-md-12 col-lg-5 my-sm-2" style="max-height: 615px; overflow-y: scroll;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Ingredient</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Measurement</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            for ($i=0; $i < 25; $i++)
                            {
                                echo
                                    '
                                    <tr>
                                        <th>--name--</th>
                                        <th><input class="quantity-input" type="number" min="1" onkeypress="return event.keyCode != 13;" style="width:50%" value=1></th>
                                        <th>
                                            <button type="button" class="btn btn-secondary dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="10,20">
                                                Offset
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                                <li><a class="dropdown-item">Action</a></li>
                                                <li><a class="dropdown-item">Another action</a></li>q
                                                <li><a class="dropdown-item">Something else here</a></li>
                                            </ul>
                                        </th>
                                        <th>
                                            <button aria-label="${json[i].id}" class="btn btn-danger" type="button">
                                                X
                                            </button>
                                        </th>
                                    </tr>
                                    ';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-xs-12 col-md-12 col-lg-7 my-sm-2">
                    <textarea type="text" rows="25" class="form-control" id="Description" aria-describedby="description text box" placeholder="Description"> <?php print_description();?></textarea>
                </div>   
            </div>
            <div class="row mb-3" id="additionalInfo">
                <div class="col-md-4 my-xs-1">
                    <div class="input-group">
                        <input type="text" id="Allergen" class="form-control" placeholder="Allergen">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" id="addAlergen" type="button">Add</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-xs-1">
                    <div class="input-group">
                        <input type="text" id="dietaryTag" class="form-control" placeholder="Dietary tag">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" id="addDietaryTag" type="button">Add</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-xs-1">
                    <div class="input-group">
                        <input type="text" id="ingredient" class="form-control" placeholder="Ingredient">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" onclick="onclickAdd()" id="addIngredient" type="button">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <input type="file" class="form-control-file" id="uploadImage"/>
            </div>
        </form>
    </div>

    <footer class="footer bg-grey px-2">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-sm-12 col-md-6">
                    <p>Created by: </p>
                    <p>&copy Andrii Sultanov, Daryna Hnatenko, Dimitar Valkov, Kamil Krauze, Maria Mara Gatillo, Vera Borvinski</p>
                </div>
                <div class="col-sm-12 col-md-6 justify-content-xs-start justify-content-md-end">
                    <p>Some copyright content</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>