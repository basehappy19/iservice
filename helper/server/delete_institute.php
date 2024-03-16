<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $deleteQuery = "DELETE FROM institute WHERE institute_id = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location: ../../m_institute");
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
