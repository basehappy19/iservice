<div class="modal fade" id="edit_userModal<?php echo $row['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="edit_userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_userModalLabel">แก้ไขข้อมูลผู้ใช้ที่ <?php echo $i; ?></h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_user" action="helper/server/edit_user.php" method="post" >
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="username">ชื่อผู้ใช้</label>
                            <input class="form-control" type="text" name="username" id="username" value="<?php echo $row['username']; ?>">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="password">รหัสผ่าน</label>
                            <input class="form-control" type="text" name="password" id="password" placeholder="รหัสผ่าน">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="name">ชื่อ - นามสกุล</label>
                            <input class="form-control" type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="role_id">ตำแหน่ง</label>
                            <select class="form-control" name="role_id" id="role_id">
                                <option value="">-- ตำแหน่ง --</option>
                                <?php
                                $roleSql = "SELECT * FROM role";
                                $roleStmt = mysqli_prepare($conn, $roleSql);
                                mysqli_stmt_execute($roleStmt);
                                $roleData = mysqli_stmt_get_result($roleStmt);

                                $irole = 1;

                                while ($roleRow = mysqli_fetch_assoc($roleData)) {
                                    $selected = ($roleRow['role_id'] == $row['role_id']) ? 'selected' : '';
                                    echo "<option value='{$roleRow['role_id']}' $selected>{$irole}. {$roleRow['role_name']}</option>";
                                    $irole++;
                                }
                                ?>
                            </select>
                        </div>
                        <hr>
                        <div>
                            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                            <button type="submit" class="btn btn-new btn-new-success">แก้ไข <i class="fa-solid fa-pencil"></i></button>
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