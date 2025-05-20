<?php
session_start();
require_once './helper/server/db.php';


?>
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
                                $category_sql = "SELECT * FROM category";
                                $category_stmt = $conn->prepare($category_sql);
                                $category_stmt->execute();
                                $categories = $category_stmt->fetchAll(PDO::FETCH_ASSOC);

                                $icategory = 1;
                                foreach ($categories as $categoryRow) {
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
                                $type_sql = "SELECT * FROM type";
                                $type_stmt = $conn->prepare($type_sql);
                                $type_stmt->execute();
                                $types = $type_stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($types as $index => $type) {
                                    $selected = ($type['type_id'] == $row['type_id']) ? 'selected' : '';
                                    echo "<option value='{$type['type_id']}' $selected>" . ($index + 1) . ". {$type['type_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label for="mission_group_id">
                                <h5>กลุ่มภารกิจ</h5>
                            </label>
                            <select class="form-control" name="mission_group_id" id="mission_group_id" onclick="clearBorder(this)" onchange="updateWorkGroups()" required>
                                <option value="">-- กลุ่มภารกิจ --</option>
                                <?php
                                $mission_group_sql = "SELECT * FROM mission_group";
                                $mission_group_stmt = $conn->prepare($mission_group_sql);
                                $mission_group_stmt->execute();
                                $mission_groups = $mission_group_stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($mission_groups as $index => $mission_group) {
                                    $selected = ($mission_group['mission_group_id'] == $row['mission_group_id']) ? 'selected' : '';
                                    echo "<option value='{$mission_group['mission_group_id']}' $selected>" . ($index + 1) . ". {$mission_group['mission_group_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col mb-3" id="work_group_form">
                            <label for="work_group_id">
                                <h5>กลุ่มงาน</h5>
                            </label>
                            <select class="form-control" name="work_group_id" id="work_group_id" onclick="clearBorder(this)" onchange="updateDepartments()" required>
                                <option value="">-- เลือกกลุ่มงาน --</option>
                            </select>
                        </div>
                        <div class="col mb-3" id="department_form">
                            <label for="department_id">
                                <h5>แผนก</h5>
                            </label>
                            <select class="form-control" name="department_id" id="department_id" onclick="clearBorder(this)" required>
                                <option value="">-- เลือกแผนก --</option>
                            </select>
                        </div>

                        <script>
                            function updateWorkGroups() {
                                const missionGroupId = document.getElementById('mission_group_id').value;
                                const workGroupSelect = document.getElementById('work_group_id');
                                workGroupSelect.innerHTML = '<option value="">-- เลือกกลุ่มงาน --</option>';

                                if (missionGroupId) {
                                    fetch(`helper/api/mission_work/works.php?mission_group_id=${missionGroupId}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            data.forEach((workGroup, index) => {
                                                const option = document.createElement('option');
                                                option.value = workGroup.work_group_id;
                                                option.textContent = `${index + 1}. ${workGroup.work_group_name}`;
                                                workGroupSelect.appendChild(option);
                                            });
                                        });
                                }
                            }

                            function updateDepartments() {
                                const workGroupId = document.getElementById('work_group_id').value;
                                const departmentSelect = document.getElementById('department_id');
                                departmentSelect.innerHTML = '<option value="">-- เลือกแผนก --</option>';

                                if (workGroupId) {
                                    fetch(`helper/api/department/department.php?work_group_id=${workGroupId}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            data.forEach((department, index) => {
                                                const option = document.createElement('option');
                                                option.value = department.department_id;
                                                option.textContent = `${index + 1}. ${department.department_name}`;
                                                departmentSelect.appendChild(option);
                                            });
                                        });
                                }
                            }
                        </script>
                    </div>
                    <div class="row">
                        <div class="col mb-3" id="building_form">
                            <label for="building_id">
                                <h5>อาคาร</h5>
                            </label>
                            <select class="form-control" name="building_id" id="building_id" onclick="clearBorder(this)" onchange="updateFloors()" required>
                                <option value="">-- อาคาร --</option>
                                <?php
                                $building_sql = "SELECT * FROM building";
                                $building_stmt = $conn->prepare($building_sql);
                                $building_stmt->execute();
                                $buildings = $building_stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($buildings as $index => $building) {
                                    $selected = ($building['building_id'] == $row['building_id']) ? 'selected' : '';
                                    echo "<option value='{$building['building_id']}' $selected>" . ($index + 1) . ". {$building['building_name']}</option>";
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
                            </select>
                            <script>
                                function updateFloors() {
                                    const buildingId = document.getElementById('building_id').value;
                                    const floorSelect = document.getElementById('floor_id');
                                    floorSelect.innerHTML = '<option value="">-- ชั้น --</option>';
                                    if (buildingId) {
                                        fetch(`helper/api/floor/floor.php?building_id=${buildingId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                data.forEach((floor, index) => {
                                                    const option = document.createElement('option');
                                                    option.value = floor.floor_id;
                                                    option.textContent = `${index + 1}. ${floor.floor_name}`;
                                                    floorSelect.appendChild(option);
                                                });
                                            });
                                    }
                                }
                            </script>
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


</body>

</html>