<div class="modal fade" id="edit_userModal<?php echo $user['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="edit_userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_userModalLabel">แก้ไขข้อมูลผู้ใช้ที่ <?php echo $index + 1; ?></h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_user" action="./helper/server/edit_user.php" method="post">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="username">ชื่อผู้ใช้</label>
                            <input class="form-control" type="text" name="username" id="username" value="<?php echo $user['username']; ?>">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="password">รหัสผ่าน</label>
                            <input class="form-control" type="text" name="password" id="password" placeholder="รหัสผ่าน">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="name">ชื่อ - นามสกุล</label>
                            <input class="form-control" type="text" id="name" name="name" value="<?php echo $user['name']; ?>">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="phone">เบอร์โทรศัพท์</label>
                            <input class="form-control" type="tel" id="phone" name="phone" value="<?php echo $user['phone']; ?>">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="role_id">ตำแหน่ง</label>
                            <select class="form-control" name="role_id" id="role_id">
                                <option value="">-- ตำแหน่ง --</option>
                                <?php
                                $sql = "SELECT * FROM role";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $roles = $stmt->fetchAll();


                                foreach ($roles as $index => $role) : ?>
                                    <option value="<?php echo $role['role_id'] ?>" <?php echo $role['role_id'] == $user['role_id'] ? "selected" : "" ?>><?php echo $index + 1 ?>. <?php echo $role['role_name'] ?></option>";
                                <?php endforeach ?>
                            </select>
                        </div>
                        <hr>
                        <div>
                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
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