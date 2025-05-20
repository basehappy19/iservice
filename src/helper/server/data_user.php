<?php 
$user_id = $_SESSION['user_id'] ?? null;

$sql = "SELECT * FROM user WHERE user_id = :user_id";
$sql = $conn->prepare($sql);
$sql->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$sql->execute();
$result = $sql->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $data_user = $result;
}