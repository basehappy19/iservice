<?php
session_start();
require_once 'helper/server/db.php';
include 'helper/server/status.php';
$sql = "SELECT *,
                DATE_ADD(report.date_report_broken, INTERVAL 543 YEAR) as date_report_broken_adjusted,
                DATE_ADD(report.date_success_fix, INTERVAL 543 YEAR) as date_success_fix_adjusted
            FROM report
            INNER JOIN mission_group ON report.mission_group_id = mission_group.mission_group_id
            INNER JOIN work_group ON report.work_group_id = work_group.work_group_id
            INNER JOIN department ON report.department_id = department.department_id
            INNER JOIN building ON report.building_id = building.building_id
            INNER JOIN floor ON report.floor_id = floor.floor_id
            INNER JOIN type ON report.type_id = type.type_id
            INNER JOIN status_repair ON report.status_repair_id = status_repair.status_repair_id
            WHERE status_repair.status_repair_id = 1
            ORDER BY status_repair.status_repair_id DESC
            LIMIT 1
    ";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);

$data = mysqli_stmt_get_result($stmt);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iservice | โรงพยาบาลเมตตาประชารักษ์ (วัดไร่ขิง)</title>
    <?php include 'helper/source/head.php' ?>
</head>

<body>
    <?php include 'helper/source/header.php' ?>
    <main>
        <section>
            <div class="container mt-3 mx-auto card-con animate__animated animate__zoomIn">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="text-center">สถิติข้อมูล</h3>
                        <div class="row">
                            <div class="col col-md col-sm my-3 animate__animated animate__zoomIn animate__fast">
                                <a href="list-item">
                                    <div class="card-bg card-bg1">
                                        <h1 class="count count-running" id="runningNumber1">10</h1>
                                        <h3 class="head-info">ทะเบียนครุภัณฑ์</h3>
                                        <div class="my-3"><img src="helper/icon/Open Box-3d.svg" alt="" srcset="" width="100px" height="100px"></div>
                                    </div>
                                </a>
                            </div>
                            <div class="col col-md col-sm my-3 animate__animated animate__zoomIn animate__fast">
                                <a href="<?php if (isset($_SESSION['role']) && $_SESSION['role'] == '2') {
                                            ?> dashboard_repair <?php
                                                            } else {
                                                                ?> status_repair<?php
                                                                            } ?>">
                                    <div class="card-bg card-bg2">
                                        <h1 class="count count-running" id="runningNumber2">20</h1>
                                        <h3 class="head-info">รายการแจ้งซ่อม</h3>
                                        <div class="my-3"><img src="helper/icon/Tools-3d.svg" alt="" srcset="" width="100px" height="100px"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md col-sm my-3 animate__animated animate__zoomIn animate__fast">
                                <a href="status_repair?status_id=2">
                                    <div class="card-bg card-bg3">
                                        <h1 class="count" id="runningNumber3">30</h1>
                                        <h3 class="head-info">ดำเนินการซ่อม</h3>
                                        <div class="my-3"><img src="helper/icon/Timetable-3d.svg" alt="" srcset="" width="100px" height="100px"></div>
                                    </div>
                                </a>
                            </div>
                            <div class="col col-md col-sm my-3 animate__animated animate__zoomIn animate__fast">
                                <a href="status_repair?status_id=1">
                                    <div class="card-bg card-bg4">
                                        <h1 class="count count-running" id="runningNumber4">40</h1>
                                        <h3 class="head-info">ซ่อมเรียบร้อย</h3>
                                        <div class="my-3"><img src="helper/icon/Multiple Devices-3d.svg" alt="" srcset="" width="100px" height="100px"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="text-center">เมนู</h3>
                        <div class="row">
                            <div class="col col-md col-sm my-3 animate__animated animate__zoomIn animate__fast">
                                <a href="list-item">
                                    <div class="card-bg card-bgs1" style="height: 264.8px;">
                                        <h3 class="head-info mb-5">ทะเบียนครุภัณฑ์</h3>
                                        <div class="my-3 text-end"><img src="helper/icon/Open Box-3d.svg" alt="" srcset="" width="100px" height="100px"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md col-sm my-3 animate__animated animate__zoomIn animate__fast">
                                <a href="report_repair">
                                    <div class="card-bg card-bgs2" style="height: 264.8px;">
                                        <h3 class="head-info mb-5">แจ้งซ่อม</h3>
                                        <div class="my-3 text-end"><img src="helper/icon/Drill-3d.svg" alt="" srcset="" width="100px" height="100px"></div>
                                    </div>
                                </a>
                            </div>
                            <div class="col col-md col-sm my-3 animate__animated animate__zoomIn animate__fast">
                                <a href="status_repair">
                                    <div class="card-bg card-bgs3" style="height: 264.8px;">
                                        <h3 class="head-info mb-5">สถานะการซ่อม</h3>
                                        <div class="my-3 text-end"><img src="helper/icon/USB Connected-3d.svg" alt="" srcset="" width="100px" height="100px"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-bg card-success-fix-recent animate__animated animate__zoomIn animate__fast">
                            <div class="recent animate__animated animate__pulse animate__fast animate__infinite">ซ่อมเรียบร้อยล่าสุด</div>
                            <div class="fix-recent">
                                <?php if (mysqli_num_rows($data) > 0) : ?>
                                    <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                                        <div class="mb-3">
                                            <h4><?php echo $row['name'] ?></h4>
                                        </div>
                                        <div class="mb-3">
                                            <p><strong>กลุ่มภารกิจ : </strong><?php echo $row['mission_group_name'] ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <p><strong>กลุ่มงาน : </strong><?php echo $row['work_group_name'] ?></p>
                                        </div>
                                        <?php if (!empty($row['department_name'])) { ?>
                                            <div class="mb-3">
                                                <p><strong>แผนก : </strong><?php echo $row['department_name']; ?></p>
                                            </div>
                                        <?php } ?>
                                        <div class="mb-3">
                                            <p><strong>อาคาร / ชั้น : </strong><?php echo $row['building_name'] ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <p><strong>ประเภท : </strong><?php echo $row['type_name'] ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <p><strong>เลขครุภัณฑ์ : </strong><?php echo $row['regis_number'] ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <p><strong>อาการ : </strong><?php echo $row['broken'] ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <p><strong>วันที่ซ่อมเสร็จเรียบร้อย : </strong><?php echo $row['date_success_fix_adjusted'] ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <p><strong>วันที่แจ้งซ่อม : </strong><?php echo $row['date_report_broken_adjusted'] ?></p>
                                        </div>
                                    <?php endwhile ?>
                                <?php else : ?>
                                    <h3 class="head-info">ยังไม่มีข้อมูลซ่อมเรียบร้อยล่าสุด</h3>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include 'helper/source/footer.php' ?>
    <?php include 'helper/source/running_number.php' ?>
</body>

</html>