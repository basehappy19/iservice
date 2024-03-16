<?php
include 'db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    
    $check_query = "SELECT * FROM institute WHERE institute_name = ?";
    $stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = '<script>
            Swal.fire({
            icon: "error",
            title: "มีหน่วยงานนี้ในระบบแล้ว",
            text: "กรุณาลองตั้งชื่อใหม่ หรือติดต่อผู้ดูแลระบบ!",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
            });
        </script>';
        header("Location: ../../m_institute");
        exit();
    } else {
        
        $sql = "INSERT INTO institute (institute_name) VALUES (?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $name);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../../m_institute");
            exit();
        } else {
            echo "มีข้อผิดพลาดเกิดขึ้น: " . mysqli_error($conn);
        }
    }
}
