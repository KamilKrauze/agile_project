<!DOCTYPE html>
<html lang="en">
<head>

<?php
include '../config/database.php';
session_start();

if (!isset($_POST['submit']) && !isset($_POST['query'])) {
    $_POST['submit'] = " ";
    $_POST['query'] = "";
}

$query = "";
$filterBy = "";
if (isset($_POST['submit'])) {
    if ($_POST['submit']) {
        $query = $_POST['query'];
        if (isset($_SESSION['filterBy'])) {
            $filterBy = $_SESSION['filterBy'];
        }
    }
}

if ($_SESSION['loggedIn'] == "false") {
    header("Location: ./index.php", true, 301);
    exit();
}

$title = "Admin Search";
// include './components/head.php';

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

    <link rel="stylesheet" href="./css/admin.css">

    <!-- Custom JS scripts -->
    <script src="./js/logout.js"></script>
    <script src="./js/search_buttons.js" defer></script>
    
</head>

<header class="container-fluid underline-grey mb-3">
    <div class="row justify-content-xs-start justify-content-md-between">
        <div class="col">
            <a href="../../index.php">
                <img class="img-fluid" oncontextmenu="return false" src="../../media/img/littleGreenLogo_180x.avif" alt="The Little Green shop logo">
            </a>
        </div>
        <div class="col-auto my-5">
            <button type="button" class="btn btn-green" onclick="logout()">Logout</button>
        </div>
    </div>
</header>

<body>
     <!-- Main container -->
    <div class="container-fluid my-2>
        <!--Source: https://mdbootstrap.com/docs/standard/forms/search/-->
        <div class="row px-md-5">
            <form method="post" action="search.php">
                <div class="input-group">
                    <input value=<?php echo '"'.$query.'"'?> type="text" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="query"/>
                    <select id="select_item_type" class="form-select" aria-label="Select item type" aria-describedby="Filter nothing or show explicitly ingredients or recipes." onchange="applyFilter()">
                        <option id="fltr_opt_all" value="all">All</option>
                        <option id="fltr_opt_ingredients" value="ingredients">Ingredients</option>
                        <option id="fltr_opt_recipes" value="recipes">Recipes</option>
                    </select>
                    <button type="submit" name="submit" value="Search" class="btn btn-secondary">Search</button>
            </form>
                    <form action="add.php">
                        <button type="submit" class="btn btn-green">Add item</button>
                     </form>
                </div>
            
            
        </div>
    
        <div class="contents row mx-5 my-3" style="overflow-y: auto; height:auto; max-height:100vh;">

        <?php

        $value = "";
        if ($query == "") {
            $value = "%";
        } else {
            $value = "%" . $query . "%";
        }
        
        echo `<h1> `.$_POST['query'].`' </h1>`;
        echo `<h1> '`.$_POST['submit'].`' </h1>`;
        


        if ($filterBy == "ingredients" || $filterBy == "all" || !isset($filterBy)) {
            try {
                $fetchIngredients = "SELECT * FROM v_allergen_to_ingredient WHERE IngredientName LIKE :name;";
                $stmt = $pdo->prepare($fetchIngredients);
                $stmt->bindParam(':name', $value, PDO::PARAM_STR);
                $stmt->execute();

                while ($row = $stmt->fetch()) {
                    $id = $row['IngredientID'];
                    $name = $row['IngredientName'];
                    $allergen = $row['AllergenName'];

                    echo '
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 col-xl-2 my-2">
                        <div class="card h-100">
                            <img class="img-fluid card-img-top" src="../media/img/littleGreenLogo_180x.avif" alt="Card image cap" oncontextmenu="return false">
                            <div class="card-body">
                                <h3>' . $name . '</h3>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#ingredientModal-' . $id . '">View</button>
                            </div>
                        </div>
                    </div>
                    ';

                    echo '
                    <div class="modal fade" id="ingredientModal-' . $id . '" tabindex="-1" aria-labelledby="exampleRecipeLabel" aria-hidden="true" style="max-height:85%;">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleRecipeLabel">' . $name . '</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img class="img-fluid card-img-top" src="../media/img/littleGreenLogo_180x.avif" alt="' . $name . ' oncontextmenu="return false">
                                <p>Allergen: ' . $allergen . '</p>   
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rusureModali-' . $id . '">Remove</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    ';

                    echo '
                    <div class="modal fade" id="rusureModali-' . $id . '" tabindex="-1" aria-labelledby="exampleRecipeLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
                                <p>Are you sure you want to delete this item?</p>     
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-green" data-bs-dismiss="modal">No</button>
                                <form action="remove.php" method="get">
                                <button name="iid" type="submit" class="btn btn-green" value="' . $id . '">Yes</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } catch (PDOException $exception) {
                echo $exception;
                die("ERROR: Could not prepare/execute query. \n{$exception->getMessage()}");
            }
        }

        if ($filterBy == "recipes" || $filterBy == "all" || !isset($filterBy)) {
            try {
                $fetchRecipes = "SELECT RecipeID, RecipeName, Instructions FROM recipes WHERE RecipeName LIKE :name";
                $stmt = $pdo->prepare($fetchRecipes);
                $stmt->bindParam(':name', $value, PDO::PARAM_STR);
                $stmt->execute();

                while ($row = $stmt->fetch()) {
                    $id = $row['RecipeID'];
                    $name = $row['RecipeName'];
                    $desc = $row['Instructions'];

                    echo '
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 col-xl-2 my-2">
                    <div class="card h-100">
                        <img class="img-fluid card-img-top" src="../media/img/littleGreenLogo_180x.avif" alt="Card image cap" oncontextmenu="return false">
                        <div class="card-body">
                            <h3>' . $name . '</h3>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#recipeModal-' . $id . '">View</button>
                        </div>
                    </div>
                </div>
                ';

                    echo '
                <div class="modal fade" id="recipeModal-' . $id . '" tabindex="-1" aria-labelledby="exampleRecipeLabel" aria-hidden="true" style="max-height:85%;">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleRecipeLabel">' . $name . '</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="word-wrap: break-word;">
                            <img class="img-fluid card-img-top" src="../media/img/littleGreenLogo_180x.avif" alt="' . $name . ' oncontextmenu="return false">
                            <p>' . $desc . '</p>     
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rusureModalr-' . $id . '">Remove</button>
                            <button type="button" class="btn btn-green" onclick="editItem(this,' . $id . ',`Recipe`)">Edit</button>
                        </div>
                        </div>
                    </div>
                </div>
                ';

                    echo '
                <div class="modal fade" id="rusureModalr-' . $id . '" tabindex="-1" aria-labelledby="exampleRecipeLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-body">
                            <p>Are you sure you want to delete this item?</p>     
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-green" data-bs-dismiss="modal">No</button>
                            <form action="remove.php" method="get">
                            <button name="rid" type="submit" class="btn btn-green" value="' . $id . '">Yes</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                ';
                }

            } catch (PDOException $exception) {
                echo $exception;
                die("ERROR: Could not prepare/execute query. \n{$exception->getMessage()}");
            }
        }
        ?>
            
        </div>
    </div>

<footer class="footer bg-grey px-2">
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-sm-12 col-md-3">
                <p>Created by: </p>
                <p>&copy Andrii Sultanov, Daryna Hnatenko, Dimitar Valkov, Kamil Krauze, Maria Mara Gatillo, Vera Borvinski, Victor Iyida</p>
            </div>
            <div class="col-sm-12 col-md-3 offset-md-3">
                <p>Some copyright content</p>
            </div>
        </div>
    </div>
</footer>

</body>
</html>