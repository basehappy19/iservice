<?php
require_once 'helper/server/db.php';
session_start();

$device_id = $_GET['device_id'];
$query = "SELECT * FROM device WHERE device_id = '$device_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลครุภัณฑ์ที่ <?php echo $row['device_id'] ?></title>
    <?php include 'helper/source/head.php' ?>
</head>

<body>
    <?php include 'helper/source/header.php' ?>
    <main>
        <section>
            <div class="container-fluid mt-3 mx-auto card-con">
                <h2 class="head-info text-center">แก้ไขข้อมูลครุภัณฑ์ที่ <?php echo $row['device_id'] ?></h2>
                <hr>
                <h3 class="head-info">ข้อมูลเบื้องต้น</h3>
                <form id="edit_regis" action="helper/server/edit_regis.php" method="post">
                    <div class="row">
                        <input type="hidden" name="device_id" value="<?php echo $row['device_id']; ?>">
                        <div class="col-lg-12 mb-3">
                            <label for="category_id">หมวดหมู่อุปกรณ์</label>
                            <select class="form-control" name="category_id" id="category_id" onclick="clearBorder(this)">
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
                            <label for="regis_number">เลขครุภัณฑ์</label>
                            <input class="form-control" type="text" name="regis_number" id="regis_number" value="<?php echo $row['regis_number'] ?>" placeholder="เลขครุภัณฑ์" onkeydown="clearBorder(this)">
                        </div>
                        <div class="col mb-3" id="mission_group_form">
                            <label for="mission_group_id">กลุ่มภารกิจ</label>
                            <select class="form-control" name="mission_group_id" id="mission_group_id" onclick="clearBorder(this)">
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
                                <option value="">-- เลือกแผนก --</option>
                                <?php
                                $workGroupSql = "SELECT * FROM work_group";
                                $workGroupStmt = mysqli_prepare($conn, $workGroupSql);
                                mysqli_stmt_execute($workGroupStmt);
                                $workGroupData = mysqli_stmt_get_result($workGroupStmt);

                                $iworkGroup = 1;

                                while ($workGroupRow = mysqli_fetch_assoc($workGroupData)) {
                                    $selected = ($workGroupRow['work_group_id'] == $row['work_group_id']) ? 'selected' : '';
                                    echo "<option value='{$workGroupRow['work_group_id']}' $selected>{$iworkGroup}. {$workGroupRow['work_group_name']}</option>";
                                    $iworkGroup++;
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col mb-3" id="department_form">
                            <label for="department_id">แผนก</label>
                            <select class="form-control" name="department_id" id="department_id" onclick="clearBorder(this)">
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
                    <div class="col-lg-12 mb-3" id="institute_form">
                        <label for="institute_id">หน่วยงาน</label>
                        <select class="form-control" name="institute_id" id="institute_id" onclick="clearBorder(this)">
                            <option value="">-- เลือกอาคาร --</option>
                            <?php
                            $instituteSql = "SELECT * FROM institute";
                            $instituteStmt = mysqli_prepare($conn, $instituteSql);
                            mysqli_stmt_execute($instituteStmt);
                            $instituteData = mysqli_stmt_get_result($instituteStmt);

                            $iinstitute = 1;

                            while ($instituteRow = mysqli_fetch_assoc($instituteData)) {
                                $selected = ($instituteRow['institute_id'] == $row['institute_id']) ? 'selected' : '';
                                echo "<option value='{$instituteRow['institute_id']}' $selected>{$iinstitute}. {$instituteRow['institute_name']}</option>";
                                $ibuilding++;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col mb-3" id="building_form">
                            <label for="building_id">อาคาร</label>
                            <select class="form-control" name="building_id" id="building_id" onclick="clearBorder(this)">
                                <option value="">-- เลือกอาคาร --</option>
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
                                <option value="">-- เลือกชั้น --</option>
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
                        <div class="col-lg-12 mb-3" id="type_form">
                            <label for="type_id">ประเภท</label>
                            <select class="form-control" name="type_id" id="type_id" onclick="clearBorder(this)">
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
                        <div class="col-lg-4 mb-3">
                            <label for="brand">ยี่ห้อ</label>
                            <input class="form-control" type="text" name="brand" id="brand" placeholder="ยี่ห้อ" value="<?php echo $row['brand'] ?>" onkeydown="clearBorder(this)">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="model">รุ่น</label>
                            <input class="form-control" type="text" name="model" id="model" placeholder="รุ่น" value="<?php echo $row['model'] ?>" onkeydown="clearBorder(this)">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="serialnumber">Serialnumber</label>
                            <input class="form-control" type="text" name="serialnumber" placeholder="Serialnumber" value="<?php echo $row['serialnumber'] ?>">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="responsible">ผู้รับผิดชอบ</label>
                            <input class="form-control" type="text" name="responsible" id="responsible" placeholder="ผู้รับผิดชอบ" value="<?php echo $row['responsible'] ?>" onkeydown="clearBorder(this)" required>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="status_id">สถานะ</label>
                            <select class="form-control" name="status_id" id="status_id" onclick="clearBorder(this)" required>
                                <option value="">-- เลือกสถานะ --</option>
                                <?php
                                $statusSql = "SELECT * FROM status";
                                $statusStmt = mysqli_prepare($conn, $statusSql);
                                mysqli_stmt_execute($statusStmt);
                                $statusData = mysqli_stmt_get_result($statusStmt);


                                while ($statusRow = mysqli_fetch_assoc($statusData)) {
                                    $selectedStatus = ($statusRow['status_id'] == $row['status_id']) ? 'selected' : '';
                                    echo "<option value='{$statusRow['status_id']}' $selectedStatus>{$statusRow['status_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <hr>
                        <h3 class="head-info">ข้อมูลเพิ่มเติม</h3>
                        <div class="col-lg-4 mb-3">
                            <label for="year_received">ปีที่รับอุปกรณ์</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="left">พ.ศ.</span>
                                </div>
                                <input class="form-control" type="number" min="2500" max="9999" name="year_received" id="year_received" placeholder="ปีที่รับอุปกรณ์" value="<?php echo $row['year_received'] ?>" onkeydown="clearBorder(this)" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="budget_year">ปีงบประมาณ</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="left">พ.ศ.</span>
                                </div>
                                <input class="form-control" type="text" min="2500" max="9999" name="budget_year" id="budget_year" onkeydown="clearBorder(this)" value="<?php echo $row['budget_year'] ?>" placeholder="ปีงบประมาณ" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="budget_source_id">แหล่งงบประมาณ</label>
                            <select class="form-control" name="budget_source_id" id="budget_source_id" onclick="clearBorder(this)" required>
                                <option value="">-- เลือกแหล่งงบประมาณ --</option>
                                <?php
                                $budgetSourceSql = "SELECT * FROM budget_source";
                                $budgetSourceStmt = mysqli_prepare($conn, $budgetSourceSql);
                                mysqli_stmt_execute($budgetSourceStmt);
                                $budgetSourceData = mysqli_stmt_get_result($budgetSourceStmt);

                                $ibudgetSource = 1;
                                while ($budgetSourceRow = mysqli_fetch_assoc($budgetSourceData)) {
                                    $selectedBudgetSource = ($budgetSourceRow['budget_source_id'] == $row['budget_source_id']) ? 'selected' : '';
                                    echo "<option value='{$budgetSourceRow['budget_source_id']}' $selectedBudgetSource>{$ibudgetSource}. {$budgetSourceRow['budget_source_name']}</option>";
                                    $ibudgetSource++;
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="old_department">แผนกที่เคยใช้</label>
                            <select class="form-control" name="old_department" id="old_department" onclick="clearBorder(this)">
                                <option value="">-- เลือกแผนก --</option>
                                <?php
                                $departmentSql = "SELECT * FROM department";
                                $departmentStmt = mysqli_prepare($conn, $departmentSql);
                                mysqli_stmt_execute($departmentStmt);
                                $departmentData = mysqli_stmt_get_result($departmentStmt);

                                $idepartment = 1;

                                while ($departmentRow = mysqli_fetch_assoc($departmentData)) {
                                    $selected = ($departmentRow['department_id'] == $row['department_id']) ? 'selected' : '';
                                    echo "<option value='{$departmentRow['department_name']}' $selected>{$idepartment}. {$departmentRow['department_name']}</option>";
                                    $idepartment++;
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="service_life">อายุการใช้งาน</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" name="service_life" id="service_life" value="<?php echo $row['service_life'] ?>" placeholder="อายุการใช้งาน">
                                <div class="input-group-append">
                                    <span class="input-group-text">ปี</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="depreciation">ค่าเสื่อมราคา</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" max="100" step="0.5" value="<?php echo $row['depreciation'] ?>" name="depreciation" id="depreciation" placeholder="ค่าเสื่อมราคา">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="netbook_value">มูลค่าสุทธิตามบัญชี</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" name="netbook_value" value="<?php echo $row['netbook_value'] ?>" id="netbook_value" placeholder="มูลค่าสุทธิตามบัญชี">
                                <div class="input-group-append">
                                    <span class="input-group-text">บาท</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="transfer_date">วันที่โอนมา</label>
                            <input class="form-control" type="date" name="transfer_date" id="transfer_date" value="<?php echo $row['transfer_date'] ?>" placeholder="วันที่โอนมา">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="unit">มูลค่าที่ได้มา</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" name="unit" id="unit" value="<?php echo $row['unit'] ?>" placeholder="จำนวน">
                                <div class="input-group-append">
                                    <span class="input-group-text">บาท</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="change_date">วันที่เกิดการเสื่อม / จำหน่าย</label>
                            <input class="form-control" type="date" name="change_date" id="change_date" value="<?php echo $row['change_date'] ?>" placeholder="วันที่เกิดการเสื่อม / จำหน่าย">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="exp_date">วันหมดอายุ</label>
                            <input class="form-control" type="date" name="exp_date" id="exp_date" value="<?php echo $row['exp_date'] ?>" placeholder="วันหมดอายุ">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="shop">ร้านค้า</label>
                            <input class="form-control" type="text" name="shop" id="shop" value="<?php echo $row['shop'] ?>" placeholder="ร้านค้า">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="warranty_start">วันที่เริ่มรับประกัน</label>
                            <input class="form-control" type="date" name="warranty_start" id="warranty_start" value="<?php echo $row['warranty_start'] ?>" placeholder="วันที่เริ่มรับประกัน">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="warranty">ระยะเวลาประกัน</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" step="30" name="warranty" id="warranty" value="<?php echo $row['warranty'] ?>" placeholder="ระยะเวลาประกัน">
                                <div class="input-group-append">
                                    <span class="input-group-text">วัน</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="warranty_end">วันสิ้นสุดประกัน</label>
                            <input class="form-control" type="date" name="warranty_end" id="warranty_end" value="<?php echo $row['warranty_end'] ?>" placeholder="วันสิ้นสุดประกัน">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="note">หมายเหตุ</label>
                            <input class="form-control" type="text" name="note" id="note" value="<?php echo $row['note'] ?>" placeholder="หมายเหตุ">
                        </div>
                        <hr>
                        <div>
                            <button type="button" onclick="edit_regis()" class="btn btn-new btn-new-success">แก้ไข <i class="fa-solid fa-pencil"></i></button>
                            <a href="list-item.php" class="btn btn-new btn-new-danger">
                                ยกเลิก <i class="fa-solid fa-x"></i>
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