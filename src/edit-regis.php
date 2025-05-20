<?php
require_once 'helper/server/db.php';
session_start();

$device_id = $_GET['device_id'];
$sql = "SELECT *, UPPER(brand) as brand,
            DATE_ADD(device.regis_date, INTERVAL 543 YEAR) as regis_date,
            DATE_ADD(device.transfer_date, INTERVAL 543 YEAR) as transfer_date,
            DATE_ADD(device.change_date, INTERVAL 543 YEAR) as change_date,
            DATE_ADD(device.exp_date, INTERVAL 543 YEAR) as exp_date,
            DATE_ADD(device.warranty_start, INTERVAL 543 YEAR) as warranty_start,
            DATE_ADD(device.warranty_end, INTERVAL 543 YEAR) as warranty_end
        FROM device
        LEFT JOIN category ON device.category_id = category.category_id
        LEFT JOIN mission_group ON device.mission_group_id = mission_group.mission_group_id
        LEFT JOIN work_group ON device.work_group_id = work_group.work_group_id
        LEFT JOIN department ON device.department_id = department.department_id
        LEFT JOIN institute ON device.institute_id = institute.institute_id
        LEFT JOIN building ON device.building_id = building.building_id
        LEFT JOIN floor ON device.floor_id = floor.floor_id
        LEFT JOIN type ON device.type_id = type.type_id
        LEFT JOIN status ON device.status_id = status.status_id
        LEFT JOIN budget_source ON device.budget_source_id = budget_source.budget_source_id
        WHERE device.device_id = :device_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":device_id", $device_id, PDO::PARAM_INT);
$stmt->execute();
$device = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลครุภัณฑ์ที่ <?php echo $device['device_id'] ?></title>
    <?php include 'helper/source/head.php' ?>
</head>

