<table id="regis_broken" class="table nowrap table-bordered" style="width:100%">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ชื่อ</th>
            <th scope="col">กลุ่มภารกิจ</th>
            <th scope="col">กลุ่มงาน</th>
            <th scope="col">แผนก</th>
            <th scope="col">อาคาร / ชั้น</th>
            <th scope="col">ประเภท</th>
            <th scope="col">เลขครุภัณฑ์</th>
            <th scope="col">สถานะการซ่อม</th>
            <th scope="col">อาการ</th>
            <th scope="col">วันที่ซ่อมเสร็จเรียบร้อย</th>
            <th scope="col">วันที่แจ้งซ่อม</th>
            <th scope="col"></th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($reports as $index => $report) : ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $report['name']; ?></td>
                <td><?php echo $report['mission_group_name']; ?></td>
                <td><?php echo $report['work_group_name']; ?></td>
                <td><?php echo $report['department_name']; ?></td>
                <td><?php echo $report['building_name'] . ' ' . $report['floor_name']; ?></td>
                <td><?php echo $report['type_name']; ?></td>
                <td><?php echo $report['regis_number']; ?></td>
                <td class="text-center <?php
                                        $status_repair_id = $report['status_repair_id'];
                                        if ($status_repair_id == 1) {
                                        ?> normal <?php
                                                } elseif ($status_repair_id == 2) {
                                                    ?> sell <?php
                                                        } elseif ($status_repair_id == 3) {
                                                            ?> wait-sell <?php
                                                                        } elseif ($status_repair_id == 4) {
                                                                            ?> broken <?php
                                                                                    } elseif ($status_repair_id == 5) {
                                                                                        ?> useless <?php
                                                                                                    }
                                                                                                        ?>
                                        ">
                    <?php echo $report['status_repair_name']; ?></td>
                <td><?php echo $report['broken']; ?></td>
                <td><?php echo $report['date_success_fix_adjusted']; ?></td>
                <td><?php echo $report['date_report_broken_adjusted']; ?></td>
                <td>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == '3') { ?>
                        <a href="edit-broken.php?device_id=<?php echo $report['device_id'] ?>" class="btn btn-new btn-new-warning">
                            แก้ไขข้อมูล <i class="fa-solid fa-pencil"></i>
                        </a>
                    <?php
                    }
                    ?>
                    <button type="button" class="btn btn-new btn-new-info" data-toggle="modal" data-target="#history<?php echo $report['device_id']; ?>">
                        ดูประวัติ <i class="fa-solid fa-eye"></i>
                    </button>
                </td>
            </tr>
            <?php include 'helper/source/modal-history.php' ?>
        <?php endforeach; ?>
    </tbody>
</table>