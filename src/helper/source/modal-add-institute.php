<div class="modal fade" id="add_instituteModal" tabindex="-1" role="dialog" aria-labelledby="add_instituteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_instituteModalLabel">เพิ่มข้อมูลหน่วยงาน</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_institute" action="helper/server/add_institute.php" method="post">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="name">ชื่อหน่วยงาน</label>
                            <input class="form-control" type="text" name="name" id="name_add" onkeydown="clearBorder(this)" placeholder="ชื่อหน่วยงาน">
                        </div>
                    </div>
                </form>
                <form id="upload_excel_institute" action="helper/server/upload_excel.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="excelFile">เพิ่มข้อมูลด้วย Excel</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="excelFile" name="excelFile" onclick="clearBorder(this)">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-new btn-new-upload" onclick="upload_add_institute()" id="right" style="height: 38px;">อัปโหลด</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <button type="button" class="btn btn-new btn-new-success" onclick="add_institute()">ยืนยัน <i class="fa-solid fa-circle-check"></i></button>
                        <button type="button" class="btn btn-new btn-new-danger" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">ยกเลิก <i class="fa-solid fa-x"></i></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>