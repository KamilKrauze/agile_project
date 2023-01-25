<?php
$hostname = "agile-team1.mysql.database.azure.com";
$username = "agileteam1-u01";
$pwd = "u01-ag1*";
$db_name = "ldl";
$port = 3306;

$dsn = "mysql:host=$hostname;dbname=$db_name;port=$port";

$options = array(
    PDO::MYSQL_ATTR_SSL_CA => ".\ssl\certs\DigiCertGlobalRootCA.crt.pem",
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
);

try {
    $pdo = new PDO($dsn ,$username, $pwd, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    include '../errors/connection_failed.php';
    die("ERROR: Could not connect. " . $e->getMessage());
}

?>