<?php

$host = "localhost";
$dbname = "blog_db";
$username = "root";
$password = "Root@1234";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
