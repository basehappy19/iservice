function add_regis() {
    if (check_add()) {
        Swal.fire({
            title: "เพิ่มข้อมูลครุภัณฑ์",
            text: "แน่ใจหรือไม่",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#5fe280",
            cancelButtonColor: "#e25f5f",
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ยืนยัน",
            timer: 10000,
            timerProgressBar: true,
        }).then((result) => {
            if (result.isConfirmed) {
                setTimeout(function () {
                    document.getElementById("add_regis").submit();
                }, 1000);
            }
        });
    }
}
function check_add() {
    var pass = true;
    var category_id = document.querySelector("#category_id");
    var regis_number = document.querySelector("#regis_number");
    var mission_group_id = document.querySelector("#mission_group_id");
    var work_group_id = document.querySelector("#work_group_id");
    var building_id = document.querySelector("#building_id");
    var floor_id = document.querySelector("#floor_id");
    var type_id = document.querySelector("#type_id");
    var brand = document.querySelector("#brand");
    var model = document.querySelector("#model");
    var responsible = document.querySelector("#responsible");
    var year_received = document.querySelector("#year_received");
    var status_id = document.querySelector("#status_id");
    var budget_year = document.querySelector("#budget_year");
    var budget_source_id = document.querySelector("#budget_source_id");

    if (!category_id.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดเลือกประเภทอุปกรณ์",
            text: "กรุณาเลือกประเภทอุปกรณ์",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        category_id.style.border = "1px solid red";
    } else if (!regis_number.value || regis_number.value.length < 3) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดใส่เลขครุภัณฑ์ให้ถูกต้อง",
            text: "กรุณาใส่เลขครุภัณฑ์ให้ถูกต้อง",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        regis_number.style.border = "1px solid red";
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
    } else if (!brand.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดระบุยี่ห้อ",
            text: "กรุณาระบุยี่ห้อ",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        brand.style.border = "1px solid red";
    } else if (!model.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดระบุรุ่น",
            text: "กรุณาระบุรุ่น",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        model.style.border = "1px solid red";
    } else if (!responsible.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดระบุผู้รับผิดชอบ",
            text: "กรุณาระบุผู้รับผิดชอบ",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        responsible.style.border = "1px solid red";
    } else if (!year_received.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดระบุปีที่รับอุปกรณ์",
            text: "กรุณาระบุที่รับอุปกรณ์",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        year_received.style.border = "1px solid red";
    } else if (!status_id.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดระบุสถานะครุภัณฑ์",
            text: "กรุณาระบุสถานะครุภัณฑ์",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        status_id.style.border = "1px solid red";
    } else if (!budget_year.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดระบุปีงบประมาณ",
            text: "กรุณาระบุปีงบประมาณ",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        budget_year.style.border = "1px solid red";
    } else if (!budget_source_id.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดระบุแหล่งงบประมาณ",
            text: "กรุณาระบุแหล่งงบประมาณ",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        budget_source_id.style.border = "1px solid red";
    }

    return pass;
}
function add_history() {
    if (history()) {
        Swal.fire({
            title: "เพิ่มประวัติ",
            text: "แน่ใจหรือไม่",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#5fe280",
            cancelButtonColor: "#e25f5f",
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ยืนยัน",
            timer: 10000,
            timerProgressBar: true,
        }).then((result) => {
            if (result.isConfirmed) {
                setTimeout(function () {
                    document.getElementById("history").submit();
                }, 1000);
            }
        });
    }
}
function history() {
    var pass = true;
    var title = document.querySelector("#title");
    var des = document.querySelector("#des");

    if (!title.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดใส่ชื่อหัวข้อ",
            text: "กรุณาใส่ชื่อหัวข้อ",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        title.style.border = "1px solid red";
    } else if (!des.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดใส่คำอธิบาย",
            text: "กรุณาใส่คำอธิบาย",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        des.style.border = "1px solid red";
    }

    return pass;
}
function add_user() {
    if (check_add_user()) {
        Swal.fire({
            title: "เพิ่มข้อมูลผู้ใช้",
            text: "แน่ใจหรือไม่",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#5fe280",
            cancelButtonColor: "#e25f5f",
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ยืนยัน",
            timer: 10000,
            timerProgressBar: true,
        }).then((result) => {
            if (result.isConfirmed) {
                setTimeout(function () {
                    document.getElementById("add_user").submit();
                }, 1000);
            }
        });
    }
}
function check_add_user() {
    let pass = true;
    let username = document.querySelector("#username_add");
    let password = document.querySelector("#password_add");
    let confirmPassword = document.querySelector("#confirmPassword_add");
    let role_id = document.querySelector("#role_id_add");
    let phone = document.querySelector("#phone_new");
    let name = document.querySelector("#name_add");
    
    if (
        !username.value ||
        !/^[a-zA-Z0-9]+$/.test(username.value) ||
        username.value.length < 6
    ) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดใส่ชื่อผู้ใช้ให้ถูกต้อง",
            text: "กรุณาใส่รหัส 8 ตัวขึ้น",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        username.style.border = "1px solid red";
    } else if (!password.value || password.value.length < 8) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดใส่รหัสให้ปลอดภัย",
            text: "กรุณาใส่รหัส 8 ตัวขึ้น",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        password.style.border = "1px solid red";
    } else if (password.value !== confirmPassword.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "รหัสยืนยันไม่ถูกต้อง",
            text: "โปรดใส่รหัสให้เหมือนกัน",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });

        password.style.border = "1px solid red";
        confirmPassword.style.border = "1px solid red";
    } else if (!phone.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดใส่เบอร์โทรศัพท์",
            text: "กรุณาใส่เบอร์โทรศัพท์",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        phone.style.border = "1px solid red";
    } else if (!role_id.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดเลือกตำแหน่งผู้ใช้",
            text: "กรุณาเลือกตำแหน่งผู้ใช้",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        role_id.style.border = "1px solid red";
    } else if (!name.value || name.value.length < 6) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดระบุชื่อผู้ใช้",
            text: "กรุณาระบุชื่อผู้ใช้",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        name.style.border = "1px solid red";
    }

    return pass;
}
function add_institute() {
    if (check_add_institute()) {
        Swal.fire({
            title: "เพิ่มข้อมูลหน่วยงาน",
            text: "แน่ใจหรือไม่",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#5fe280",
            cancelButtonColor: "#e25f5f",
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ยืนยัน",
            timer: 10000,
            timerProgressBar: true,
        }).then((result) => {
            if (result.isConfirmed) {
                setTimeout(function () {
                    document.getElementById("add_institute").submit();
                }, 1000);
            }
        });
    }
}
function check_add_institute() {
    var pass = true;
    var name = document.querySelector("#name_add");

    if (!name.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดใส่ชื่อหน่วยงานให้",
            text: "กรุณาใส่ชื่อหน่วยงาน",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        name.style.border = "1px solid red";
    }

    return pass;
}
function upload_add_institute() {
    if (check_upload_add_institute()) {
        Swal.fire({
            title: "เพิ่มข้อมูลหน่วยงาน",
            text: "แน่ใจหรือไม่",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#5fe280",
            cancelButtonColor: "#e25f5f",
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ยืนยัน",
            timer: 10000,
            timerProgressBar: true,
        }).then((result) => {
            if (result.isConfirmed) {
                setTimeout(function () {
                    document.getElementById("upload_excel_institute").submit();
                }, 1000);
            }
        });
    }
}
function check_upload_add_institute() {
    var pass = true;
    var excelFile = document.querySelector("#excelFile");

    if (!excelFile.value) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดอัพโหลดไฟล์ excel",
            text: "กรุณาอัพโหลดไฟล์ excel",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        excelFile.style.border = "1px solid red";
    }

    return pass;
}
function clearBorder(e) {
    document.querySelector(`#${e.id}`).style.border = "1px solid #dee2e6";
}
function edit_regis() {
    Swal.fire({
        title: "อัพเดทข้อมูล",
        text: "แน่ใจหรือไม่",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#5fe280",
        cancelButtonColor: "#e25f5f",
        cancelButtonText: "ยกเลิก",
        confirmButtonText: "ยืนยัน",
        timer: 10000,
        timerProgressBar: true,
    }).then((result) => {
        if (result.isConfirmed) {
            setTimeout(function () {
                document.getElementById("edit_regis").submit();
            }, 1000);
        }
    });
}
function edit_regis_broken() {
    if (check_edit_broken()) {
        Swal.fire({
            title: "อัพเดทข้อมูล",
            text: "แน่ใจหรือไม่",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#5fe280",
            cancelButtonColor: "#e25f5f",
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ยืนยัน",
            timer: 10000,
            timerProgressBar: true,
        }).then((result) => {
            if (result.isConfirmed) {
                setTimeout(function () {
                    document.getElementById("edit_regis_broken").submit();
                }, 1000);
            }
        });
    }
}
function check_edit_broken() {
    var pass = true;
    var name = document.querySelector("#name_broken");
    var work_group_id = document.querySelector("#work_group_id");
    var building_id = document.querySelector("#building_id");
    var floor_id = document.querySelector("#floor_id");
    var type_id = document.querySelector("#type_id");
    var broken = document.querySelector("#broken_broken");

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
function edit_user() {
    Swal.fire({
        title: "อัพเดทข้อมูลผู้ใช้",
        text: "แน่ใจหรือไม่",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#5fe280",
        cancelButtonColor: "#e25f5f",
        cancelButtonText: "ยกเลิก",
        confirmButtonText: "ยืนยัน",
        timer: 10000,
        timerProgressBar: true,
    }).then((result) => {
        if (result.isConfirmed) {
            setTimeout(function () {
                document.getElementById("edit_user").submit();
            }, 1000);
        }
    });
}
function update_status_broken_1(url) {
    Swal.fire({
        title: "ซ่อมเสร็จแล้ว?",
        text: "เมื่อยืนยันจะแจ้งเตือน ไปยังผู้แจ้งว่าซ่อมเสร็จแล้ว",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#5fe280",
        cancelButtonColor: "#e25f5f",
        cancelButtonText: "ยกเลิก",
        confirmButtonText: "ยืนยัน",
        timer: 10000,
        timerProgressBar: true,
    }).then((result) => {
        if (result.isConfirmed) {
            setTimeout(function () {
                window.location.href = url;
            }, 1000);
        }
    });
}
function update_status_broken_2(url) {
    Swal.fire({
        title: "รับเรื่อง?",
        text: "เมื่อยืนยันจะแจ้งเตือน ไปยังผู้แจ้งว่าอยู่ระหว่างดำเนินการซ่อม",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#5fe280",
        cancelButtonColor: "#e25f5f",
        cancelButtonText: "ยกเลิก",
        confirmButtonText: "ยืนยัน",
        timer: 10000,
        timerProgressBar: true,
    }).then((result) => {
        if (result.isConfirmed) {
            setTimeout(function () {
                window.location.href = url;
            }, 1000);
        }
    });
}
function delete_user(url) {
    Swal.fire({
        title: "ลบผู้ใช้",
        text: "แน่ใจหรือไม่",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#5fe280",
        cancelButtonColor: "#e25f5f",
        cancelButtonText: "ยกเลิก",
        confirmButtonText: "แน่ใจ",
        timer: 10000,
        timerProgressBar: true,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "ยืนยันการลบผู้ใช้",
                text: "กรุณายืนยันอีกครั้ง",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#5fe280",
                cancelButtonColor: "#e25f5f",
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ยกเลิก",
            }).then((secondResult) => {
                if (secondResult.isConfirmed) {
                    Swal.fire({
                        title: "เรียบร้อย!",
                        text: "ลบข้อมูลผู้ใช้เรียบร้อย",
                        icon: "success",
                        confirmButtonText: "ตกลง",
                        confirmButtonColor: "#5fe280",
                    }).then(() => {
                        setTimeout(function () {
                            window.location.href = url;
                        }, 1000);
                    });
                }
            });
        }
    });
}
function delete_institute(url) {
    Swal.fire({
        title: "ลบหน่วยงาน",
        text: "แน่ใจหรือไม่",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#5fe280",
        cancelButtonColor: "#e25f5f",
        cancelButtonText: "ยกเลิก",
        confirmButtonText: "แน่ใจ",
        timer: 10000,
        timerProgressBar: true,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "ยืนยันการลบหน่วยงาน",
                text: "กรุณายืนยันอีกครั้ง",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#5fe280",
                cancelButtonColor: "#e25f5f",
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ยกเลิก",
            }).then((secondResult) => {
                if (secondResult.isConfirmed) {
                    Swal.fire({
                        title: "เรียบร้อย!",
                        text: "ลบข้อมูลหน่วยงานเรียบร้อย",
                        icon: "success",
                        confirmButtonText: "ตกลง",
                        confirmButtonColor: "#5fe280",
                    }).then(() => {
                        setTimeout(function () {
                            window.location.href = url;
                        }, 1000);
                    });
                }
            });
        }
    });
}
