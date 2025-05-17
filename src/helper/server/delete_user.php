<?php
include 'db.php';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $deleteQuery = "DELETE FROM user WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location: ../../m_user");
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
