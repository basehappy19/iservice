<?php 
session_start();
if (isset($_SESSION['role'])) {
    header("Location: ./");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ล็อคอิน | โรงพยาบาลเมตตาประชารักษ์ (วัดไร่ขิง)</title>
    <?php require 'helper/source/head.php' ?>
</head>

<body>
    <?php include 'helper/source/header.php' ?>
    <main>
        <section>
            <?php
            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
            ?>
            <div class="d-flex d-lg-flex align-items-center align-items-lg-center" style="height: 70vh;">
                <div class="container mt-3 card-con login animate__animated animate__zoomIn animate__fast">
                    <form action="helper/server/login.php" method="post">
                        <h2 class="text-center">ล็อกอินเข้าระบบ</h2>
                        <div class="mb-3">
                            <label for="username" class="form-label">ชื่อผู้ใช้</label>
                            <input type="text" class="form-control" name="username" placeholder="ชื่อผู้ใช้" required>
                        </div>
                        <div class="mb-3">
                            <label for="username">รหัสผ่าน</label>
                            <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" required>
                        </div>
                        <hr>
                        <div class="text-end">
                            <button type="submit" class="btn btn-new btn-new-success">ล็อคอิน <i class="fa-solid fa-circle-check"></i></button>
                            <a href="javascript:history.back(1)" class="btn btn-new btn-new-danger">ยกเลิก <i class="fa-solid fa-x"></i></a>
                        </div>
                    </form>
                </div>
            </div>

        </section>
    </main>
</body>

</html>