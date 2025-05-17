<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'db.php'; 

    $user_id = $_SESSION['user_id'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE user SET password = ? WHERE user_id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $hashed_password, $user_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = '<script>
                Swal.fire({
                    title: "เปลี่ยนรหัสผ่านเรียบร้อย!",
                    text: "เปลี่ยนรหัสผ่านผู้ใช้เรียบร้อย",
                    icon: "success",
                    confirmButtonColor: "#5fe280",
                    confirmButtonText: "ยืนยัน",
                });
                </script>';
        header("Location: ../../profile");
        exit();
    }
}
?>
