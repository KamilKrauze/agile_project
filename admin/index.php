<!DOCTYPE html>
<html lang="en"></html>

<?php
session_start();
$title = "Login";
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
    <link rel="stylesheet" href="./css/management.css">

    <!-- Custom JS scripts -->
    <script src="./js/login.js"></script>
    
</head>

<header class="container-fluid">
    <nav class="row navbar navbar-expand-lg underline-grey">
        <div class="col-2 offset-5">
            <a href="../../index.php">
                <img class="img-fluid" oncontextmenu="return false" src="../../media/img/littleGreenLogo_180x.avif" alt="The Little Green shop logo">
            </a>
        </div>
    </nav>
</header>

<body>
<div class="container-fluid my-5">
    <div class="row">
        <div class="contents col-xs-12 col-md-6 col-lg-4 my-3 p-5 mx-auto justify-content-centered">
            <h1>Login</h1>
            
            <!-- Login Section -->
            <form>
                <div class="form-group my-5">
                    <label for="username">Enter username:</label>
                    <input id="username" type="text" class="form-control col-6" autocomplete="false" placeholder="Username" aria-label="Username text field">
                </div>
                <div class="form-group my-5">
                    <label for="password">Enter password:</label>
                    <input id="password" type="password" class="form-control col-6" autocomplete="false" placeholder="Password" aria-label="Password text field">
                </div>
                <button type="button"  class="my-5 btn btn-green btn-lg" onclick="login()" oncontextmenu="return false">Login</button>
            </form>
        </div>
    </div>

</div>

<footer class="footer bg-grey py-2 px-2">
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