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
                <form id="add_user" action="./helper/server/add_user.php" method="post">
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
                            <label for="phone">เบอร์โทรศัพท์</label>
                            <input class="form-control" type="tel" id="phone_new" name="phone" onkeydown="clearBorder(this)" placeholder="เบอร์โทรศัพท์">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="role_id">ตำแหน่ง</label>
                            <select class="form-control" name="role_id" id="role_id_add" onclick="clearBorder(this)">
                                <option value="">-- ตำแหน่ง --</option>
                                <?php
                                $sql = "SELECT * FROM role";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $roles = $stmt->fetchAll();


                                foreach ($roles as $index => $role) : ?>
                                    <option value="<?php echo $role['role_id'] ?>"><?php echo $index + 1 ?>. <?php echo $role['role_name'] ?></option>";
                                <?php endforeach ?>
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