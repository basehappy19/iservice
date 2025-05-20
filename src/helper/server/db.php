<?php
$host = "iservice_db";
$username = "root";
$password = "root_password";
$dbname = "iservice";
$port = 3306;

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("เชื่อมต่อกับ database ไม่ได้: " . $e->getMessage());
}
