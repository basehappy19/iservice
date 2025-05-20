<?php
require_once 'helper/server/db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 4) {
    header("Location: ./login.php");
}

$sql = "SELECT user_id, username, role.role_id, role.role_name, `name`, `phone` FROM user 
LEFT JOIN role ON user.role_id = role.role_id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการผู้ใช้ | โรงพยาบาลเมตตาประชารักษ์ (วัดไร่ขิง)</title>
    <?php include 'helper/source/head.php' ?>
</head>

<body>
    <?php include 'helper/source/header.php' ?>
    <main>
        <?php
        if (isset($_SESSION['success'])) {
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        }
        ?>
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>
        <section>

            <div class="container mt-3 mx-auto card-con">
                <h1 class="head-info text-center">รายชื่อผู้ใช้</h1>
                <p class="head-info text-center">ยินดีต้อนรับ <?php echo $data_user['name'] ?></p>
                <div class="text-end m-3">
                    <button type="button" class="btn btn-new btn-new-success" data-toggle="modal" data-target="#add_userModal">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <table id="user-data" class="table nowrap table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>ตำแหน่ง</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $index => $user) : ?>
                            <?php if ($user['username'] != 'system') : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['name']; ?></td>
                                    <td><?php echo $user['role_name']; ?></td>
                                    <td>
                                        <?php if ($user['username'] != 'system') : ?>
                                            <button type="button" class="btn btn-new btn-new-warning" data-toggle="modal" data-target="#edit_userModal<?php echo $user['user_id']; ?>">
                                                แก้ไขข้อมูล <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-new btn-new-danger" onclick="delete_user('./helper/server/delete_user.php?user_id=<?php echo $user['user_id'] ?>')">ลบผู้ใช้</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php include 'helper/source/modal-edit-user.php' ?>
                            <?php include 'helper/source/modal-add-user.php' ?>
                        <?php endforeach;  ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>