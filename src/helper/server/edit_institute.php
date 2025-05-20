<?php
require './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? '';

    $sql = "UPDATE institute SET institute_name = :name WHERE institute_id = :institute_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':institute_id', $id);
    $stmt->execute();
    
    header("Location: ../../m_institute.php");
    exit();
}
