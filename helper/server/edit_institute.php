<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $sql = "UPDATE institute 
            SET 
                institute_name = ?
            WHERE 
                institute_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "si", $name, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../../m_institute");
    } else {
        header("Location: ../../m_institute");
    }
}
?>
