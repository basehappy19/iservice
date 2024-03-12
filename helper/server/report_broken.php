<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $category_id = $_POST['category_id'];
    $mission_group_id = $_POST['mission_group_id'];
    $work_group_id = $_POST['work_group_id'];
    $department_id = $_POST['department_id'];
    $building_id = $_POST['building_id'];
    $floor_id = $_POST['floor_id'];
    $regis_number = $_POST['regis_number'];
    $type_id = $_POST['type_id'];
    $broken = $_POST['broken'];
    $rel = $_POST['rel'];

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['file']['name'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $file_folder = '../data/report/' . $file_name;
        $file_destination = $file_name;

        $sql_media = "INSERT INTO media_broken (rel,PATH) VALUES ('$rel','$file_destination')";
        mysqli_query($conn, $sql_media);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png", "gif", "mp4", "avi", "mov");

        if (in_array($file_ext, $allowed_extensions)) {
            if (move_uploaded_file($file_tmp_name, $file_folder)) {
                $sql = "INSERT INTO device_broken (category_id, name, mission_group_id, work_group_id, department_id, building_id, floor_id, type_id, regis_number, broken, rel, date_report_broken) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "isiiiississ", $category_id, $name, $mission_group_id, $work_group_id, $department_id, $building_id, $floor_id, $type_id, $regis_number, $broken, $rel);
                mysqli_stmt_execute($stmt);

                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    $_SESSION['success'] = '<script>
                    Swal.fire({
                        icon: "success",
                        title: "แจ้งซ่อมเรียบร้อย",
                        text: "ช่างซ่อมได้รับเรื่องแล้ว จะดำเนินให้เร็วที่สุด",
                        confirmButtonColor: "#5fe280",
                        confirmButtonText: "โอเค",
                    });
                    </script>';
                    header("Location: ../../status_repair");
                    exit();
                } else {
                    $_SESSION['error'] = '<script>
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "มีข้อผิดพลาดในการบันทึกข้อมูล",
                        confirmButtonColor: "#ff7961",
                        confirmButtonText: "ลองใหม่อีกครั้ง",
                    });
                    </script>';
                    header("Location: ../../report_repair");
                    exit();
                }
            } else {
                $_SESSION['error'] = '<script>
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: "มีข้อผิดพลาดในการอัพโหลดไฟล์",
                    confirmButtonColor: "#ff7961",
                    confirmButtonText: "ลองใหม่อีกครั้ง",
                });
                </script>';
                header("Location: ../../report_repair");
                exit();
            }
        } else {
            $_SESSION['error'] = '<script>
            Swal.fire({
                icon: "error",
                title: "อัพโหลดไฟล์ไม่ได้",
                text: "รูปแบบไฟล์ไม่ถูกต้อง โปรดเลือกไฟล์รูปภาพหรือวิดีโอเท่านั้น",
                confirmButtonColor: "#ff7961",
                confirmButtonText: "ลองใหม่อีกครั้ง",
                footer: "รองรับแค่ไฟล์ชนิด jpg jpeg png gif mp4 avi mov",
            });
            </script>';
            header("Location: ../../report_repair");
            exit();
        }
    } else {
        $sql = "INSERT INTO device_broken (category_id, name, phone, mission_group_id, work_group_id, department_id, building_id, floor_id, type_id, regis_number, broken, rel, date_report_broken) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "isiiiississs", $category_id, $name, $phone, $mission_group_id, $work_group_id, $department_id, $building_id, $floor_id, $type_id, $regis_number, $broken, $rel);

        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['success'] = '<script>
            Swal.fire({
                icon: "success",
                title: "แจ้งซ่อมเรียบร้อย",
                text: "ช่างซ่อมได้รับเรื่องแล้ว จะดำเนินให้เร็วที่สุด",
                confirmButtonColor: "#5fe280",
                confirmButtonText: "โอเค",
            });
            </script>';
            header("Location: ../../status_repair");
        }
    }
}
