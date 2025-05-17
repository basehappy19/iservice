<?php
require_once 'helper/server/db.php';
session_start();

$status_id = isset($_GET['status_id']) ? $_GET['status_id'] : null;

if (isset($_GET['category'])) {
    $selected_category = $_GET['category'];
    $sql = "SELECT *,
                DATE_ADD(report.date_report_broken, INTERVAL 543 YEAR) as date_report_broken_adjusted,
                DATE_ADD(report.date_success_fix, INTERVAL 543 YEAR) as date_success_fix_adjusted
            FROM report
            INNER JOIN category ON report.category_id = category.category_id
            INNER JOIN mission_group ON report.mission_group_id = mission_group.mission_group_id
            INNER JOIN work_group ON report.work_group_id = work_group.work_group_id
            INNER JOIN department ON report.department_id = department.department_id
            INNER JOIN building ON report.building_id = building.building_id
            INNER JOIN floor ON report.floor_id = floor.floor_id
            INNER JOIN type ON report.type_id = type.type_id
            INNER JOIN status_repair ON report.status_repair_id = status_repair.status_repair_id
            WHERE category.category_id = ?
    ";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $selected_category);
    mysqli_stmt_execute($stmt);

    $data = mysqli_stmt_get_result($stmt);
} else {
    $sql = "SELECT *,
                DATE_ADD(report.date_report_broken, INTERVAL 543 YEAR) as date_report_broken_adjusted,
                DATE_ADD(report.date_success_fix, INTERVAL 543 YEAR) as date_success_fix_adjusted
            FROM report
            INNER JOIN category ON report.category_id = category.category_id
            INNER JOIN mission_group ON report.mission_group_id = mission_group.mission_group_id
            INNER JOIN work_group ON report.work_group_id = work_group.work_group_id
            INNER JOIN department ON report.department_id = department.department_id
            INNER JOIN building ON report.building_id = building.building_id
            INNER JOIN floor ON report.floor_id = floor.floor_id
            INNER JOIN type ON report.type_id = type.type_id
            INNER JOIN status_repair ON report.status_repair_id = status_repair.status_repair_id
    ";

    if (!empty($status_id)) {
        $sql .= " WHERE report.status_repair_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $status_id);
    } else {
        $stmt = mysqli_prepare($conn, $sql);
    }

    mysqli_stmt_execute($stmt);

    $data = mysqli_stmt_get_result($stmt);
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
                        <a href="status_repair" class="btn btn-new btn-new-info">
                            <i class="fa-solid fa-list"></i> ทั้งหมด
                        </a>
                    <?php } ?>
                    <?php if (!isset($_GET['category']) || $_GET['category'] == '1') { ?>
                        <a href="status_repair?category=2" class="btn btn-new btn-new-info">
                            <i class="fa-solid fa-heart-circle-bolt"></i> อุปกรณ์การแพทย์
                        </a>
                    <?php } ?>
                    <?php if (isset($_GET['category']) && $_GET['category'] == '2') { ?>
                        <a href="status_repair?category=1" class="btn btn-new btn-new-info">
                            <i class="fa-solid fa-computer"></i> อุปกรณ์คอมพิวเตอร์
                        </a>
                    <?php } ?>
                </div>
                <?php include 'helper/source/table-regis-broken.php' ?>
                <?php include_once 'helper/API/building_floor/floors.php' ?>
                <?php include_once 'helper/API/mission_work/works.php' ?>
                <?php include_once 'helper/API/department/department.php' ?>
                <?php include_once 'helper/API/category/category.php' ?>
            </div>
        </section>
    </main>
</body>

</html>