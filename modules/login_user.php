<?php
session_start();

include '../config/database.php';
include './pbkdf2_hash.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = $_POST['username'];
    $pswd = $_POST['password'];

    $hash = pbkdf2($pswd, $user);

    echo var_dump(base64_encode($hash));
    
    // try {
    //     $check_username_in_table = "SELECT pwd FROM accounts WHERE username = :user";
    //     $stmt = $pdo->prepare($check_username_in_table);
    //     $stmt->bindParam(':user', $user, PDO::PARAM_STR);
    //     $stmt->execute();

    //     $item = $stmt->fetch();
    //     $password = $item['pwd'];

    //     if(hash_equals(base64_decode($password), $hash)) {
    //         $_SESSION['loggedIn'] = "true";
    //         // echo "match";
            
    //     }

    // }
    // catch (PDOException $exception) {
    //     echo $exception;
    //     die("ERROR: Could not prepare/execute query: $check_username_in_table {$exception->getMessage()}");
    // }

}



?>