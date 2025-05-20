<?php
include 'db.php';
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["excelFile"])) {
    $file = $_FILES["excelFile"]["tmp_name"];

    $inputFileType = IOFactory::identify($file);
    $objReader = IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($file);
    $sheet = $objPHPExcel->getSheet(0);

    $highestRow = $sheet->getHighestRow();

    for ($row = 2; $row <= $highestRow; $row++) { // Start from row 2 (assuming the first row is header)
        $name = $sheet->getCell('A' . $row)->getValue(); // Assuming the institute name is in column A

        $check_query = "SELECT * FROM institute WHERE institute_name = ?";
        $stmt = mysqli_prepare($conn, $check_query);
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = '<script>
                Swal.fire({
                icon: "error",
                title: "มีหน่วยงาน ' . $name . ' ในระบบแล้ว",
                text: "กรุณาลองตั้งชื่อใหม่ หรือติดต่อผู้ดูแลระบบ!",
                confirmButtonColor: "#e25f5f",
                confirmButtonText: "ลองใหม่อีกครั้ง",
                });
            </script>';
            header("Location: ../../m_institute.php");
            exit();
        } else {
            $sql = "INSERT INTO institute (institute_name) VALUES (?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $name);
            if (mysqli_stmt_execute($stmt)) {
                header("Location: ../../m_institute.php");
            } else {
                echo "มีข้อผิดพลาดเกิดขึ้น: " . mysqli_error($conn);
            }
        }
    }
}
?>
