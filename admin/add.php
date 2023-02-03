<!DOCTYPE html>
<html lang="en">
<head>

<?php

$title = "Management"; // Page title text

include '../config/database.php';
session_start();

if ($_SESSION['loggedIn'] == "false") {
    header("Location: ./index.php", true, 301);
    exit();
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
/*
if(isset($_POST['ingredient'])){
    array_push($sessionArray,$_POST['ingredient']);
    $_SESSION['ingredients'] = $sessionArray;
    print_r($_SESSION['ingredients']);
}
*/
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
    <!--
    <script src="./js/logout.js"></script>
    <script type="text/javascript" src="../js\jQuery/onclickEvents.js" defer></script>
    <link rel="./css/management.css">
    -->
    
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
            <div class="row mb-3">
                <div class="col-sm-12 col-md-7 col-lg-8">
                    <div class="form-group mt-md-0 mt-sm-3">
                        <div class="btn-group">
                          <button class="btn btn-secondary" type="button">
                            Type
                          </button>
                          <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a href="add.php?type=recipe">Recipe</a></li>
                            <li><a href="add.php?type=ingredient">Ingredient</a></li>
                            <li><a href="add.php?type=spice">Spice</a></li>
                            <li><a href="add.php?type=allergen">Allergen</a></li>
                          </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!--recipe add -->
            <?php
            if(isset($_GET['type'])){
                if($_GET['type'] == "recipe"){/*
                    echo '
                    <h2>Recipe</h2>
                    <form id="postingredient" method="post">
                    <div class="row mb-3" id="additionalInfo">
                        <label>Add ingredient: </label>
                        <div class="col-md-4 my-xs-1">
                            <div class="input-group">
                                  <select name = "ingredient" form = "postingredient">
                                    ';
                                    
                                        $fetchIngredients = $pdo->prepare("SELECT * FROM ingredients");
                                        $fetchIngredients->execute();
                                        while($row = $fetchIngredients->fetch()){
                                            echo '<option value="' .$row['IngredientName'].'">' .$row['IngredientName']. '</option>';
                                        }
                    echo '
                                  </select>
                                  <div class="input-group-append">
                                    <button class="btn btn-outline-success" " id="addIngredient" type="submit" form = "postingredient">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>

                    <form id="sendrecipe" action="processadd.php" method="post">
                    <div class="row mb-3" id="description">
                        <!-- Ingredient List -->
                        <div class="col-xs-12 col-md-12 col-lg-5 my-sm-2" style="max-height: 615px; overflow-y: scroll;">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Ingredient</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Measurement</th>
                                        <th scope="col">Allergen</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>

                                <tbody>';
                                    
                                    for ($i=0; $i < $a; $i++)
                                    {
                                        print_ingredients();
                                    }
                    echo '
                                </tbody>
                            </table>
                        </div>

                        <div class="col-xs-12 col-md-12 col-lg-7 my-sm-2">
                            <textarea type="text" rows="25" class="form-control" id="Description" aria-describedby="description text box" placeholder="Instructions" form = "sendrecipe"></textarea>
                        </div>   
                    </div>

                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "rn" type="text" id="Allergen" class="form-control" placeholder="Title" form = "sendrecipe">
                        </div>
                    </div>

                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "sd" type="text" id="Allergen" class="form-control" placeholder="Description" form = "sendrecipe">
                        </div>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "pt" type="text" id="Allergen" class="form-control" placeholder="Prep time(in minutes)" form = "sendrecipe">
                        </div>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "ct" type="text" id="Allergen" class="form-control" placeholder="Cook time(in minutes)" form = "sendrecipe">
                        </div>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "s" type="text" id="Allergen" class="form-control" placeholder="Servings" form = "sendrecipe">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label>Add picture: </label>
                        <input type="file" class="form-control-file" id="uploadImage"/>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <input name = "submitted" type="submit" class="btn btn-danger" id="cancelButton" value="cancel" form = "sendrecipe">
                        <input name = "submitted" type="submit" class="btn btn-success" id="submitButton" value="submit" form = "sendrecipe">
                    </div>
                </form>
            </div>
            ';
            */
            echo '
                <div class="container-fluid my-4">
                    <h2>Recipe</h2>
                    <form method = "post" action = "processadd.php">
                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "rn" type="text" class="form-control" placeholder="Name">
                        </div>
                    </div>
                        <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "sd" type="text" id="Allergen" class="form-control" placeholder="Short description">
                        </div>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "pt" type="text" id="Allergen" class="form-control" placeholder="Prep time(in minutes)">
                        </div>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "ct" type="text" id="Allergen" class="form-control" placeholder="Cook time(in minutes)">
                        </div>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "s" type="text" id="Allergen" class="form-control" placeholder="Servings">
                        </div>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <input name = "submitted" type="submit" class="btn btn-danger" id="cancelButton" value="cancel">
                        <input name = "submitted" type="submit" class="btn btn-success" id="submitButton" value="submit">
                    </div>
                </form>
                </div>
            ';
        }
        else if($_GET['type'] == "ingredient"){
            echo '
            <div class="container-fluid my-4">
                <h2>Ingredient</h2>
                <form method = "post" action = "processadd.php">
                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "in" type="text" id="Allergen" class="form-control" placeholder="Ingredient">
                        </div>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <label>Allergens: </label>
                          <select name = aid>';
                            $fetchAllergens = $pdo->prepare("SELECT * FROM allergens");
                                        $fetchAllergens->execute();
                                        while($row = $fetchAllergens->fetch()){
                                            echo '<option value=' .$row['AllergenID'] .'>' .$row['AllergenName']. '</option>';
                                        }
                        echo '
                          </select>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "sl" type="text" id="Allergen" class="form-control" placeholder="Link to site">
                        </div>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <input name = "submitted" type="submit" class="btn btn-danger" id="cancelButton" value="cancel">
                        <input name = "submitted" type="submit" class="btn btn-success" id="submitButton" value="submit">
                    </div>
                </form>
                </div>
            ';
        }
        else if($_GET["type"] == "spice"){
            echo '
                <div class="container-fluid my-4">
                <h2>Spice</h2>
                <form method = "post" action = "processadd.php">
                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "sn" type="text" class="form-control" placeholder="Spice">
                        </div>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <label>Allergens: </label>
                          <select name = aid>';
                            $fetchAllergens = $pdo->prepare("SELECT * FROM allergens");
                                        $fetchAllergens->execute();
                                        while($row = $fetchAllergens->fetch()){
                                            echo '<option value =' .$row['AllergenID'] .'>' .$row['AllergenName']. '</option>';
                                        }
                        echo '
                          </select>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "sl" type="text" id="Allergen" class="form-control" placeholder="Link to site">
                        </div>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <input name = "submitted" type="submit" class="btn btn-danger" id="cancelButton" value="cancel">
                        <input name = "submitted" type="submit" class="btn btn-success" id="submitButton" value="submit">
                    </div>
                </form>
                </div>
                ';
        }
        else if($_GET["type"] == "allergen"){
            echo '
                <div class="container-fluid my-4">
                <h2>Allergen</h2>
                <form method = "post" action = "processadd.php">
                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "an" type="text" id="Allergen" class="form-control" placeholder="Allergen">
                        </div>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <div class="input-group">
                            <input name = "sd" type="text" id="Allergen" class="form-control" placeholder="Description">
                        </div>
                    </div>
                    <div class="col-md-4 my-xs-1">
                        <input name = "submitted" type="submit" class="btn btn-danger" id="cancelButton" value="cancel">
                        <input name = "submitted" type="submit" class="btn btn-success" id="submitButton" value="submit">
                    </div>
                </form>
                </div>
                ';
        }
    }
    ?>

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