<body>
    <?php include 'helper/source/header.php' ?>
    <main>
        <section>
            <div class="container-fluid mt-3 mx-auto card-con">
                <h2 class="head-info text-center">แก้ไขข้อมูลครุภัณฑ์ที่ <?php echo $device['device_id'] ?></h2>
                <hr>
                <h3 class="head-info">ข้อมูลเบื้องต้น</h3>
                <form id="edit_regis" action="helper/server/edit_regis.php" method="post">
                    <div class="row">
                        <input type="hidden" name="device_id" value="<?php echo $device['device_id']; ?>">
                        <div class="col-lg-12 mb-3">
                            <label for="category_id">หมวดหมู่อุปกรณ์</label>
                            <select class="form-control" name="category_id" id="category_id" onclick="clearBorder(this)">
                                <option value="">-- หมวดหมู่อุปกรณ์ --</option>
                                <?php
                                $sql = "SELECT * FROM category";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($categories as $index => $category) : ?>
                                    <option <?php echo $category['category_id'] == $device['category_id'] ? 'selected' : '' ?> value="<?php echo $category['category_id'] ?>"><?php echo $index + 1 ?>. <?php echo $category['category_name'] ?></option>";
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="regis_number">เลขครุภัณฑ์</label>
                            <input class="form-control" type="text" name="regis_number" id="regis_number" value="<?php echo $device['regis_number'] ?>" placeholder="เลขครุภัณฑ์" onkeydown="clearBorder(this)">
                        </div>
                        <div class="col mb-3" id="mission_group_form">
                            <label for="mission_group_id">กลุ่มภารกิจ</label>
                            <select onchange="updateWorkGroups()" class="form-control" name="mission_group_id" id="mission_group_id" onclick="clearBorder(this)">
                                <option value="">-- กลุ่มภารกิจ --</option>
                                <?php
                                $sql = "SELECT * FROM mission_group";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $mission_groups = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($mission_groups as $index => $mission_group) : ?>
                                    <option <?php echo $mission_group['mission_group_id'] == $device['mission_group_id'] ? 'selected' : '' ?> value="<?php echo $mission_group['mission_group_id'] ?>"><?php echo $index + 1 ?>. <?php echo $mission_group['mission_group_name'] ?></option>";
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col mb-3" id="work_group_form">
                            <label for="work_group_id">กลุ่มงาน</label>
                            <select onchange="updateDepartments()" class="form-control" name="work_group_id" id="work_group_id" onclick="clearBorder(this)">
                                <option value="">-- เลือกกลุ่มงาน --</option>
                            </select>
                        </div>
                        <div class="col mb-3" id="department_form">
                            <label for="department_id">แผนก</label>
                            <select class="form-control" name="department_id" id="department_id" onclick="clearBorder(this)">
                                <option value="">-- เลือกแผนก --</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-lg-12 mb-3" id="institute_form">
                        <label for="institute_id">หน่วยงาน</label>
                        <select class="form-control" name="institute_id" id="institute_id" onclick="clearBorder(this)">
                            <option value="">-- เลือกหน่วยงาน --</option>
                            <?php
                            $sql = "SELECT * FROM institute";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $institutes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($institutes as $index => $institute) : ?>
                                <option <?php echo $category['institute_id'] == $device['institute_id'] ? 'selected' : '' ?> value="<?php echo $institute['institute_id'] ?>"><?php echo $index + 1 ?>. <?php echo $institute['institute_name'] ?></option>";
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col mb-3" id="building_form">
                            <label for="building_id">อาคาร</label>
                            <select onchange="updateFloors()" class="form-control" name="building_id" id="building_id" onclick="clearBorder(this)">
                                <option value="">-- เลือกอาคาร --</option>
                                <?php
                                $sql = "SELECT * FROM building";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $buildings = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($buildings as $index => $building) : ?>
                                    <option <?php echo $building['building_id'] == $device['building_id'] ? 'selected' : '' ?> value="<?php echo $building['building_id'] ?>"><?php echo $index + 1 ?>. <?php echo $building['building_name'] ?></option>";
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col mb-3" id="floor_form">
                            <label for="floor_id">ชั้น</label>
                            <select class="form-control" name="floor_id" id="floor_id" onclick="clearBorder(this)">
                                <option value="">-- เลือกชั้น --</option>
                            </select>
                            <script>
                                function updateWorkGroups() {
                                    const missionGroupId = document.getElementById('mission_group_id').value;
                                    const workGroupSelect = document.getElementById('work_group_id');
                                    const selectedWorkGroupId = "<?php echo $device['work_group_id']; ?>";
                                    workGroupSelect.innerHTML = '<option value="">-- เลือกกลุ่มงาน --</option>';

                                    if (missionGroupId) {
                                        fetch(`helper/api/mission_work/works.php?mission_group_id=${missionGroupId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                data.forEach((workGroup, index) => {
                                                    const option = document.createElement('option');
                                                    option.value = workGroup.work_group_id;
                                                    option.textContent = `${index + 1}. ${workGroup.work_group_name}`;
                                                    if (workGroup.work_group_id == selectedWorkGroupId) {
                                                        option.selected = true;
                                                    }
                                                    workGroupSelect.appendChild(option);
                                                });
                                            });
                                    }
                                }

                                function updateDepartments() {
                                    const workGroupId = document.getElementById('work_group_id').value;
                                    const departmentSelect = document.getElementById('department_id');
                                    const selectedDepartmentId = "<?php echo $device['department_id']; ?>";
                                    departmentSelect.innerHTML = '<option value="">-- เลือกแผนก --</option>';

                                    if (workGroupId) {
                                        fetch(`helper/api/department/department.php?work_group_id=${workGroupId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                data.forEach((department, index) => {
                                                    const option = document.createElement('option');
                                                    option.value = department.department_id;
                                                    option.textContent = `${index + 1}. ${department.department_name}`;
                                                    if (department.department_id == selectedDepartmentId) {
                                                        option.selected = true;
                                                    }
                                                    departmentSelect.appendChild(option);
                                                });
                                            });
                                    }
                                }

                                function updateFloors() {
                                    const buildingId = document.getElementById('building_id').value;
                                    const floorSelect = document.getElementById('floor_id');
                                    const selectedFloorId = "<?php echo $device['floor_id']; ?>";
                                    floorSelect.innerHTML = '<option value="">-- ชั้น --</option>';
                                    if (buildingId) {
                                        fetch(`helper/api/floor/floor.php?building_id=${buildingId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                data.forEach((floor, index) => {
                                                    const option = document.createElement('option');
                                                    option.value = floor.floor_id;
                                                    option.textContent = `${index + 1}. ${floor.floor_name}`;
                                                    if (floor.floor_id == selectedFloorId) {
                                                        option.selected = true;
                                                    }
                                                    floorSelect.appendChild(option);
                                                });
                                            });
                                    }
                                }
                            </script>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3" id="type_form">
                            <label for="type_id">ประเภท</label>
                            <select class="form-control" name="type_id" id="type_id" onclick="clearBorder(this)">
                                <option value="">-- เลือกประเภท --</option>
                                <?php
                                $sql = "SELECT * FROM type";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $types = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($types as $index => $type) : ?>
                                    <option value="<?php echo $type['type_id'] ?>"><?php echo $index + 1 ?>. <?php echo $type['type_name'] ?></option>";
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="brand">ยี่ห้อ</label>
                            <input class="form-control" type="text" name="brand" id="brand" placeholder="ยี่ห้อ" value="<?php echo $device['brand'] ?>" onkeydown="clearBorder(this)">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="model">รุ่น</label>
                            <input class="form-control" type="text" name="model" id="model" placeholder="รุ่น" value="<?php echo $device['model'] ?>" onkeydown="clearBorder(this)">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="serialnumber">Serialnumber</label>
                            <input class="form-control" type="text" name="serialnumber" placeholder="Serialnumber" value="<?php echo $device['serialnumber'] ?>">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="responsible">ผู้รับผิดชอบ</label>
                            <input class="form-control" type="text" name="responsible" id="responsible" placeholder="ผู้รับผิดชอบ" value="<?php echo $device['responsible'] ?>" onkeydown="clearBorder(this)" required>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="status_id">สถานะ</label>
                            <select class="form-control" name="status_id" id="status_id" onclick="clearBorder(this)" required>
                                <option value="">-- เลือกสถานะ --</option>
                                <?php
                                $sql = "SELECT * FROM status";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $statuses = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($statuses as $index => $status) : ?>
                                    <option <?php echo $status['status_id'] == $device['status_id'] ? 'selected' : '' ?> value="<?php echo $status['status_id'] ?>"><?php echo $index + 1 ?>. <?php echo $status['status_name'] ?></option>";

                                <?php endforeach; ?>
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
                                <input class="form-control" type="number" min="2500" max="9999" name="year_received" id="year_received" placeholder="ปีที่รับอุปกรณ์" value="<?php echo $device['year_received'] ?>" onkeydown="clearBorder(this)" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="budget_year">ปีงบประมาณ</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="left">พ.ศ.</span>
                                </div>
                                <input class="form-control" type="text" min="2500" max="9999" name="budget_year" id="budget_year" onkeydown="clearBorder(this)" value="<?php echo $device['budget_year'] ?>" placeholder="ปีงบประมาณ" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="budget_source_id">แหล่งงบประมาณ</label>
                            <select class="form-control" name="budget_source_id" id="budget_source_id" onclick="clearBorder(this)" required>
                                <option value="">-- เลือกแหล่งงบประมาณ --</option>
                                <?php
                                $sql = "SELECT * FROM budget_source";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $budget_sources = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($budget_sources as $index => $budget_source) : ?>
                                    <option <?php echo $budget_source['budget_source_id'] == $device['budget_source_id'] ? "selected" : "" ?> value="<?php echo $budget_source['budget_source_id'] ?>"><?php echo $index + 1 ?>. <?php echo $budget_source['budget_source_name'] ?></option>";
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="old_department">แผนกที่เคยใช้</label>
                            <select class="form-control" name="old_department" id="old_department" onclick="clearBorder(this)">
                                <option value="">-- เลือกแผนก --</option>
                                <?php
                                $sql = "SELECT * FROM department";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $old_departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($old_departments as $index => $old_department) : ?>
                                    <option  <?php echo $old_department['department_id'] == $device['old_department'] ? 'selected' : '' ?> value="<?php echo $old_department['department_id'] ?>"><?php echo $index + 1 ?>. <?php echo $old_department['department_name'] ?></option>";
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="service_life">อายุการใช้งาน</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" name="service_life" id="service_life" value="<?php echo $device['service_life'] ?>" placeholder="อายุการใช้งาน">
                                <div class="input-group-append">
                                    <span class="input-group-text">ปี</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="depreciation">ค่าเสื่อมราคา</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" max="100" step="0.5" value="<?php echo $device['depreciation'] ?>" name="depreciation" id="depreciation" placeholder="ค่าเสื่อมราคา">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="netbook_value">มูลค่าสุทธิตามบัญชี</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" name="netbook_value" value="<?php echo $device['netbook_value'] ?>" id="netbook_value" placeholder="มูลค่าสุทธิตามบัญชี">
                                <div class="input-group-append">
                                    <span class="input-group-text">บาท</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="transfer_date">วันที่โอนมา</label>
                            <input class="form-control" type="date" name="transfer_date" id="transfer_date" value="<?php echo $device['transfer_date'] ?>" placeholder="วันที่โอนมา">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="unit">มูลค่าที่ได้มา</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" name="unit" id="unit" value="<?php echo $device['unit'] ?>" placeholder="จำนวน">
                                <div class="input-group-append">
                                    <span class="input-group-text">บาท</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="change_date">วันที่เกิดการเสื่อม / จำหน่าย</label>
                            <input class="form-control" type="date" name="change_date" id="change_date" value="<?php echo $device['change_date'] ?>" placeholder="วันที่เกิดการเสื่อม / จำหน่าย">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="exp_date">วันหมดอายุ</label>
                            <input class="form-control" type="date" name="exp_date" id="exp_date" value="<?php echo $device['exp_date'] ?>" placeholder="วันหมดอายุ">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="shop">ร้านค้า</label>
                            <input class="form-control" type="text" name="shop" id="shop" value="<?php echo $device['shop'] ?>" placeholder="ร้านค้า">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="warranty_start">วันที่เริ่มรับประกัน</label>
                            <input class="form-control" type="date" name="warranty_start" id="warranty_start" value="<?php echo $device['warranty_start'] ?>" placeholder="วันที่เริ่มรับประกัน">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="warranty">ระยะเวลาประกัน</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" step="30" name="warranty" id="warranty" value="<?php echo $device['warranty'] ?>" placeholder="ระยะเวลาประกัน">
                                <div class="input-group-append">
                                    <span class="input-group-text">วัน</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="warranty_end">วันสิ้นสุดประกัน</label>
                            <input class="form-control" type="date" name="warranty_end" id="warranty_end" value="<?php echo $device['warranty_end'] ?>" placeholder="วันสิ้นสุดประกัน">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="note">หมายเหตุ</label>
                            <input class="form-control" type="text" name="note" id="note" value="<?php echo $device['note'] ?>" placeholder="หมายเหตุ">
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
</body>

</html>