<?php 

// Data Source Name
$dsn = "mysql:host=localhost;dbname=putno_osiguranje";
$dbusername = "root";
$dbpassword = "";

try {
    // pdo => PHP Data Object
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}