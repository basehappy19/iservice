<?php
session_start();
include_once 'helper/server/db.php';
$sql = "SELECT *,
                DATE_ADD(device_broken.date_report_broken, INTERVAL 543 YEAR) as date_report_broken_adjusted,
                DATE_ADD(device_broken.date_success_fix, INTERVAL 543 YEAR) as date_success_fix_adjusted
            FROM device_broken
            INNER JOIN mission_group ON device_broken.mission_group_id = mission_group.mission_group_id
            INNER JOIN work_group ON device_broken.work_group_id = work_group.work_group_id
            INNER JOIN department ON device_broken.department_id = department.department_id
            INNER JOIN building ON device_broken.building_id = building.building_id
            INNER JOIN floor ON device_broken.floor_id = floor.floor_id
            INNER JOIN type ON device_broken.type_id = type.type_id
            INNER JOIN status_repair ON device_broken.status_repair_id = status_repair.status_repair_id
            ORDER BY
                CASE
                    WHEN status_repair.status_repair_id = 3 THEN 1
                    WHEN status_repair.status_repair_id = 2 THEN 2
                    WHEN status_repair.status_repair_id = 1 THEN 3
                    WHEN status_repair.status_repair_id = 4 THEN 4
                    WHEN status_repair.status_repair_id = 5 THEN 5
                END
    ";


$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);

$data = mysqli_stmt_get_result($stmt);


if (!isset($_SESSION['role']) || $_SESSION['role'] != '2') {
    header("Location: login");
}

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
                    <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                        <div class="col-lg-6 my-3">
                            <div class="card-bg<?php
                                                if ($row['status_repair_id'] == 1) {
                                                ?> card-status-fix-success <?php
                                                                        } elseif ($row['status_repair_id'] == 2) {
                                                                            ?> card-status-fixing <?php
                                                                                                } elseif ($row['status_repair_id'] == 3) {
                                                                                                    ?> card-status-wait <?php
                                                                                                                    } elseif ($row['status_repair_id'] == 4) {
                                                                                                                        ?> card-status-sell <?php
                                                                                                                                            } elseif ($row['status_repair_id'] == 5) {
                                                                                                                                                ?> card-status-useless <?php
                                                                                                                                            }
                                                                                                                                        ?> >">

                                <div class="mb-3">
                                    <span class="badge <?php
                                                        if ($row['status_repair_id'] == 1) {
                                                        ?> status-fix-success <?php
                                                                            } elseif ($row['status_repair_id'] == 2) {
                                                                                ?> status-fixing <?php
                                                                                                } elseif ($row['status_repair_id'] == 3) {
                                                                                                    ?> status-wait <?php
                                                                                                                } elseif ($row['status_repair_id'] == 4) {
                                                                                                                    ?> status-sell <?php
                                                                                                                                    } elseif ($row['status_repair_id'] == 5) {
                                                                                                                                        ?> status-useless <?php
                                                                                                                                    }
                                                                                                                                ?>">
                                        <?php
                                        if ($row['status_repair_id'] == 1) {
                                        ?> ซ่อมเรียบร้อย <?php
                                                        } elseif ($row['status_repair_id'] == 2) {
                                                            ?> ดำเนินการซ่อม <?php
                                                                            } elseif ($row['status_repair_id'] == 3) {
                                                                                ?> รอดำเนินการซ่อม <?php
                                                                                                } elseif ($row['status_repair_id'] == 4) {
                                                                                                    ?> จำหน่าย <?php
                                                                                                                            } elseif ($row['status_repair_id'] == 5) {
                                                                                                                                ?> ไม่มีความจำเป็นใช้งาน <?php
                                                                                                                                        }
                                                                                                                                            ?>
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <h4><?php echo $row['name'] ?></h4>
                                </div>
                                <hr>
                                <?php if (!empty($row['phone'])) { ?>
                                    <div class="mb-3">
                                        <p><strong>เบอร์โทรศัพท์ : </strong><a href="tel:<?php echo $row['phone']; ?>" class="tel-link"><?php echo $row['phone']; ?></a></p>
                                    </div>
                                <?php } ?>
                                <div class="mb-3">
                                    <p><strong>กลุ่มภารกิจ : </strong><?php echo $row['mission_group_name'] ?></p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>กลุ่มงาน : </strong><?php echo $row['work_group_name'] ?></p>
                                </div>
                                <?php if (!empty($row['department_name'])) { ?>
                                    <div class="mb-3">
                                        <p><strong>แผนก : </strong><?php echo $row['department_name']; ?></p>
                                    </div>
                                <?php } ?>
                                <div class="mb-3">
                                    <p><strong>อาคาร / ชั้น : </strong><?php echo $row['building_name'] ?></p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>ประเภท : </strong><?php echo $row['type_name'] ?></p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>เลขครุภัณฑ์ : </strong><?php echo $row['regis_number'] ?></p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>อาการ : </strong><?php echo $row['broken'] ?></p>
                                </div>
                                <?php
                                if ($row['status_repair_id'] == 1) {
                                ?>
                                    <div class="mb-3">
                                        <p><strong>วันที่ซ่อมเสร็จเรียบร้อย : </strong><?php echo $row['date_success_fix_adjusted'] ?></p>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="mb-3">
                                    <p><strong>วันที่แจ้งซ่อม : </strong><?php echo $row['date_report_broken_adjusted'] ?></p>
                                </div>
                                <div>
                                    <?php
                                    if ($row['status_repair_id'] == 2) {
                                    ?>
                                        <button type="button" class="btn btn-new btn-new-success mb-1" onclick="update_status_broken_1('helper/server/update/status_1.php?device_id=<?php echo $row['device_id'] ?>')">ซ่อมเรียบร้อย <i class="fa-solid fa-circle-check"></i></i></button>
                                        <a href="history?device_id=<?php echo $row['device_id']; ?>" class="btn btn-new btn-new-warning mb-1">เพิ่มประวัติ <i class="fa-solid fa-plus"></i></a>
                                    <?php
                                    } else if ($row['status_repair_id'] == 1) {

                                    ?>
                                        <a href="history?device_id=<?php echo $row['device_id']; ?>" class="btn btn-new btn-new-warning mb-1">เพิ่มประวัติ <i class="fa-solid fa-plus"></i></a>
                                    <?php
                                    } elseif ($row['status_repair_id'] == 3) {
                                    ?>
                                        <button type="button" class="btn btn-new btn-new-danger mb-1" onclick="update_status_broken_2('helper/server/update/status_2.php?device_id=<?php echo $row['device_id'] ?>')">รับเรื่องซ่อม <i class="fa-solid fa-screwdriver-wrench"></i></button>
                                    <?php } ?>
                                    <?php if ($row['status_repair_id'] != 4 && $row['status_repair_id'] != 5) { ?>
                                        <button type="button" class="btn btn-new btn-new-info mb-1" data-toggle="modal" data-target="#exampleModal<?php echo $row['device_id']; ?>">
                                            ดูรูป / วิดีโอประกอบ <i class="fa-solid fa-image"></i>
                                        </button>
                                    <?php } ?>
                                </div>
                                <?php include 'helper/source/modal-img-vdo.php' ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    </main>
    <?php include 'helper/source/footer.php' ?>

</body>

</html>