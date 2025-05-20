<?php
require_once 'helper/server/db.php';
session_start();

if (isset($_GET['category'])) {

    $selected_category = $_GET['category'];

    $sql = "SELECT *, UPPER(brand) as brand,
                    DATE_ADD(device.regis_date, INTERVAL 543 YEAR) as regis_date,
                    DATE_ADD(device.transfer_date, INTERVAL 543 YEAR) as transfer_date,
                    DATE_ADD(device.change_date, INTERVAL 543 YEAR) as change_date,
                    DATE_ADD(device.exp_date, INTERVAL 543 YEAR) as exp_date,
                    DATE_ADD(device.warranty_start, INTERVAL 543 YEAR) as warranty_start,
                    DATE_ADD(device.warranty_end, INTERVAL 543 YEAR) as warranty_end
                FROM device
                INNER JOIN category ON device.category_id = category.category_id
                INNER JOIN mission_group ON device.mission_group_id = mission_group.mission_group_id
                INNER JOIN work_group ON device.work_group_id = work_group.work_group_id
                INNER JOIN department ON device.department_id = department.department_id
                INNER JOIN institute ON device.institute_id = institute.institute_id
                INNER JOIN building ON device.building_id = building.building_id
                INNER JOIN floor ON device.floor_id = floor.floor_id
                INNER JOIN type ON device.type_id = type.type_id
                INNER JOIN status ON device.status_id = status.status_id
                INNER JOIN budget_source ON device.budget_source_id = budget_source.budget_source_id
                WHERE category.category_id = :category_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":category_id", $selected_category, PDO::PARAM_INT);
    $stmt->execute();
    $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {

    $sql = "SELECT *, UPPER(brand) as brand,
                DATE_ADD(device.regis_date, INTERVAL 543 YEAR) as regis_date,
                DATE_ADD(device.transfer_date, INTERVAL 543 YEAR) as transfer_date,
                DATE_ADD(device.change_date, INTERVAL 543 YEAR) as change_date,
                DATE_ADD(device.exp_date, INTERVAL 543 YEAR) as exp_date,
                DATE_ADD(device.warranty_start, INTERVAL 543 YEAR) as warranty_start,
                DATE_ADD(device.warranty_end, INTERVAL 543 YEAR) as warranty_end
            FROM device
            INNER JOIN category ON device.category_id = category.category_id
            INNER JOIN mission_group ON device.mission_group_id = mission_group.mission_group_id
            INNER JOIN work_group ON device.work_group_id = work_group.work_group_id
            INNER JOIN department ON device.department_id = department.department_id
            INNER JOIN institute ON device.institute_id = institute.institute_id
            INNER JOIN building ON device.building_id = building.building_id
            INNER JOIN floor ON device.floor_id = floor.floor_id
            INNER JOIN type ON device.type_id = type.type_id
            INNER JOIN status ON device.status_id = status.status_id
            INNER JOIN budget_source ON device.budget_source_id = budget_source.budget_source_id
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ทะเบียนครุภัณฑ์ | โรงพยาบาลเมตตาประชารักษ์ (วัดไร่ขิง)</title>
    <?php include 'helper/source/head.php' ?>
</head>

<body>
    <?php include 'helper/source/header.php' ?>
    <main>
        <section>
            <div class="container-fluid mt-3 mx-auto card-con">
                <h1 class="head-info text-center my-3">
                    <?php if (!isset($_GET['category'])) { ?>
                        ทะเบียนครุภัณฑ์ ทั้งหมด
                    <?php } ?>
                    <?php if (isset($_GET['category']) && $_GET['category'] == '1') { ?>
                        ทะเบียนครุภัณฑ์ อุปกรณ์คอมพิวเตอร์
                    <?php } elseif (isset($_GET['category']) && $_GET['category'] == '2') { ?>
                        ทะเบียนครุภัณฑ์ อุปกรณ์การแพทย์
                    <?php } ?>
                </h1>
                <div class="text-center m-3">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == '3') { ?>
                        <button type="button" class="btn btn-new btn-new-success" data-toggle="modal" data-target="#addModal">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    <?php } ?>
                    <?php if (isset($_GET['category']) && $_GET['category'] == '1') { ?>
                        <a href="list-item.php" class="btn btn-new btn-new-info">
                            <i class="fa-solid fa-list"></i> ทั้งหมด
                        </a>
                    <?php } ?>
                    <?php if (!isset($selected_category) || $selected_category == '1') { ?>
                        <a href="list-item.php?category=2" class="btn btn-new btn-new-info">
                            <i class="fa-solid fa-heart-circle-bolt"></i> อุปกรณ์การแพทย์
                        </a>
                    <?php } else {
                        (isset($selected_category) || $selected_category == '2') ?>
                        <a href="list-item.php?category=1" class="btn btn-new btn-new-info">
                            <i class="fa-solid fa-computer"></i> อุปกรณ์คอมพิวเตอร์
                        </a>
                    <?php } ?>

                </div>
                <?php include 'helper/source/table-regis.php' ?>
                <?php include 'helper/source/modal-add-regis.php' ?>
            </div>
        </section>
    </main>
    <?php include_once 'helper/API/building_floor/floors.php' ?>
    <?php include_once 'helper/API/mission_work/works.php' ?>
    <?php include_once 'helper/API/department/department.php' ?>
    <?php include_once 'helper/API/category/category.php' ?>
</body>

</html>