<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $device_id = $_POST['device_id'];
    $name = $_POST['name'];
    $work_group_id = $_POST['work_group_id'];
    $building_id = $_POST['building_id'];
    $floor_id = $_POST['floor_id'];
    $type_id = $_POST['type_id'];
    $regis_number = $_POST['regis_number'];
    $broken = $_POST['broken'];
    $status_repair_id = $_POST['status_repair_id'];

    // Prepare the SQL statement using prepared statement
    $sql = "UPDATE device_broken 
            SET 
                name = ?, 
                work_group_id = ?, 
                building_id = ?, 
                floor_id = ?, 
                type_id = ?, 
                regis_number = ?, 
                broken = ?, 
                status_repair_id = ? 
            WHERE 
                device_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "siiiiisisi", $name, $work_group_id, $building_id, $floor_id, $type_id, $regis_number, $broken, $status_repair_id, $device_id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../../status_repair.php");
    } else {
        header("Location: ../../status_repair.php");
    }

    mysqli_stmt_close($stmt);
}
?>
