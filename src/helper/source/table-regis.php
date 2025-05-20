<table id="regis" class="table nowrap table-bordered" style="width:100%">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">เลขครุภัณฑ์</th>
            <th scope="col">กลุ่มภารกิจ</th>
            <th scope="col">กลุ่มงาน</th>
            <th scope="col">แผนก</th>
            <th scope="col">หน่วยงาน</th>
            <th scope="col">อาคาร / ชั้น</th>
            <th scope="col">ประเภท</th>
            <th scope="col">ยี่ห้อ</th>
            <th scope="col">รุ่น</th>
            <th scope="col">ผู้รับผิดชอบ</th>
            <th scope="col">ปีที่รับอุปกรณ์</th>
            <th scope="col">สภาพ</th>
            <th scope="col">งบประมาณปี</th>
            <th scope="col">แหล่งงบประมาณ</th>
            <th scope="col">แผนกที่เคยใช้</th>
            <th scope="col">ปีที่ขึ้นทะเบียน</th>
            <th scope="col">อายุการใช้งาน</th>
            <th scope="col">ค่าเสื่อมราคา</th>
            <th scope="col">มูลค่าสุทธิตามบัญชี</th>
            <th scope="col">Serialnumber</th>
            <th scope="col">วันที่โอนมา</th>
            <th scope="col">มูลค่าการได้มา</th>
            <th scope="col">วันที่เกิดการเสื่อม / จำหน่าย</th>
            <th scope="col">วันหมดอายุ</th>
            <th scope="col">ร้าน</th>
            <th scope="col">วันที่เริ่มรับประกัน</th>
            <th scope="col">ประกัน</th>
            <th scope="col">วันสิ้นสุดประกัน</th>
            <th scope="col">หมายเหตุ</th>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == '3') { ?>
                <th scope="col"></th>
            <?php
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($devices as $index => $device) : ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $device['regis_number']; ?></td>
                <td><?php echo $device['mission_group_name']; ?></td>
                <td><?php echo $device['work_group_name']; ?></td>
                <td><?php echo $device['department_name']; ?></td>
                <td><?php echo $device['institute_name']; ?></td>
                <td><?php echo $device['building_name'] . ' ' . $device['floor_name']; ?></td>
                <td><?php echo $device['type_name']; ?></td>
                <td><?php echo $device['brand']; ?></td>
                <td><?php echo $device['model']; ?></td>
                <td><?php echo $device['responsible']; ?></td>
                <td><?php echo (int)$device['year_received'] + 543; ?></td>
                <td class="text-center 
                    <?php
                    $status_classes = [
                        1 => 'normal',
                        2 => 'sell',
                        3 => 'wait-sell',
                        4 => 'broken',
                        5 => 'useless'
                    ];
                    echo isset($status_classes[$device['status_id']]) ? $status_classes[$device['status_id']] : '';
                    ?>">
                    <?php echo $device['status_name']; ?></td>
                <td><?php echo (int)$device['budget_year'] + 543; ?></td>
                <td><?php echo $device['budget_source_name']; ?></td>
                <td><?php echo $device['old_department']; ?></td>
                <td><?php echo $device['regis_date']; ?></td>
                <td><?php echo isset($device['service_life']) ? $device['service_life'] . ' ปี' : ''; ?></td>
                <td><?php echo isset($device['depreciation']) ? $device['depreciation'] . '%' : ''; ?></td>
                <td><?php echo isset($device['netbook_value']) ? $device['netbook_value'] . ' บาท' : ''; ?></td>
                <td><?php echo isset($device['serialnumber']) ? $device['serialnumber'] : ''; ?></td>
                <td><?php echo isset($device['transfer_date']) ? $device['transfer_date'] : ''; ?></td>
                <td><?php echo isset($device['unit']) ? $device['unit'] . ' บาท' : ''; ?></td>
                <td><?php echo $device['change_date']; ?></td>
                <td><?php echo $device['exp_date']; ?></td>
                <td><?php echo $device['shop']; ?></td>
                <td><?php echo $device['warranty_start']; ?></td>
                <td><?php echo $device['warranty']; ?></td>
                <td><?php echo $device['warranty_end']; ?></td>
                <td><?php echo $device['note']; ?></td>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == '3') : ?>
                    <td>
                        <a href="edit-regis.php?device_id=<?php echo $device['device_id']; ?>" class="btn btn-new btn-new-warning">
                            แก้ไขข้อมูล <i class="fa-solid fa-pencil"></i>
                        </a>
                    </td>
                <?php
                endif;
                ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>