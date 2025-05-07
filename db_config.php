<?php
$host = 'localhost';
$dbname = 'chandnis_kitchen';
$username = 'root'; // default for XAMPP
$password = ''; // default for XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>