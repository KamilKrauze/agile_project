<html>
<body>

<?php include 'header.php';?>
    
    <!-- Main container -->
    <div class="main-body">
        <!-- Do fancy code to get recipe title and info here-->
    	<?php 
            echo '<h1>Recipe title</h1>';
            echo '<h2>Ingredients</h2>';
            echo '<ol>
                  <li>Coffee</li>
                  <li>Tea</li>
                  <li>Milk</li>
                </ol>';
            echo '<h2>Instructions</h2>';
            echo '<ol>
                  <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </li>
                  <li>Eros in cursus turpis massa tincidunt dui ut. </li>
                  <li>Vel quam elementum pulvinar etiam non.</li>
                </ol>';
        ?>
        <h3>Allergy Disclaimer: LGL's products are plastic free and we can thus not ensure that cross-contamination has not occured.</h3>
    </div>

        <!-- Sharing Alert -->
        <div class="alert alert-success" role="alert">
          Share this recipe!
    
        <!-- Sharing Links -->
        <!-- Twitter Share Button -->
        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false" data-inline="true">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    
        <!-- Facebook Share Button -->
        <id="fb-root">
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v15.0" nonce="i5TxLOMx"></script>
        
        <!-- link placeholder -->
        <div class="fb-share-button" data-href="https://agile-team1.azurewebsites.net/index.php" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fagile-team1.azurewebsites.net%2Findex.php&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
        </div>
    
<?php include 'footer.php';?>

</body>
</html>