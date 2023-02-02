<!DOCTYPE html>
<html lang="en">
<?php

include './config/database.php';

// Server based cookies, will come in handy when implementing QoL features, better done at the start
session_start();
?>
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
    <script src="./js/jQuery/jquery-3.6.3.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="./css/main.css">
    
</head>

<style>
    #icon_fb:hover, #icon_insta:hover, #icon_twitter:hover {
        cursor:pointer;
    }
</style>

<header class="container-fluid underline-grey pt-3">
    <div class="row justify-content-evenly">

        <div class="col-xs-12 col-sm-6 col-md-2 py-2">
            <a href="index.php">
                <img class="img-fluid" oncontextmenu="return false" src="./media/img/littleGreenLogo_180x.avif" alt="The Little Green shop logo" style="min-width: 75px; min-height: 75px; margin-top:-15px;">
            </a>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-auto pt-2">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
            </ul>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-auto pt-2">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" target="_blank" href="https://thelittlegreenlarder.com">Link to Shop</a>
                </li>
            </ul>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-auto pt-2 mb-2">
            <img id="icon_fb" class="social-icon img-fluid" src="./media/svg/facebook.svg" alt="Facebook icon" onclick="window.open(`https://www.facebook.com/thelittlegreenlarder/`, '_blank')">
            <img id="icon_insta" class="social-icon img-fluid" src="./media/svg/instagram.svg" alt="Instagram icon" onclick="window.open(`https://www.instagram.com/thelittlegreenlarder/?hl=en`, '_blank')">
            <img id="icon_twitter" class="social-icon img-fluid" src="./media/svg/square-twitter.svg" alt="Twitter icon" onclick="window.open(`https://twitter.com/green_larder`, '_blank')">
        </div>

    </div>
</header>
