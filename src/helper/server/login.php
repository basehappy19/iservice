<?php
require 'db.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM user WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {
  $data = mysqli_fetch_object($result);
  $hashed_password = $data->password;
  if (password_verify($password, $hashed_password)) {
    $_SESSION['user_id'] = $data->user_id;
    $_SESSION['username'] = $data->username;
    $_SESSION['name'] = $data->name;
    $_SESSION['role'] = $data->role_id;
    if ($_SESSION['role'] == '2') {
      header("Location: ../../dashboard_repair");
    } else if ($_SESSION['role'] == '4') {
      header("Location: ../../");
    } else {
      header("Location: ../../");
    }
  } else {
    $_SESSION['error'] = '<script>
      Swal.fire({
        icon: "error",
        title: "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง",
        text: "กรุณาลองใหม่ หรือติดต่อผู้ดูแลระบบ!",
        confirmButtonColor: "#e25f5f",
        confirmButtonText: "ลองใหม่อีกครั้ง",
      });
    </script>';
    header("Location: ../../login");
  }
} else {
  $_SESSION['error'] = '<script>
    Swal.fire({
      icon: "error",
      title: "ไม่พบผู้ใช้",
      text: "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง!",
      confirmButtonColor: "#e25f5f",
      confirmButtonText: "ลองใหม่อีกครั้ง",
    });
  </script>';
  header("Location: ../../login");
}
