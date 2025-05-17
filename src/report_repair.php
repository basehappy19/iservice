<?php require_once 'helper/server/db.php';
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งซ่อม | โรงพยาบาลเมตตาประชารักษ์ (วัดไร่ขิง)</title>
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
            <div class="container mt-3 mx-auto card-con animate__animated animate__zoomIn animate__fast">
                <form action="helper/server/report_broken.php" id="report" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <h2 class="head-info text-center my-3">รายละเอียดการแจ้งซ่อม</h2>
                        <hr>
                        <h3 class="head-info my-3">ข้อมูลผู้แจ้งซ่อม</h3>
                        <div class="mb-3 col-lg-6">
                            <label for="name" class="form-label">
                                <h5>ชื่อ - นามสกุล</h5>
                            </label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อ - นามสกุลผู้แจ้ง" value="<?php echo isset($data_user['name']) ? $data_user['name'] : ''; ?>" onkeydown="clearBorder(this)" required>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="phone" class="form-label">
                                <h5>เบอร์โทรศัพท์</h5>
                            </label>
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="เบอร์โทรศัพท์">
                        </div>
                        <hr>
                    </div>
                    <h3 class="head-info my-3">รายละเอียดอุปกรณ์</h3>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="category_id">
                                <h5>หมวดหมู่อุปกรณ์</h5>
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
                            <label for="type_id">
                                <h5>ประเภท</h5>
                            </label>
                            <select class="form-control" name="type_id" id="type_id" onclick="clearBorder(this)" required>
                                <option value="">-- เลือกประเภท --</option>
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
                        <div class="col mb-3">
                            <label for="mission_group_id">
                                <h5>กลุ่มภารกิจ</h5>
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
                            <label for="work_group_id">
                                <h5>กลุ่มงาน</h5>
                            </label>
                            <select class="form-control" name="work_group_id" id="work_group_id" onclick="clearBorder(this)" required>
                                <option value="">-- เลือกกลุ่มงาน --</option>
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
                                <h5>แผนก</h5>
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
                            <label for="building_id">
                                <h5>อาคาร</h5>
                            </label>
                            <select class="form-control" name="building_id" id="building_id" onclick="clearBorder(this)" required>
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
                            <label for="floor_id">
                                <h5>ชั้น</h5>
                            </label>
                            <select class="form-control" name="floor_id" id="floor_id" onclick="clearBorder(this)" required>
                                <option value="">-- ชั้น --</option>
                                <?php
                                $floorSql = "SELECT * FROM floor LIMIT 10";
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
                            <label for="regis_number">
                                <h5>เลขครุภัณฑ์</h5>
                            </label>
                            <input class="form-control" type="text" name="regis_number" id="regis_number" placeholder="เลขครุภัณฑ์" onkeydown="clearBorder(this)" required>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="broken">
                                <h5>อาการเสีย</h5>
                            </label>
                            <textarea class="form-control" name="broken" id="broken" rows="2" placeholder="อาการเสีย" onkeydown="clearBorder(this)" required></textarea>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="file">
                                <h5>ภาพ / วิดีโอประกอบ (หากมี)</h5>
                            </label>
                            <input class="form-control" type="file" name="file" id="file" onchange="previewFile()">
                        </div>
                        <div id="preview"></div>
                    </div>
                    <hr>
                    <div>
                        <button type="button" class="btn btn-new btn-new-success" onclick="report()">แจ้งซ่อม <i class="fa-solid fa-screwdriver-wrench"></i></button>
                        <a href="javascript:history.back(1)" class="btn btn-new btn-new-danger">ยกเลิก <i class="fa-solid fa-x"></i></a>
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