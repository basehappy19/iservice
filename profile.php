<?php
session_start();
include_once 'helper/server/db.php';
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์ | โรงพยาบาลเมตตาประชารักษ์ (วัดไร่ขิง) <?php echo $data_user['name'] ?></title>
    <?php include 'helper/source/head.php' ?>

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
            <?php
            if (isset($_SESSION['success'])) {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }
            ?>
            <div class="container mt-3 mx-auto card-con animate__animated animate__zoomIn animate__fast">
                <div class="mb-3 text-center">
                    <?php if (isset($data_user['profile_pic']) && !empty($data_user['profile_pic'])) { ?>
                        <div class="full-profile animate__animated animate__flipInY">
                            <img src="<?php echo 'helper/data/profile/' . $data_user['profile_pic'] ?>" alt="Profile" srcset="">
                        </div>
                    <?php
                    } else { ?>
                        <div class="full-profile animate__animated animate__flipInY">
                            <img src="helper/icon/profile.svg" alt="Profile" srcset="">
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <h1 class="head-info text-center">ข้อมูลโปรไฟล์</h1>
                <hr>
                <h3 class="head-info">ข้อมูลส่วนบุคคล</h3>
                <form action="helper/server/edit_profile_name.php" id="edit_profile" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="username" class="form-label">
                            ชื่อผู้ใช้
                        </label>
                        <input type="text" class="form-control" name="username" id="username" onkeydown="clearBorder(this)" value="<?php echo $data_user['username'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            ชื่อ - นามสกุล
                        </label>
                        <input type="text" class="form-control" name="name" id="name" onkeydown="clearBorder(this)" value="<?php echo $data_user['name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">
                            เบอร์โทรศัพท์
                        </label>
                        <input type="tel" class="form-control" maxlength="10" name="phone" id="phone" onkeydown="clearBorder(this)" value="<?php echo $data_user['phone'] ?>" required placeholder="เบอร์โทรศัพท์">
                    </div>
                    <div class="mb-3">
                        <label for="profile_pic">อัปโหลดรูปโปรไฟล์</label>
                        <input type="file" class="form-control" id="profile_pic" name="profile_pic" accept="image/*">
                    </div>
                    <div>
                        <button type="button" class="btn btn-new btn-new-info mb-3" onclick="edit_profile()">แก้ไขข้อมูลส่วนตัว <i class="fa-solid fa-user-pen"></i></button>
                        <button type="button" id="toggleSecuritySectionBtn" class="btn btn-new btn-new-warning mb-3">เปลี่ยนรหัสผ่าน <i class="fa-solid fa-key"></i></button>
                        <a href="helper/server/logout.php" class="btn btn-new btn-new-danger mb-3">ออกจากระบบ <i class="fa-solid fa-right-from-bracket"></i></a>
                    </div>
                </form>
                <hr>
                <form action="helper/server/edit_profile_password.php" id="edit_password" method="post">
                    <div id="securitySection">
                        <h3 class="head-info">ความปลอดภัย</h3>
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                รหัสผ่าน
                            </label>
                            <input type="password" class="form-control" name="password" id="password" onkeydown="clearBorder(this)" placeholder="รหัสผ่าน" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">
                                ยืนยันรหัสผ่าน
                            </label>
                            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" onkeydown="clearBorder(this)" placeholder="ยืนยันรหัสผ่าน" required>
                        </div>
                        <button type="button" id="toggleSecuritySectionBtn" class="btn btn-new btn-new-success" onclick="edit_password()">ยืนยัน</button>
                        <hr>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php include 'helper/source/footer.php' ?>
</body>

</html>