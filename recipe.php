
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
            if(isset($_GET['rid'])) {
                $rid = $_GET['rid'];
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

<?php include 'footer.php';?>

</body>
