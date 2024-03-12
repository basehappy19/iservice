<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $role_id = $_POST['role_id'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE user 
            SET 
                username = ?,
                password = ?,
                name = ?,
                phone = ?,
                role_id = ?
            WHERE 
                user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssssii", $username, $hashed_password, $name, $phone, $role_id, $user_id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../../management");
    } else {
        header("Location: ../../management");
    }
}
?>
