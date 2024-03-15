<?php
require_once 'helper/server/db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != '4') {
    header("Location: login");
}

$sql = "SELECT * FROM user INNER JOIN role ON user.role_id = role.role_id";
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
                    <button type="button" class="btn btn-new btn-new-success" data-toggle="modal" data-target="#add_userModal">
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
                        <?php $i = 1;
                        while ($row = mysqli_fetch_assoc($data)) : ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-new btn-new-danger" onclick="delete_user('helper/server/delete_user.php?user_id=<?php echo $row['user_id'] ?>')">ลบหน่วยงาน</button>
                                </td>
                            </tr>

                            <?php include 'helper/source/modal-edit-user.php' ?>
                            <?php include 'helper/source/modal-add-user.php' ?>
                        <?php $i++;
                        endwhile;  ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>