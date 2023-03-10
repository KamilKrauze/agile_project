<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Little Green Larder</title>

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
    <link rel="stylesheet" href="../css/main.css">
    
</head>

<header class="container-fluid">
    <nav class="navbar navbar-expand-lg underline-grey">
        <a href="../index.php">
            <img class="img-fluid" oncontextmenu="return false" src="../media/img/littleGreenLogo_180x.avif" alt="The Little Green shop logo">
        </a>

        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../index.php">Home</a>
                    </li>
                </ul>
            </div>
            <a class="nav-link" href="https://www.facebook.com/thelittlegreenlarder" target="_blank"> <img class="social-icon img-fluid" src="../media/svg/facebook.svg" alt="Instagram icon"> </a>
            <a class="nav-link" href="https://www.instagram.com/thelittlegreenlarder/?hl=en" target="_blank"> <img class="social-icon img-fluid" src="../media/svg/instagram.svg" alt="Instagram icon"> </a>
            <a class="nav-link" href="https://twitter.com/green_larder" target="_blank"> <img class="social-icon img-fluid" src="../media/svg/square-twitter.svg" alt="Twitter icon"> </a>
        </div>
    </nav>
</header>

<body>

    <div>
        <h1>
            Connection failed to DB.
        </h1>
        <p>Please try again later.</p>
    </div>

    <?php
        include "../footer.php";
    ?>
</body>
