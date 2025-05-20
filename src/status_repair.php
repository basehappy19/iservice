<?php
require './helper/server/db.php';
session_start();

$status_id = isset($_GET['status_id']) ? $_GET['status_id'] : null;

if (isset($_GET['category'])) {
    $selected_category = $_GET['category'];
    $sql = "SELECT *,
                DATE_ADD(device_broken.date_report_broken, INTERVAL 543 YEAR) as date_report_broken_adjusted,
                DATE_ADD(device_broken.date_success_fix, INTERVAL 543 YEAR) as date_success_fix_adjusted
            FROM device_broken
            INNER JOIN category ON report.category_id = category.category_id
            INNER JOIN mission_group ON report.mission_group_id = mission_group.mission_group_id
            INNER JOIN work_group ON report.work_group_id = work_group.work_group_id
            INNER JOIN department ON report.department_id = department.department_id
            INNER JOIN building ON report.building_id = building.building_id
            INNER JOIN floor ON report.floor_id = floor.floor_id
            INNER JOIN type ON report.type_id = type.type_id
            INNER JOIN status_repair ON report.status_repair_id = status_repair.status_repair_id
            WHERE category.category_id = :category_id
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':category_id', $selected_category, PDO::PARAM_INT);
    $stmt->execute();
    $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sql = "SELECT *,
                DATE_ADD(device_broken.date_report_broken, INTERVAL 543 YEAR) as date_report_broken_adjusted,
                DATE_ADD(device_broken.date_success_fix, INTERVAL 543 YEAR) as date_success_fix_adjusted
            FROM device_broken
            INNER JOIN category ON device_broken.category_id = category.category_id
            INNER JOIN mission_group ON device_broken.mission_group_id = mission_group.mission_group_id
            INNER JOIN work_group ON device_broken.work_group_id = work_group.work_group_id
            INNER JOIN department ON device_broken.department_id = department.department_id
            INNER JOIN building ON device_broken.building_id = building.building_id
            INNER JOIN floor ON device_broken.floor_id = floor.floor_id
            INNER JOIN type ON device_broken.type_id = type.type_id
            INNER JOIN status_repair ON device_broken.status_repair_id = status_repair.status_repair_id
    ";

    if (!empty($status_id)) {
        $sql .= " WHERE report.status_repair_id = :status_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':status_id', $status_id, PDO::PARAM_INT);
    } else {
        $stmt = $conn->prepare($sql);
    }
    $stmt->execute();
    $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถานะการซ่อม | โรงพยาบาลเมตตาประชารักษ์ (วัดไร่ขิง)</title>
    <?php require 'helper/source/head.php' ?>
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
            <div class="container-fluid mt-3 mx-auto card-con">
                <h1 class="head-info text-center my-3">
                    <?php if (!isset($_GET['category'])) { ?>
                        สถานะการซ่อม ทั้งหมด
                    <?php } ?>
                    <?php if (isset($_GET['category']) && $_GET['category'] == '1') { ?>
                        สถานะการซ่อม อุปกรณ์คอมพิวเตอร์
                    <?php } elseif (isset($_GET['category']) && $_GET['category'] == '2') { ?>
                        สถานะการซ่อม อุปกรณ์การแพทย์
                    <?php } ?>
                </h1>
                <div class="text-center m-3">
                    <?php if (isset($_GET['category']) && $_GET['category'] == '1') { ?>
                        <a href="status_repair.php" class="btn btn-new btn-new-info">
                            <i class="fa-solid fa-list"></i> ทั้งหมด
                        </a>
                    <?php } ?>
                    <?php if (!isset($_GET['category']) || $_GET['category'] == '1') { ?>
                        <a href="status_repair.php?category=2" class="btn btn-new btn-new-info">
                            <i class="fa-solid fa-heart-circle-bolt"></i> อุปกรณ์การแพทย์
                        </a>
                    <?php } ?>
                    <?php if (isset($_GET['category']) && $_GET['category'] == '2') { ?>
                        <a href="status_repair.php?category=1" class="btn btn-new btn-new-info">
                            <i class="fa-solid fa-computer"></i> อุปกรณ์คอมพิวเตอร์
                        </a>
                    <?php } ?>
                </div>
                <?php include 'helper/source/table-regis-broken.php' ?>
            </div>
        </section>
    </main>
</body>

</html>