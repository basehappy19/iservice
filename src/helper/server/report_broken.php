<?php
session_start();
require './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    var_dump($_POST);
    var_dump($_FILES);

    $form_data = [
        "name" => $_POST['name'] ?? '',
        "phone" => $_POST['phone'] ?? '',
        "type_id" => (int)$_POST['type_id'] ?? '',
        "category_id" => (int)$_POST['category_id'] ?? '',
        "mission_group_id" => (int)$_POST['mission_group_id'] ?? '',
        "work_group_id" => (int)$_POST['work_group_id'] ?? '',
        "department_id" => (int)$_POST['department_id'] ?? '',
        "building_id" => (int)$_POST['building_id'] ?? '',
        "floor_id" => (int)$_POST['floor_id'] ?? '',
        "regis_number" => $_POST['regis_number'] ?? '',
        "broken" => $_POST['broken'] ?? '',
    ];
    var_dump($form_data);

    try {

        $sql = "INSERT INTO device_broken 
        (name, phone, type_id, category_id, mission_group_id, work_group_id, department_id, building_id, floor_id, regis_number, broken) 
        VALUES (:name, :phone, :type_id, :category_id, :mission_group_id, :work_group_id, :department_id, :building_id, :floor_id, :regis_number, :broken)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $form_data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':phone', $form_data['phone'], PDO::PARAM_STR);
        $stmt->bindParam(':type_id', $form_data['type_id'], PDO::PARAM_INT);
        $stmt->bindParam(':category_id', $form_data['category_id'], PDO::PARAM_INT);
        $stmt->bindParam(':mission_group_id', $form_data['mission_group_id'], PDO::PARAM_INT);
        $stmt->bindParam(':work_group_id', $form_data['work_group_id'], PDO::PARAM_INT);
        $stmt->bindParam(':department_id', $form_data['department_id'], PDO::PARAM_INT);
        $stmt->bindParam(':building_id', $form_data['building_id'], PDO::PARAM_INT);
        $stmt->bindParam(':floor_id', $form_data['floor_id'], PDO::PARAM_INT);
        $stmt->bindParam(':regis_number', $form_data['regis_number'], PDO::PARAM_STR);
        $stmt->bindParam(':broken', $form_data['broken'], PDO::PARAM_STR);
        $stmt->execute();

        $broken_id = $conn->lastInsertId();

        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $file_name = $_FILES['file']['name'];
            $file_name = preg_replace('/[^a-zA-Z0-9.]/', '_', $file_name);
            $file_name = date('YmdHis') . '_' . $file_name;
            $file_tmp_name = $_FILES['file']['tmp_name'];

            if (
                $_FILES['file']['type'] == 'image/jpeg'
                || $_FILES['file']['type'] == 'image/png'
                || $_FILES['file']['type'] == 'image/gif'
            ) {
                $file_type = 'image';
            } else if ($_FILES['file']['type'] == 'video/mp4' || $_FILES['file']['type'] == 'video/x-ms') {
                $file_type = 'video';
            } else {
                $file_type = 'etc';
            }

            $file_destination = $file_name;

            $sql_file = "INSERT INTO file_report (b_id, file_type, path, size) VALUES (:b_id, :file_type, :path, :size)";
            $stmt_file = $conn->prepare($sql_file);
            $stmt_file->bindParam(':b_id', $broken_id, PDO::PARAM_INT);
            $stmt_file->bindParam(':file_type', $file_type, PDO::PARAM_STR);
            $stmt_file->bindParam(':path', $file_destination, PDO::PARAM_STR);
            $stmt_file->bindParam(':size', $_FILES['file']['size'], PDO::PARAM_INT);
            $stmt_file->execute();


            $file_folder = '../data/report/' . $broken_id . '/';

            if (!is_dir($file_folder)) {
                mkdir($file_folder, 0777, true);
            }
            $file_folder .= $file_name;
            if (move_uploaded_file($file_tmp_name, $file_folder)) {
                $_SESSION['success'] = '<script>
                Swal.fire({
                    icon: "success",
                    title: "แจ้งซ่อมเรียบร้อย",
                    text: "ช่างซ่อมได้รับเรื่องแล้ว จะดำเนินให้เร็วที่สุด",
                    confirmButtonColor: "#5fe280",
                    confirmButtonText: "โอเค",
                });
                </script>';
                header("Location: ../../status_repair.php");
                exit();
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
                header("Location: ../../report_repair.php");
                exit();
            }
        }

        $_SESSION['success'] = '<script>
                Swal.fire({
                    icon: "success",
                    title: "แจ้งซ่อมเรียบร้อย",
                    text: "ช่างซ่อมได้รับเรื่องแล้ว จะดำเนินให้เร็วที่สุด",
                    confirmButtonColor: "#5fe280",
                    confirmButtonText: "โอเค",
                });
                </script>';
        header("Location: ../../status_repair.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = '<script>
        Swal.fire({
            icon: "error",
            title: "เกิดข้อผิดพลาด",
            text: "มีข้อผิดพลาดในการบันทึกข้อมูล",
            confirmButtonColor: "#ff7961",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        </script>';

        header("Location: ../../report_repair.php");
        exit();
    }
}
