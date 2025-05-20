<?php
session_start();
require '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['device_id'])) {
    $device_id = $_GET['device_id'];
    $sql = "UPDATE device_broken SET status_repair_id = 1, date_success_fix = NOW() WHERE device_id = :device_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':device_id', $device_id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = '<script>
                Swal.fire({
                    title: "ซ่อมเรียบร้อยแล้ว!",
                    text: "ผู้แจ้งซ่อมจะได้รับการแจ้งเตือน สถานะการซ่อม",
                    icon: "success",
                    confirmButtonColor: "#5fe280",
                    confirmButtonText: "โอเค",
                });
                </script>';
        header("Location: ../../../dashboard_repair.php");
        exit();
    }

}   