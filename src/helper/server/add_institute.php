<?php
session_start();
require './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];

    try {
        $check_query = "SELECT COUNT(*) FROM institute WHERE institute_name = :name";
        $stmt = $conn->prepare($check_query);
        $stmt->execute([':name' => $name]);
        $exists = $stmt->fetchColumn();

        if ($exists > 0) {
            $_SESSION['error'] = '<script>
                Swal.fire({
                icon: "error",
                title: "มีหน่วยงานนี้ในระบบแล้ว",
                text: "กรุณาลองตั้งชื่อใหม่ หรือติดต่อผู้ดูแลระบบ!",
                confirmButtonColor: "#e25f5f",
                confirmButtonText: "ลองใหม่อีกครั้ง",
                });
            </script>';
            header("Location: ../../m_institute.php");
            exit();
        }

        $sql = "INSERT INTO institute (institute_name) VALUES (:name)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':name' => $name]);

        header("Location: ../../m_institute.php");
        exit();
    } catch (PDOException $e) {
        echo "มีข้อผิดพลาดเกิดขึ้น: " . $e->getMessage();
    }
}
