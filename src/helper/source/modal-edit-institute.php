<div class="modal fade" id="edit_instituteModal<?php echo $institute['institute_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="edit_userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_instituteModalLabel">แก้ไขข้อมูลหน่วยงานที่ <?php echo $index + 1; ?></h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_institute" action="./helper/server/edit_institute.php" method="post" >
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="name">ชื่อหน่วยงาน</label>
                            <input class="form-control" type="text" name="name" id="name" value="<?php echo $institute['institute_name']; ?>">
                        </div>
                        <hr>
                        <div>
                            <input type="hidden" name="id" value="<?php echo $institute['institute_id']; ?>">
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