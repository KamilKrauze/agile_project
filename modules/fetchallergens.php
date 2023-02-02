<?php
include "../config/database.php";
    $query = "SELECT allergenName FROM allergens" ;
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach( $result as $allergens ) {
        echo "<option value=".$allergens['allergenName'].">".$allergens['allergenName'].'</option>';
    }
?>