<?php
require_once 'helper/server/db.php';
session_start();

$device_id = $_GET['device_id'];
$query = "SELECT * FROM device_broken WHERE device_id = '$device_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลแจ้งซ่อมที่ <?php echo $row['device_id'] ?></title>
    <?php include 'helper/source/head.php' ?>
</head>

<body>
    <?php include 'helper/source/header.php' ?>
    <main>
        <section>
            <div class="container-fluid mt-3 mx-auto card-con">
                <h2 class="head-info text-center">แก้ไขข้อมูลแจ้งซ่อมที่ <?php echo $row['device_id'] ?></h2>
                <hr>
                <h3 class="head-info">ข้อมูลผู้แจ้งซ่อม</h3>
                <form id="edit_regis_broken" action="helper/server/edit_regis_broken.php" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="device_id" value="<?php echo $row['device_id']; ?>">
                            <div class="col-lg-12 mb-3">
                                <label for="name_broken">ชื่อผู้แจ้ง</label>
                                <input class="form-control" type="text" name="name" id="name_broken" value="<?php echo $row['name']; ?>" onclick="clearBorder(this)">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="phone" class="form-label">
                                    เบอร์โทรศัพท์
                                </label>
                                <input type="tel" class="form-control" name="phone" id="phone" placeholder="เบอร์โทรศัพท์" value="<?php echo $row['phone']; ?>">
                            </div>
                            <hr>
                            <h3 class="head-info">รายละเอียดอุปกรณ์</h3>
                            <div class="col mb-3">
                                <label for="mission_group_id">
                                    กลุ่มภารกิจ
                                </label>
                                <select class="form-control" name="mission_group_id" id="mission_group_id" onclick="clearBorder(this)" required>
                                    <option value="">-- กลุ่มภารกิจ --</option>
                                    <?php
                                    $missionGroupSql = "SELECT * FROM mission_group";
                                    $missionGroupStmt = mysqli_prepare($conn, $missionGroupSql);
                                    mysqli_stmt_execute($missionGroupStmt);
                                    $missionGroupData = mysqli_stmt_get_result($missionGroupStmt);

                                    $imissionGroup = 1;

                                    while ($missionGroupRow = mysqli_fetch_assoc($missionGroupData)) {
                                        $selected = ($missionGroupRow['mission_group_id'] == $row['mission_group_id']) ? 'selected' : '';
                                        echo "<option value='{$missionGroupRow['mission_group_id']}' $selected>{$imissionGroup}. {$missionGroupRow['mission_group_name']}</option>";
                                        $imissionGroup++;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col mb-3" id="work_group_form">
                                <label for="work_group_id">กลุ่มงาน</label>
                                <select class="form-control" name="work_group_id" id="work_group_id" onclick="clearBorder(this)">
                                    <?php
                                    $workGroupSql = "SELECT * FROM work_group";
                                    $workGroupStmt = mysqli_prepare($conn, $workGroupSql);
                                    mysqli_stmt_execute($workGroupStmt);
                                    $workGroupData = mysqli_stmt_get_result($workGroupStmt);

                                    $iworkgroup = 1;

                                    while ($workGroupRow = mysqli_fetch_assoc($workGroupData)) {
                                        $selected = ($workGroupRow['work_group_id'] == $row['work_group_id']) ? 'selected' : '';
                                        echo "<option value='{$workGroupRow['work_group_id']}' $selected>{$iworkgroup}. {$workGroupRow['work_group_name']}</option>";
                                        $iworkgroup++;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col mb-3" id="department_form">
                                <label for="department_id">
                                    แผนก
                                </label>
                                <select class="form-control" name="department_id" id="department_id" onclick="clearBorder(this)" required>
                                    <option value="">-- เลือกแผนก --</option>
                                    <?php
                                    $departmentSql = "SELECT * FROM department";
                                    $departmentStmt = mysqli_prepare($conn, $departmentSql);
                                    mysqli_stmt_execute($departmentStmt);
                                    $departmentData = mysqli_stmt_get_result($departmentStmt);

                                    $idepartment = 1;

                                    while ($departmentRow = mysqli_fetch_assoc($departmentData)) {
                                        $selected = ($departmentRow['department_id'] == $row['department_id']) ? 'selected' : '';
                                        echo "<option value='{$departmentRow['department_id']}' $selected>{$idepartment}. {$departmentRow['department_name']}</option>";
                                        $idepartment++;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3" id="building_form">
                                <label for="building_id">อาคาร</label>
                                <select class="form-control" name="building_id" id="building_id" onclick="clearBorder(this)">
                                    <option value="">-- อาคาร --</option>
                                    <?php
                                    $buildingSql = "SELECT * FROM building";
                                    $buildingStmt = mysqli_prepare($conn, $buildingSql);
                                    mysqli_stmt_execute($buildingStmt);
                                    $buildingData = mysqli_stmt_get_result($buildingStmt);

                                    $ibuilding = 1;

                                    while ($buildingRow = mysqli_fetch_assoc($buildingData)) {
                                        $selected = ($buildingRow['building_id'] == $row['building_id']) ? 'selected' : '';
                                        echo "<option value='{$buildingRow['building_id']}' $selected>{$ibuilding}. {$buildingRow['building_name']}</option>";
                                        $ibuilding++;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col mb-3" id="floor_form">
                                <label for="floor_id">ชั้น</label>
                                <select class="form-control" name="floor_id" id="floor_id" onclick="clearBorder(this)">
                                    <?php
                                    $floorSql = "SELECT * FROM floor";
                                    $floorStmt = mysqli_prepare($conn, $floorSql);
                                    mysqli_stmt_execute($floorStmt);
                                    $floorData = mysqli_stmt_get_result($floorStmt);


                                    while ($floorRow = mysqli_fetch_assoc($floorData)) {
                                        $selected = ($floorRow['floor_id'] == $row['floor_id']) ? 'selected' : '';
                                        echo "<option value='{$floorRow['floor_id']}' $selected>{$floorRow['floor_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="category_id">
                                    หมวดหมู่อุปกรณ์
                                </label>
                                <select class="form-control" name="category_id" id="category_id" onclick="clearBorder(this)" required>
                                    <option value="">-- หมวดหมู่อุปกรณ์ --</option>
                                    <?php
                                    $categorySql = "SELECT * FROM category";
                                    $categoryStmt = mysqli_prepare($conn, $categorySql);
                                    mysqli_stmt_execute($categoryStmt);
                                    $categoryData = mysqli_stmt_get_result($categoryStmt);

                                    $icategory = 1;

                                    while ($categoryRow = mysqli_fetch_assoc($categoryData)) {
                                        $selected = ($categoryRow['category_id'] == $row['category_id']) ? 'selected' : '';
                                        echo "<option value='{$categoryRow['category_id']}' $selected>{$icategory}. {$categoryRow['category_name']}</option>";
                                        $icategory++;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="type_id">ประเภท</label>
                                <select class="form-control" name="type_id" id="type_id" onclick="clearBorder(this)">
                                    <option value="">-- ประเภท --</option>
                                    <?php
                                    $typeSql = "SELECT * FROM type";
                                    $typeStmt = mysqli_prepare($conn, $typeSql);
                                    mysqli_stmt_execute($typeStmt);
                                    $typeData = mysqli_stmt_get_result($typeStmt);

                                    $itype = 1;
                                    while ($typeRow = mysqli_fetch_assoc($typeData)) {
                                        $selected = ($typeRow['type_id'] == $row['type_id']) ? 'selected' : '';
                                        echo "<option value='{$typeRow['type_id']}' $selected>{$itype}. {$typeRow['type_name']}</option>";
                                        $itype++;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="regis_number">เลขครุภัณฑ์</label>
                                <input class="form-control" type="text" name="regis_number" id="regis_number_broken" value="<?php echo $row['regis_number']; ?>">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="broken">อาการเสีย</label>
                                <textarea class="form-control" name="broken" id="broken_broken" rows="2" placeholder="อาการเสีย" value="<?php echo $row['broken']; ?>" onkeydown="clearBorder(this)"></textarea>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="status_id">สถานะ</label>
                                <select class="form-control" name="status_repair_id" id="status_repair_id_broken">
                                    <?php
                                    $status_repairSql = "SELECT * FROM status_repair";
                                    $status_repairStmt = mysqli_prepare($conn, $status_repairSql);
                                    mysqli_stmt_execute($status_repairStmt);
                                    $status_repairData = mysqli_stmt_get_result($status_repairStmt);


                                    while ($status_repairRow = mysqli_fetch_assoc($status_repairData)) {
                                        $selectedStatus_repair = ($status_repairRow['status_repair_id'] == $row['status_repair_id']) ? 'selected' : '';
                                        echo "<option value='{$status_repairRow['status_repair_id']}' $selectedStatus_repair>{$status_repairRow['status_repair_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <button type="button" onclick="edit_regis_broken()" class="btn btn-new btn-new-success">แก้ไข <i class="fa-solid fa-pencil"></i></button>
                            <a href="status_repair" class="btn btn-new btn-new-danger">
                                <span aria-hidden="true">ยกเลิก <i class="fa-solid fa-x"></i></span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php include_once 'helper/API/building_floor/floors.php' ?>
    <?php include_once 'helper/API/mission_work/works.php' ?>
    <?php include_once 'helper/API/department/department.php' ?>
    <?php include_once 'helper/API/category/category.php' ?>
</body>

</html>