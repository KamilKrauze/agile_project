<!DOCTYPE html>
<html lang="en">
<head>

<?php
session_start();

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
    <!-- <link rel="stylesheet" href="../../css/main.css"> -->
    <link rel="stylesheet" href="./css/admin.css">

    <!-- Custom JS scripts -->
    <script src="./js/logout.js"></script>
    
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
    <div class="main-body mx-2 my-2">
        <!--Source: https://mdbootstrap.com/docs/standard/forms/search/-->
        <div class="input-group">
            <input name ="search" type="text" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <button type="submit" class="btn btn-secondary btn-sm" value="add">Search</button>
            <form action="modify.php" method="post">
                <button type="submit" class="btn btn-success" value="add">Add item</button>
            </form>
        </div>
        <?php
        // Get user search query from search bar - from $_POST to $_REQUEST
        $search = "";
            if (isset($_REQUEST['search'])) {
                if ($_REQUEST['search'] != "") {
                    $search = $_REQUEST['search'];
                }
            }

        ?>
    </div>
    
    <div class="contents row p-2 mx-2 my-2">
    <?php  
    echo '
        <div class="col-xs-12 col-md-2 my-2">
            <div class="card">
                <img class="img-fluid card-img-top" src="../media/img/littleGreenLogo_180x.avif" alt="Card image cap">
                <div class="card-body">
                    <h2>Recipe title</h2>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#recipeModal">View</button>
                </div>
            </div>
        </div>
    ';
    ?>        
    </div>
    <!-- Modal https://getbootstrap.com/docs/4.0/components/modal/-->
    <div class="modal fade" id="recipeModal" tabindex="-1" aria-labelledby="exampleRecipeLabel" aria-hidden="true">
        <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleRecipeLabel">Recipe title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img class="img-fluid card-img-top" src="../media/img/littleGreenLogo_180x.avif" alt="Card image cap">
        <p>Details</p>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" value="edit">Remove</button>
        <button type="button" class="btn btn-green" value="edit">Edit</button>
      </div>
    </div>
  </div>
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