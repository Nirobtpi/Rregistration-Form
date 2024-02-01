<?php

$hostname = "localhost";
$userName = 'root';
$dbName = "test";
$password = "";

try {
    $conn = new PDO("mysql:host=$hostname;dbname=$dbName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection Success";
} catch (PDOException $e) {
    echo "Connection Fail " . $e->getMessage();
}

require_once('functions.php');