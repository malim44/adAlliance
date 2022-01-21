<?php
$host = 'localhost';
$username = 'root';
$password = 'root';
$db_name = 'adalliance';
$serverData = "mysql:host=$host;dbname=$db_name;";
$pdo = null;

// first connecting to mysql-server and creating the database
try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $db_name") or die(print_r($pdo->errorInfo(), true));
} catch(PDOException $error) {
    print $error->getMessage();
}

// second connecting to former created database
try {
    $pdo = new PDO($serverData, $username, $password);
} catch(PDOException $error) {
    print $error->getMessage();
}