<?php
session_start();
require './helper/server/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != '2') {
    header("Location: ./login.php");
}

$sql = "SELECT *,
                device_broken.date_report_broken,
                device_broken.date_success_fix
            FROM device_broken
            LEFT JOIN mission_group ON device_broken.mission_group_id = mission_group.mission_group_id
            LEFT JOIN work_group ON device_broken.work_group_id = work_group.work_group_id
            LEFT JOIN department ON device_broken.department_id = department.department_id
            LEFT JOIN building ON device_broken.building_id = building.building_id
            LEFT JOIN floor ON device_broken.floor_id = floor.floor_id
            LEFT JOIN type ON device_broken.type_id = type.type_id
            LEFT JOIN status_repair ON device_broken.status_repair_id = status_repair.status_repair_id
            LEFT JOIN file_report ON device_broken.device_id = file_report.b_id
            ORDER BY
                CASE
                    WHEN status_repair.status_repair_id = 3 THEN 1
                    WHEN status_repair.status_repair_id = 2 THEN 2
                    WHEN status_repair.status_repair_id = 1 THEN 3
                    WHEN status_repair.status_repair_id = 4 THEN 4
                    WHEN status_repair.status_repair_id = 5 THEN 5
                END
    ";

$stmt = $conn->prepare($sql);
$stmt->execute();
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการแจ้งซ่อม | โรงพยาบาลเมตตาประชารักษ์ (วัดไร่ขิง)</title>
    <?php include 'helper/source/head.php' ?>
</head>

<body>
    <?php include 'helper/source/header.php' ?>
    <main>
        <section>
            <?php
            if (isset($_SESSION['success'])) {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }
            ?>
            <div class="container mt-3 mx-auto card-con">
                <h1 class="head-info text-center">รายการแจ้งซ่อม</h1>
                <p class="head-info text-center">ยินดีต้อนรับ <?php echo $data_user['name'] ?></p>
                <div class="row">
                    <?php foreach ($reports as $report) : ?>
                        <div class="col-lg-6 my-3">
                            <?php
                            $statusClasses = [
                                1 => 'card-status-fix-success',
                                2 => 'card-status-fixing',
                                3 => 'card-status-wait',
                                4 => 'card-status-sell',
                                5 => 'card-status-useless'
                            ];

                            $statusBadges = [
                                1 => 'status-fix-success',
                                2 => 'status-fixing',
                                3 => 'status-wait',
                                4 => 'status-sell',
                                5 => 'status-useless'
                            ];

                            $statusLabels = [
                                1 => 'ซ่อมเรียบร้อย',
                                2 => 'ดำเนินการซ่อม',
                                3 => 'รอดำเนินการซ่อม',
                                4 => 'จำหน่าย',
                                5 => 'ไม่มีความจำเป็นใช้งาน'
                            ];

                            $cardClass = $statusClasses[$report['status_repair_id']] ?? null;
                            $statusBadge = $statusBadges[$report['status_repair_id']] ?? null;
                            $statusLabel = $statusLabels[$report['status_repair_id']] ?? null;
                            ?>

                            <div class="card-bg <?php echo $cardClass; ?>">
                                <div class="mb-3">
                                    <span class="badge <?php echo $statusBadge; ?>">
                                        <?php echo $statusLabel; ?>
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <h4><?php echo $report['name'] ?></h4>
                                </div>
                                <hr>

                                <?php if (!empty($report['phone'])) : ?>
                                    <div class="mb-3">
                                        <p><strong>เบอร์โทรศัพท์ : </strong>
                                            <a href="tel:<?php echo $report['phone']; ?>" class="tel-link">
                                                <?php echo $report['phone']; ?>
                                            </a>
                                        </p>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <p><strong>กลุ่มภารกิจ : </strong><?php echo $report['mission_group_name'] ?></p>
                                    <p><strong>กลุ่มงาน : </strong><?php echo $report['work_group_name'] ?></p>
                                    <?php if (!empty($report['department_name'])) : ?>
                                        <p><strong>แผนก : </strong><?php echo $report['department_name']; ?></p>
                                    <?php endif; ?>
                                    <p><strong>อาคาร / ชั้น : </strong><?php echo $report['building_name'] ?></p>
                                    <p><strong>ประเภท : </strong><?php echo $report['type_name'] ?></p>
                                    <p><strong>เลขครุภัณฑ์ : </strong><?php echo $report['regis_number'] ?></p>
                                    <p><strong>อาการ : </strong><?php echo $report['broken'] ?></p>
                                </div>

                                <?php if ($report['status_repair_id'] == 1) : ?>
                                    <div class="mb-3">
                                        <p><strong>วันที่ซ่อมเสร็จเรียบร้อย : </strong><?php echo $report['date_success_fix'] ?></p>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <p><strong>วันที่แจ้งซ่อม : </strong><?php echo $report['date_report_broken'] ?></p>
                                </div>

                                <div>
                                    <?php if ($report['status_repair_id'] == 2) : ?>
                                        <button type="button" class="btn btn-new btn-new-success mb-1"
                                            onclick="update_status_broken_1('./helper/server/update/status_1.php?device_id=<?php echo $report['device_id'] ?>')">
                                            ซ่อมเรียบร้อย <i class="fa-solid fa-circle-check"></i>
                                        </button>
                                        <a href="history.php?device_id=<?php echo $report['device_id']; ?>" class="btn btn-new btn-new-warning mb-1">
                                            เพิ่มประวัติ <i class="fa-solid fa-plus"></i>
                                        </a>
                                    <?php elseif ($report['status_repair_id'] == 1) : ?>
                                        <a href="history.php?device_id=<?php echo $report['device_id']; ?>" class="btn btn-new btn-new-warning mb-1">
                                            เพิ่มประวัติ <i class="fa-solid fa-plus"></i>
                                        </a>
                                    <?php elseif ($report['status_repair_id'] == 3) : ?>
                                        <button type="button" class="btn btn-new btn-new-danger mb-1"
                                            onclick="update_status_broken_2('./helper/server/update/status_2.php?device_id=<?php echo $report['device_id'] ?>')">
                                            รับเรื่องซ่อม <i class="fa-solid fa-screwdriver-wrench"></i>
                                        </button>
                                    <?php endif; ?>

                                    <button type="button" class="btn btn-new btn-new-info mb-1"
                                        data-toggle="modal" data-target="#exampleModal<?php echo $report['device_id']; ?>">
                                        ดูรูป / วิดีโอประกอบ <i class="fa-solid fa-image"></i>
                                    </button>
                                </div>
                                <?php include './helper/source/modal-img-vdo.php'; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>
    <?php include 'helper/source/footer.php' ?>

</body>

</html>