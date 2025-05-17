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
        <?php $i = 1;
        while ($row = mysqli_fetch_assoc($data)) : ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['regis_number']; ?></td>
                <td><?php echo $row['mission_group_name']; ?></td>
                <td><?php echo $row['work_group_name']; ?></td>
                <td><?php echo $row['department_name']; ?></td>
                <td><?php echo $row['institute_name']; ?></td>
                <td><?php echo $row['building_name'] . ' ' . $row['floor_name']; ?></td>
                <td><?php echo $row['type_name']; ?></td>
                <td><?php echo $row['brand']; ?></td>
                <td><?php echo $row['model']; ?></td>
                <td><?php echo $row['responsible']; ?></td>
                <td><?php echo $row['year_received']; ?></td>
                <td class="text-center <?php
                                        $status_id = $row['status_id'];
                                        if ($status_id == 1) {
                                            echo 'normal';
                                        } elseif ($status_id == 2) {
                                            echo 'sell';
                                        } elseif ($status_id == 3) {
                                            echo 'wait-sell';
                                        } elseif ($status_id == 4) {
                                            echo 'broken';
                                        } elseif ($status_id == 5) {
                                            echo 'useless';
                                        }
                                        ?>
                                        ">
                    <?php echo $row['status_name']; ?></td>
                <td><?php echo $row['budget_year']; ?></td>
                <td><?php echo $row['budget_source_name']; ?></td>
                <td><?php echo $row['old_department']; ?></td>
                <td><?php echo $row['regis_date']; ?></td>
                <td><?php echo !isset($row['service_life']) ? $row['service_life'] . ' ปี' : ''; ?></td>
                <td><?php echo !isset($row['depreciation']) ? $row['depreciation'] . '%' : ''; ?></td>
                <td><?php echo !isset($row['netbook_value']) ? $row['netbook_value'] . ' บาท' : ''; ?></td>
                <td><?php echo !isset($row['serialnumber']) ? $row['serialnumber'] : ''; ?></td>
                <td><?php echo !isset($row['transfer_date']) ? $row['transfer_date'] : ''; ?></td>
                <td><?php echo !isset($row['unit']) ? $row['unit'] . ' บาท' : ''; ?></td>
                <td><?php echo $row['change_date']; ?></td>
                <td><?php echo $row['exp_date']; ?></td>
                <td><?php echo $row['shop']; ?></td>
                <td><?php echo $row['warranty_start']; ?></td>
                <td><?php echo $row['warranty']; ?></td>
                <td><?php echo $row['warranty_end']; ?></td>
                <td><?php echo $row['note']; ?></td>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == '3') { ?>
                    <td>
                        <a href="edit-regis.php?device_id=<?php echo $row['device_id']; ?>" class="btn btn-new btn-new-warning">
                            แก้ไขข้อมูล <i class="fa-solid fa-pencil"></i>
                        </a>
                    </td>
                <?php
                }
                ?>
            </tr>

        <?php $i++;
        endwhile; ?>
    </tbody>
</table>