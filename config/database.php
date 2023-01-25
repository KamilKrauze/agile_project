<?php
$host =  "agile-team1.mysql.database.azure.com"; // Hostname
$username = "agileteam1-u01";
$password = "u01-ag1*";
$db_name = "ldl"; // The default schema you should be using
$port = '3306';
$options = array(
    PDO::MYSQL_ATTR_SSL_CA => "../ssl/certs/DigiCertGlobalRootCA.crt.pem",
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
);

$dsn = "mysql:host=$host;dbname=$db_name;port=$port";

try {
    $pdo = new PDO($dsn ,$username, $password, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    include './errors/connection_failed.php';
    die("ERROR: Could not connect. " . $e->getMessage());
}

?>