<!-- from How to Share your site on All Social Platforms using jQuery Plugin? Complete tutorial | Code Grind - https://youtu.be/jKElY3hWpIY -->

    <!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="jssocials.css" />
    <link rel="stylesheet" type="text/css" href="jssocials-theme-flat.css" />
</head>

<body>
    <?php include 'header.php';?>
    
    <!-- Main container -->
    <div class="main-body">
    </div>

    <div id="share"></div>

    <script src="jquery.js"></script>
    <script src="jssocials.min.js"></script>
    <script>
        $("#share").jsSocials({
            url:"https://agile-team1.azurewebsites.net/index.php", //link placeholder, replace with recipe URL 
            text: "Share this recipe!",
            shares: ["twitter", "instagram", "facebook"]
        });
    </script>

    <script src="https://kit.fontawesome.com/7368c40b21.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script src="./jsSocials/jssocials.js"></script>

    <?php include 'footer.php';?>
</body>

