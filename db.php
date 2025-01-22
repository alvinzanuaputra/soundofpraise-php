<?php
// $host = 'sql205.infinityfree.com';
// $dbname = 'if0_38150691_soundpraise';
// $user = 'if0_38150691';
// $password = 'OM1bM4VyHZ';
$host = 'localhost';
$dbname = 'soundofpraise-php';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
