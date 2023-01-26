<!DOCTYPE html>
<html lang="en">
<head>

<?php
session_start();

if ($_SESSION['loggedIn'] == "false") {
    header("Location: ./index.php", true, 301);
    exit();
}

if(isset($_SESSION['operation_type']) && $_SESSION['item_type'] && $_SESSION['item_id']) {
// Do something
}

$title = "Management";
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
        <div class="col-xs-12 col-md-4">
            <a href="../../index.php">
                <img class="img-fluid" oncontextmenu="return false" src="../../media/img/littleGreenLogo_180x.avif" alt="The Little Green shop logo">
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
        <form class="contents p-4">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-5">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Title">
                    </div>
                </div>
                <div class="col-sm-12 col-md-2 offset-md-5">
                    <div class="form-group mt-md-0 mt-sm-3">
                        <input type="submit" class="btn btn-danger" value="cancel">
                        <input type="submit" class="btn btn-success" value="submit">
                    </div>
                </div>
            </div>
            <div class="row mb-3" id="description">
                <div class="col-md-12">
                    <textarea type="text" rows="25" class="form-control" id="title" aria-describedby="description text box" placeholder="Description"></textarea>
                </div>   
            </div>
            <div class="row mb-3" id="additionalInfo">
                <div class="col-md-4">
                    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Allergens">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Diatary tags">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Ingredients">
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