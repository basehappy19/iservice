<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="head-info text-center">เพิ่มข้อมูลครุภัณฑ์</h2>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="head-info">ข้อมูลเบื้องต้น</h3>
                <form id="add_regis" action="./helper/server/add_regis.php" method="post">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="category_id">หมวดหมู่อุปกรณ์</label>
                            <select class="form-control" name="category_id" id="category_id" onclick="clearBorder(this)" required>
                                <option value="">-- หมวดหมู่อุปกรณ์ --</option>
                                <?php
                                $sql = "SELECT * FROM category";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($categories as $index => $category) : ?>
                                    <option value="<?php echo $category['category_id'] ?>"><?php echo $index + 1 ?>. <?php echo $category['category_name'] ?></option>";
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="regis_number">เลขครุภัณฑ์</label>
                            <input class="form-control" type="text" name="regis_number" id="regis_number" placeholder="เลขครุภัณฑ์" onkeydown="clearBorder(this)" required>
                        </div>
                        <div class="col mb-3" id="mission_group_form">
                            <label for="mission_group_id">กลุ่มภารกิจ</label>
                            <select onchange="updateWorkGroups()" class="form-control" name="mission_group_id" id="mission_group_id" onclick="clearBorder(this)" required>
                                <option value="">-- กลุ่มภารกิจ --</option>
                                <?php
                                $sql = "SELECT * FROM mission_group";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $mission_groups = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($mission_groups as $index => $mission_group) : ?>
                                    <option value="<?php echo $mission_group['mission_group_id'] ?>"><?php echo $index + 1 ?>. <?php echo $mission_group['mission_group_name'] ?></option>";
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col mb-3" id="work_group_form">
                            <label for="work_group_id">กลุ่มงาน</label>
                            <select onchange="updateDepartments()" class="form-control" name="work_group_id" id="work_group_id" onclick="clearBorder(this)" required>
                                <option value="">-- เลือกกลุ่มงาน --</option>
                            </select>
                        </div>
                        <div class="col mb-3" id="department_form">
                            <label for="department_id">แผนก</label>
                            <select class="form-control" name="department_id" id="department_id" onclick="clearBorder(this)" required>
                                <option value="">-- เลือกแผนก --</option>
                            </select>
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
                                <option value="<?php echo $institute['institute_id'] ?>"><?php echo $index + 1 ?>. <?php echo $institute['institute_name'] ?></option>";
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col mb-3" id="building_form">
                            <label for="building_id">อาคาร</label>
                            <select onchange="updateFloors()" class="form-control" name="building_id" id="building_id" onclick="clearBorder(this)" required>
                                <option value="">-- เลือกอาคาร --</option>
                                <?php
                                $sql = "SELECT * FROM building";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $buildings = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($buildings as $index => $building) : ?>
                                    <option value="<?php echo $building['building_id'] ?>"><?php echo $index + 1 ?>. <?php echo $building['building_name'] ?></option>";
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col mb-3" id="floor_form">
                            <label for="floor_id">ชั้น</label>
                            <select class="form-control" name="floor_id" id="floor_id" onclick="clearBorder(this)" required>
                                <option value="">-- เลือกชั้น --</option>
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
                        <div class="col-lg-12 mb-3" id="type_form">
                            <label for="type_id">ประเภท</label>
                            <select class="form-control" name="type_id" id="type_id" onclick="clearBorder(this)" required>
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
                            <input class="form-control" type="text" name="brand" id="brand" placeholder="ยี่ห้อ" onkeydown="clearBorder(this)" required>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="model">รุ่น</label>
                            <input class="form-control" type="text" name="model" id="model" placeholder="รุ่น" onkeydown="clearBorder(this)" required>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="serialnumber">Serialnumber</label>
                            <input class="form-control" type="text" name="serialnumber" placeholder="Serialnumber">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="responsible">ผู้รับผิดชอบ</label>
                            <input class="form-control" type="text" name="responsible" id="responsible" placeholder="ผู้รับผิดชอบ" onkeydown="clearBorder(this)" required>
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
                                    <option value="<?php echo $status['status_id'] ?>"><?php echo $index + 1 ?>. <?php echo $status['status_name'] ?></option>";

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
                                <input class="form-control" type="number" min="2500" max="9999" name="year_received" id="year_received" placeholder="ปีที่รับอุปกรณ์" onkeydown="clearBorder(this)" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="budget_year">ปีงบประมาณ</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="left">พ.ศ.</span>
                                </div>
                                <input class="form-control" type="text" min="2500" max="9999" name="budget_year" id="budget_year" onkeydown="clearBorder(this)" placeholder="ปีงบประมาณ" required>
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
                                    <option value="<?php echo $budget_source['budget_source_id'] ?>"><?php echo $index + 1 ?>. <?php echo $budget_source['budget_source_name'] ?></option>";
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="old_department">แผนกที่เคยใช้</label>
                            <select class="form-control" name="old_department" id="old_department" onclick="clearBorder(this)" required>
                                <option value="">-- เลือกแผนก --</option>
                                <?php
                                $sql = "SELECT * FROM department";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $old_departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($old_departments as $index => $old_department) : ?>
                                    <option value="<?php echo $old_department['department_id'] ?>"><?php echo $index + 1 ?>. <?php echo $old_department['department_name'] ?></option>";
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="service_life">อายุการใช้งาน</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" name="service_life" id="service_life" placeholder="อายุการใช้งาน">
                                <div class="input-group-append">
                                    <span class="input-group-text">ปี</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="depreciation">ค่าเสื่อมราคา</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" max="100" step="0.5" name="depreciation" id="depreciation" placeholder="ค่าเสื่อมราคา">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="netbook_value">มูลค่าสุทธิตามบัญชี</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" name="netbook_value" id="netbook_value" placeholder="มูลค่าสุทธิตามบัญชี">
                                <div class="input-group-append">
                                    <span class="input-group-text">บาท</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="transfer_date">วันที่โอนมา</label>
                            <input class="form-control" type="date" name="transfer_date" id="transfer_date" placeholder="วันที่โอนมา">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="unit">มูลค่าที่ได้มา</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" name="unit" id="unit" placeholder="จำนวน">
                                <div class="input-group-append">
                                    <span class="input-group-text">บาท</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="change_date">วันที่เกิดการเสื่อม / จำหน่าย</label>
                            <input class="form-control" type="date" name="change_date" id="change_date" placeholder="วันที่เกิดการเสื่อม / จำหน่าย">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="exp_date">วันหมดอายุ</label>
                            <input class="form-control" type="date" name="exp_date" id="exp_date" placeholder="วันหมดอายุ">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="shop">ร้านค้า</label>
                            <input class="form-control" type="text" name="shop" id="shop" placeholder="ร้านค้า">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="warranty_start">วันที่เริ่มรับประกัน</label>
                            <input class="form-control" type="date" name="warranty_start" id="warranty_start" placeholder="วันที่เริ่มรับประกัน">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="warranty">ระยะเวลาประกัน</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0" step="30" name="warranty" id="warranty" placeholder="ระยะเวลาประกัน">
                                <div class="input-group-append">
                                    <span class="input-group-text">วัน</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="warranty_end">วันสิ้นสุดประกัน</label>
                            <input class="form-control" type="date" name="warranty_end" id="warranty_end" placeholder="วันสิ้นสุดประกัน">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="note">หมายเหตุ</label>
                            <input class="form-control" type="text" name="note" id="note" placeholder="หมายเหตุ">
                        </div>
                        <hr>
                        <div>
                            <button type="button" class="btn btn-new btn-new-success" onclick="add_regis()">เพิ่มข้อมูล <i class="fa-solid fa-plus"></i></button>
                            <button type="button" class="btn btn-new btn-new-danger" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">ยกเลิก <i class="fa-solid fa-x"></i></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>