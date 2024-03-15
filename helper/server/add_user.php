<?php
include 'db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $role_id = $_POST['role_id'];
    $name = $_POST['name'];

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $check_query = "SELECT * FROM user WHERE username = ?";
    $stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = '<script>
            Swal.fire({
            icon: "error",
            title: "มีชื่อผู้ใช้นี้ในระบบแล้ว",
            text: "กรุณาลองตั้งชื่อใหม่ หรือติดต่อผู้ดูแลระบบ!",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
            });
        </script>';
        header("Location: ../../m_user");
        exit();
    } else {
        
        $sql = "INSERT INTO user (username, password, name, role_id)
                VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $username, $hashed_password, $name, $role_id);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../../m_user");
            exit();
        } else {
            echo "มีข้อผิดพลาดเกิดขึ้น: " . mysqli_error($conn);
        }
    }
}
