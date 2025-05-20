<?php
session_start();
require './db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->bindParam("username", $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();

    if ($result) {
        $hashed_password = $result['password'];
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['name'] = $result['name'];
            $_SESSION['role'] = $result['role_id'];
            if ($_SESSION['role'] == 2) {
                header("Location: ../../dashboard_repair.php");
                exit();
            }
            header("Location: ../../");
            exit();
        } else {
            $_SESSION['error'] = '<script>
                Swal.fire({
                    icon: "error",
                    title: "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง",
                    text: "กรุณาลองใหม่ หรือติดต่อผู้ดูแลระบบ!",
                    confirmButtonColor: "#e25f5f",
                    confirmButtonText: "ลองใหม่อีกครั้ง",
                });
            </script>';
            header("Location: ../../login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = '<script>
            Swal.fire({
                icon: "error",
                title: "ไม่พบผู้ใช้",
                text: "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง!",
                confirmButtonColor: "#e25f5f",
                confirmButtonText: "ลองใหม่อีกครั้ง",
            });
        </script>';
        header("Location: ../../login.php");
        exit();
    }
}

