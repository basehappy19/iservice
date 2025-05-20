<?php
require './db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'] ?? null;
    
    $sql = "DELETE FROM institute WHERE institute_id = :institute_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':institute_id', $id, PDO::PARAM_INT);
    $stmt->execute();
    header("Location: ../../m_institute.php");
    exit();
}
?>
