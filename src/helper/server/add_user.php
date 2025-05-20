<?php
session_start();
require './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $role_id = $_POST['role_id'] ?? '';
    $name = $_POST['name'] ?? '';


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM user WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
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

    $sql = "INSERT INTO user (username, password, phone, role_id, name) VALUES (:username, :password, :phone, :role_id, :name)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_INT);
    $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    if ($stmt->execute()) {
        $_SESSION['success'] = '<script>
            Swal.fire({
            icon: "success",
            title: "เพิ่มผู้ใช้ใหม่สำเร็จ",
            text: "ผู้ใช้ใหม่ถูกเพิ่มเรียบร้อยแล้ว!",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "ตกลง",
            });
        </script>';
    } else {
        $_SESSION['error'] = '<script>
            Swal.fire({
            icon: "error",
            title: "เกิดข้อผิดพลาด",
            text: "ไม่สามารถเพิ่มผู้ใช้ใหม่ได้!",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
            });
        </script>';
    }
    header("Location: ../../m_user.php");
    exit();
}
