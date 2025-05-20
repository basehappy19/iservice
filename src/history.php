<?php
session_start();
require './helper/server/db.php';
$device_id = $_GET['device_id'];
$sql = "SELECT * FROM device_broken WHERE device_id = :device_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":device_id", $device_id, PDO::PARAM_STR);
$stmt->execute();
$report = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($report)) {
    header("Location: ./dashboard_repair");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $history_title = $_POST['title'] ?? '';
    $history_des = $_POST['des'] ?? '';
    $sql = "INSERT INTO history (history_title, history_des, device_broken_id) VALUES (:history_title, :history_des, :device_broken_id)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":history_title", $history_title, PDO::PARAM_STR);
    $stmt->bindParam(":history_des", $history_des, PDO::PARAM_STR);
    $stmt->bindParam(":device_broken_id", $device_id, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $_SESSION['success'] = '<script>
        Swal.fire({
            title: "เพิ่มประวัติเรียบร้อย!",
            text: "สามารถแก้ไขประวัติได้เสมอ",
            icon: "success",
            confirmButtonColor: "#5fe280",
            confirmButtonText: "โอเค",
        });
        </script>';
        header("Location: ./dashboard_repair.php");
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
                <p class="head-info text-center">ข้อมูลแจ้งซ่อม "<?php echo $report['name'] ?>"</p>
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
                        <a href="dashboard_repair.php" class="btn btn-new btn-new-danger">ยกเลิก <i class="fa-solid fa-x"></i></a>
                    </div>
                </form>
            </div>
        </section>
    </main>

</body>

</html>