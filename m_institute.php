<?php
require_once 'helper/server/db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != '4') {
    header("Location: login");
}

$sql = "SELECT * FROM institute";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);

$data = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการหน่วยงาน | โรงพยาบาลเมตตาประชารักษ์ (วัดไร่ขิง)</title>
    <?php include 'helper/source/head.php' ?>
</head>

<body>
    <?php include 'helper/source/header.php' ?>
    <main>
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>
        <section>

            <div class="container mt-3 mx-auto card-con">
                <h1 class="head-info text-center">รายชื่อหน่วยงาน</h1>
                <p class="head-info text-center">ยินดีต้อนรับ <?php echo $data_user['name'] ?></p>
                <div class="text-end m-3">
                    <button type="button" class="btn btn-new btn-new-success" data-toggle="modal" data-target="#add_instituteModal">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <table id="user-data" class="table nowrap table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อหน่วยงาน</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        while ($row = mysqli_fetch_assoc($data)) : ?>
                            <?php if ($row['institute_id'] != 1) : ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['institute_name']; ?></td>
                                <td>
                                    <?php if ($row['institute_id'] != 1) : ?>
                                    <button type="button" class="btn btn-new btn-new-warning" data-toggle="modal" data-target="#edit_instituteModal<?php echo $row['institute_id']; ?>">
                                                แก้ไขข้อมูล <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-new btn-new-danger" onclick="delete_institute('helper/server/delete_institute.php?id=<?php echo $row['institute_id'] ?>')">ลบหน่วยงาน</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php include 'helper/source/modal-edit-institute.php' ?>
                            <?php include 'helper/source/modal-add-institute.php' ?>
                        <?php $i++;
                        endwhile;  ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>