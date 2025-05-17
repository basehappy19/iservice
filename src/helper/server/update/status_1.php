<?php
include '../db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $device_id = $_GET['device_id'];
    $update_query = "UPDATE device_broken SET status_repair_id = '1', date_success_fix = NOW() WHERE device_id = '$device_id'";
    
    if (mysqli_query($conn, $update_query)) {
        $_SESSION['success'] = '<script>
                Swal.fire({
                    title: "ซ่อมเรียบร้อยแล้ว!",
                    text: "ผู้แจ้งซ่อมจะได้รับการแจ้งเตือน สถานะการซ่อม",
                    icon: "success",
                    confirmButtonColor: "#5fe280",
                    confirmButtonText: "โอเค",
                });
                </script>';
        header("Location: ../../../dashboard_repair");
        exit();
    }

}   