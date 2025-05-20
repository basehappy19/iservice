<?php
session_start();
require './helper/server/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != '4') {
    header("Location: ./login.php");
}

$sql = "SELECT * FROM institute";
$stmt = $conn->prepare($sql);
$stmt->execute();
$institutes = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                        <?php foreach ($institutes as $index => $institute) : ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $institute['institute_name']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-new btn-new-warning" data-toggle="modal" data-target="#edit_instituteModal<?php echo $institute['institute_id']; ?>">
                                        แก้ไขข้อมูล <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-new btn-new-danger" onclick="delete_institute('./helper/server/delete_institute.php?id=<?php echo $institute['institute_id'] ?>')">ลบหน่วยงาน</button>
                                </td>
                            </tr>
                            <?php include './helper/source/modal-edit-institute.php' ?>
                        <?php endforeach; ?>
                        <?php include './helper/source/modal-add-institute.php' ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>