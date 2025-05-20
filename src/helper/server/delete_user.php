<?php
require './db.php';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $sql = "SELECT * FROM user WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    try {
        $sql = "DELETE FROM user WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            if ($user['profile_pic'] != null && $user['profile_pic'] != 'user.png') {
                $file_path = '../data/profile/' . $user['profile_pic'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            header("Location: ../../m_user.php");
            exit;
        }
    } catch (PDOException $e) {
        error_log("Error deleting user: " . $e->getMessage());
    }
}
