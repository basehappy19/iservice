function report() {
    if (check_report()) {
        Swal.fire({
            title: "ยืนยันแจ้งซ่อม",
            text: "แน่ใจหรือไม่",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#5fe280",
            cancelButtonColor: "#e25f5f",
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ยืนยัน",
            timer: 10000,
            timerProgressBar: true
        }).then((result) => {
            if (result.isConfirmed) {
                setTimeout(function () {
                    document.getElementById('report').submit();
                }, 1000);
            }
        });
    }   
}
  
function check_report() {
    var pass = true;
    var name = document.querySelector("#name");
    var work_group_id = document.querySelector("#work_group_id");
    var building_id = document.querySelector("#building_id");
    var floor_id = document.querySelector("#floor_id");
    var type_id = document.querySelector("#type_id");
    var broken = document.querySelector("#broken");

    if (!name.value || name.value.length < 8) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดใส่ชื่อ - นามสกุลให้ถูกต้อง",
            text: "กรุณาใส่ชื่อ - นามสกุลให้ถูกต้อง",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        name.style.border = "1px solid red";
    } else if (!mission_group_id.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดเลือกกลุ่มภารกิจ",
            text: "กรุณาเลือกกลุ่มภารกิจ",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        mission_group_id.style.border = "1px solid red";
    } else if (!work_group_id.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดเลือกกลุ่มงาน",
            text: "กรุณาเลือกกลุ่มงาน",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        work_group_id.style.border = "1px solid red";

    } else if (!department_id.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดเลือกแผนก",
            text: "กรุณาเลือกแผนก",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        department_id.style.border = "1px solid red";

    } else if (!building_id.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดเลือกอาคาร",
            text: "กรุณาเลือกอาคาร",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        building_id.style.border = "1px solid red";
    } else if (!floor_id.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดเลือกชั้น",
            text: "กรุณาเลือกชั้น",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        floor_id.style.border = "1px solid red";
    } else if (!type_id.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดเลือกประเภท",
            text: "กรุณาเลือกประเภท",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        type_id.style.border = "1px solid red";
    } else if (!broken.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดระบุอาการเสีย",
            text: "กรุณาระบุอาการเสีย",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        broken.style.border = "1px solid red";
    }

    return pass;
    }

function clearBorder(e) {
    document.querySelector(`#${e.id}`).style.border = "1px solid #dee2e6";
}
  