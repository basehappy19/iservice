<?php
require './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'] ?? '';
    if (empty($user_id)) {
        $_SESSION['error'] = '<script>
            Swal.fire({
            icon: "error",
            title: "ไม่สามารถแก้ไขข้อมูลได้",
            text: "กรุณาลองใหม่อีกครั้ง หรือติดต่อผู้ดูแลระบบ!",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
            });
        </script>';
        header("Location: ../../m_user.php");
        exit();
    }

    $sql = "SELECT * FROM user WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $username = $_POST['username'] ?? $user['username'];
    $password = $_POST['password'] ?? null;
    $name = $_POST['name'] ?? $user['name'];
    $phone = $_POST['phone'] ?? $user['phone'];
    $role_id = $_POST['role_id'] ?? $user['role_id'];


    $sql = "SELECT * FROM user WHERE username = :username AND user_id != :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result) > 0) {
        $_SESSION['error'] = '<script>
            Swal.fire({
            icon: "error",
            title: "มีชื่อผู้ใช้นี้ในระบบแล้ว",
            text: "กรุณาลองตั้งชื่อใหม่ หรือติดต่อผู้ดูแลระบบ!",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
            });
        </script>';
        header("Location: ../../m_user.php");
        exit();
    }

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET username = :username, `password` = :password, `name` = :name, phone = :phone, role_id = :role_id WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    } else {
        $sql = "UPDATE user SET username = :username, `name` = :name, phone = :phone, role_id = :role_id WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
    }
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: ../../m_user.php");
    exit();
}
