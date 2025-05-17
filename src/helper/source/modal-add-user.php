<div class="modal fade" id="add_userModal" tabindex="-1" role="dialog" aria-labelledby="add_userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_userModalLabel">เพิ่มข้อมูลผู้ใช้</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_user" action="helper/server/add_user.php" method="post">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="username">ชื่อผู้ใช้</label>
                            <input class="form-control" type="text" name="username" id="username_add" onkeydown="clearBorder(this)" placeholder="ชื่อผู้ใช้">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="password">รหัสผ่าน</label>
                            <input class="form-control" type="text" name="password" id="password_add" onkeydown="clearBorder(this)" placeholder="รหัสผ่าน">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="password">รหัสผ่านยืนยัน</label>
                            <input class="form-control" type="text" id="confirmPassword_add" onkeydown="clearBorder(this)" placeholder="รหัสผ่านยืนยัน">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="name">ชื่อ - นามสกุล</label>
                            <input class="form-control" type="text" id="name_add" name="name" onkeydown="clearBorder(this)" placeholder="ชื่อ - นามสกุล">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="role_id">ตำแหน่ง</label>
                            <select class="form-control" name="role_id" id="role_id_add" onclick="clearBorder(this)">
                                <option value="">-- ตำแหน่ง --</option>
                                <?php
                                $roleSql = "SELECT * FROM role";
                                $roleStmt = mysqli_prepare($conn, $roleSql);
                                mysqli_stmt_execute($roleStmt);
                                $roleData = mysqli_stmt_get_result($roleStmt);

                                $irole = 1;

                                while ($roleRow = mysqli_fetch_assoc($roleData)) {
                                    echo "<option value='{$roleRow['role_id']}'>{$irole}. {$roleRow['role_name']}</option>";
                                    $irole++;
                                }
                                ?>
                            </select>
                        </div>
                        <hr>
                        <div>
                            <button type="button" class="btn btn-new btn-new-success" onclick="add_user()">ยืนยัน <i class="fa-solid fa-circle-check"></i></button>
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