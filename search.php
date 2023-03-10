<!DOCTYPE html>
<html lang="en">
<head>

<?php
include '../config/database.php';
session_start();

$query = "";
if (isset($_POST['submit'])) {
    if ($_POST['submit']) {
        $query = $_POST['query'];
    }
}

if ($_SESSION['loggedIn'] != "true") {
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

<header class="container-fluid">
    <nav class="navbar navbar-expand-lg underline-grey">
    <a href="../../index.php">
        <img class="img-fluid" oncontextmenu="return false" src="../../media/img/littleGreenLogo_180x.avif" alt="The Little Green shop logo">
    </a>

    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../../index.php">Home</a>
                </li>
            <ul>
        </div>
        <button type="button" class="btn btn-green" onclick="logout()">Log out</button>
    </nav>
</header>

<body>
     <!-- Main container -->
    <div class="container-fluid my-2">
        <!--Source: https://mdbootstrap.com/docs/standard/forms/search/-->
        <div class="row px-md-5">
            <form method="post" action="search.php">
                <div class="input-group">
                    <input type="text" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="query"/>
                    <button type="submit" name="submit" value="Search" class="btn btn-secondary">Search</button>
                    <button type="button" class="btn btn-green">Add item</button>
                </div>
            </form>
        </div>
    
        <div class="contents row mx-5 my-3 h-100" style="overflow-y: scroll;">

        <?php
        
        $value = "";
        if ($query == "") { $value = "%"; }
        else { $value= "%".$query."%"; }

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
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 my-2">
                    <div class="card h-100">
                        <img class="img-fluid card-img-top" src="../media/img/littleGreenLogo_180x.avif" alt="Card image cap" oncontextmenu="return false">
                        <div class="card-body">
                            <h3>'.$name.'</h3>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#ingredientModal-'.$id.'">View</button>
                        </div>
                    </div>
                </div>
                ';

                echo '
                <div class="modal fade" id="ingredientModal-'.$id.'" tabindex="-1" aria-labelledby="exampleRecipeLabel" aria-hidden="true" style="max-height:85%;">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleRecipeLabel">'.$name.'</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img class="img-fluid card-img-top" src="../media/img/littleGreenLogo_180x.avif" alt="'.$name.' oncontextmenu="return false">
                            <p>Allergen: '.$allergen.'</p>     
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rusureModali-'.$id.'">Remove</button>
                            <button type="button" class="btn btn-green" onclick="editItem(this,'.$id.',`Ingredient`)">Edit</button>
                        </div>
                        </div>
                    </div>
                </div>
                ';

                echo '
                <div class="modal fade" id="rusureModali-'.$id.'" tabindex="-1" aria-labelledby="exampleRecipeLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-body">
                            <p>Are you sure you want to delete this item?</p>     
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-green" data-bs-dismiss="modal">No</button>
                            <form action="remove.php" method="get">
                            <button name="iid" type="submit" class="btn btn-green" value="'.$id.'">Yes</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                ';
            }
            unset($fetchIngredients);
            unset($id);
            unset($row);
            unset($name);
            unset($allergen);
            unset($stmt);
            unset($pdo);
        }
        catch (PDOException $exception) {
            echo $exception;
            unset($pdo);
            die("ERROR: Could not prepare/execute query. \n{$exception->getMessage()}");
        }
        ?>

        <?php
        include '../config/database.php';

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
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2 my-2">
                    <div class="card h-100">
                        <img class="img-fluid card-img-top" src="../media/img/littleGreenLogo_180x.avif" alt="Card image cap" oncontextmenu="return false">
                        <div class="card-body">
                            <h3>'.$name.'</h3>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#recipeModal-'.$id.'">View</button>
                        </div>
                    </div>
                </div>
                ';

                echo '
                <div class="modal fade" id="recipeModal-'.$id.'" tabindex="-1" aria-labelledby="exampleRecipeLabel" aria-hidden="true" style="max-height:85%;">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleRecipeLabel">'.$name.'</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="word-wrap: break-word;">
                            <img class="img-fluid card-img-top" src="../media/img/littleGreenLogo_180x.avif" alt="'.$name.' oncontextmenu="return false">
                            <p>'.$desc.'</p>     
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rusureModalr-'.$id.'">Remove</button>
                            <button type="button" class="btn btn-green" onclick="editItem(this,'.$id.',`Recipe`)">Edit</button>
                        </div>
                        </div>
                    </div>
                </div>
                ';

                echo '
                <div class="modal fade" id="rusureModalr-'.$id.'" tabindex="-1" aria-labelledby="exampleRecipeLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-body">
                            <p>Are you sure you want to delete this item?</p>     
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-green" data-bs-dismiss="modal">No</button>
                            <form action="remove.php" method="get">
                            <button name="rid" type="submit" class="btn btn-green" value="'.$id.'">Yes</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                ';
            }

            unset($fetchIngredients);
            unset($id);
            unset($name);
            unset($desc);
            unset($stmt);
            unset($pdo);

        }
        catch (PDOException $exception) {
            echo $exception;
            unset($pdo);
            die("ERROR: Could not prepare/execute query. \n{$exception->getMessage()}");
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