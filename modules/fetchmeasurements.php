<?php
include "../config/database.php";
    $query = "SELECT measurementType FROM measurements" ;
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach( $result as $measurement ) {
        echo "<option value=".$measurement['measurementType'].">".$measurement['measurementType'].'</option>';
    }
?>