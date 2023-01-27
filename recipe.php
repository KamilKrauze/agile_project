
<body>
<?php include 'header.php';?>
    
    <!-- Main container -->
    <div class="main-body">
        <?php 
         include("counter.php") 
        ?>
        <!-- Do fancy code to get recipe title and info here-->
    	<?php 
            //default recipe id set to 1
            if(isset($_GET['id'])) {
                $rid = $_GET['id'];
            }
            else{
                $rid = 1;
            }

            $findrn = $pdo->prepare("SELECT * FROM recipes WHERE RecipeID = ?");
            $findrn->bindParam(1, $rid, PDO::PARAM_INT);
            $findrn->execute();

            $recipename = $findrn->fetch(PDO::FETCH_ASSOC)['RecipeName'];

            echo '<h1>' . $recipename . '</h1>';

            echo '<h2>Allergens</h2>';
            $findiid = $pdo->prepare("SELECT IngredientID FROM recipeingredients WHERE RecipeID = ?");
            $findiid->bindParam(1, $rid, PDO::PARAM_INT);
            $findiid->execute();

            $iids = $findiid->fetchAll(\PDO::FETCH_ASSOC);
            echo '<ul>';
            foreach ($iids as $iid) {
                $findaid= $pdo->prepare("SELECT AllergenID FROM ingredients WHERE IngredientID = ?");
                $findaid->bindParam(1, $iid['IngredientID'], PDO::PARAM_INT);
                $findaid->execute();

                $aid = $findaid->fetch(PDO::FETCH_ASSOC)['AllergenID'];
                $allergens = array(1);
                if(in_array($aid, $allergens) == false){
                    array_push($allergens, $aid);
                    $findan= $pdo->prepare("SELECT * FROM allergens WHERE AllergenID = ?");
                    $findan->bindParam(1, $aid, PDO::PARAM_INT);
                    $findan->execute();

                    $an = $findan->fetch(PDO::FETCH_ASSOC)['AllergenName'];
                    echo '<li>' . $an . '</li>';
                }
            }
            echo '</ul>';
            echo '<h2>Ingredients</h2>';
            echo '<ol>';
                foreach ($iids as $iid) {
                    $findm= $pdo->prepare("SELECT * FROM measurements WHERE measurementID = (SELECT MeasurementID FROM recipeingredients WHERE IngredientID = ? and RecipeID = ?)");
                    $findm->bindParam(1, $iid['IngredientID'], PDO::PARAM_INT);
                    $findm->bindParam(2, $rid, PDO::PARAM_INT);
                    $findm->execute();

                    $m = $findm->fetch(PDO::FETCH_ASSOC)['measurementType'];

                    $findq= $pdo->prepare("SELECT * FROM recipeingredients WHERE IngredientID = ? and RecipeID = ?");
                    $findq->bindParam(1, $iid['IngredientID'], PDO::PARAM_INT);
                    $findq->bindParam(2, $rid, PDO::PARAM_INT);
                    $findq->execute();

                    $q = $findq->fetch(PDO::FETCH_ASSOC)['Quantity'];

                    $findin= $pdo->prepare("SELECT * FROM Ingredients WHERE IngredientID = ?");
                    $findin->bindParam(1, $iid['IngredientID'], PDO::PARAM_INT);
                    $findin->execute();

                    $in = $findin->fetch(PDO::FETCH_ASSOC)['IngredientName'];

                    echo '<li>' . $q . ' ' . $m . ' ' . $in . '</li>';
                }
            echo '</ol>';
            echo '<h2>Instructions</h2>';
                $findr = $pdo->prepare("SELECT * FROM recipes WHERE RecipeID = ?");
                $findr->bindParam(1, $rid, PDO::PARAM_INT);
                $findr->execute();

                $recipeinstructions = $findr->fetch(PDO::FETCH_ASSOC)['Instructions'];

                echo '<p>' . $recipeinstructions. '</p>';
        ?>
        <h3><b>Allergy Disclaimer:</b> LGL's products are plastic free and we can thus not ensure that cross-contamination has not occured.</h3>
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
