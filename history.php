<?php
include_once 'helper/server/db.php';
session_start();
$device_id = $_GET['device_id'];
$query = "SELECT * FROM device_broken WHERE device_id = '$device_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: dashboard_repair");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $history_title = $_POST['title'];
    $history_des = $_POST['des'];
    $insert = "INSERT INTO history (device_broken_id, title, des, history_date) VALUES ('$device_id', '$history_title', '$history_des', NOW())";

    $insertResult = mysqli_query($conn, $insert);

    if ($insertResult) {
        $_SESSION['success'] = '<script>
        Swal.fire({
            title: "เพิ่มประวัติเรียบร้อย!",
            text: "สามารถแก้ไขประวัติได้เสมอ",
            icon: "success",
            confirmButtonColor: "#5fe280",
            confirmButtonText: "โอเค",
        });
        </script>';
        header("Location: dashboard_repair");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มประวัติ | โรงพยาบาลเมตตาประชารักษ์ (วัดไร่ขิง)</title>
    <?php include 'helper/source/head.php' ?>
</head>

<body>
    <?php include 'helper/source/header.php' ?>
    <main>
        <section>
            <div class="container mt-3 mx-auto card-con">
                <h1 class="head-info text-center">เพิ่มประวัติ</h1>
                <p class="head-info text-center">ข้อมูลแจ้งซ่อมที่ <?php echo $device_id ?></p>
                <form method="post" id="history">
                    <div class="col-lg-12 mb-3">
                        <label for="title">ชื่อหัวข้อประวัติ</label>
                        <input class="form-control" type="text" name="title" id="title" placeholder="หัวข้อ....." onkeydown="clearBorder(this)">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label for="des">คำอธิบาย</label>
                        <textarea class="form-control" name="des" id="des" rows="5" placeholder="คำอธิบาย....." onkeydown="clearBorder(this)"></textarea>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-new btn-new-success" onclick="add_history()">ยืนยัน <i class="fa-solid fa-circle-check"></i></button>
                        <a href="dashboard_repair" class="btn btn-new btn-new-danger">ยกเลิก <i class="fa-solid fa-x"></i></a>
                    </div>
                </form>
            </div>
        </section>
    </main>

</body>

</html>