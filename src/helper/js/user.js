$(document).ready(function () {
    $("#securitySection").hide();
    $("#toggleSecuritySectionBtn").show();

    $("#toggleSecuritySectionBtn").click(function () {
        $("#securitySection").toggle();
        $("#toggleSecuritySectionBtn").toggle();
    });
});
function edit_profile() {
    if (username_check()) {
        Swal.fire({
            title: "เปลี่ยนข้อมูลโปรไฟล์",
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
                setTimeout(() => {
                    document.getElementById("edit_profile").submit();
                }, 1000);
            }
        });
    }
}

function username_check() {
    var pass = true;
    var name = document.querySelector("#name");
    var username = document.querySelector("#username");
    var phone = document.querySelector("#phone");

    if (
        !username.value ||
        !/^[a-zA-Z0-9]+$/.test(username.value) ||
        username.value.length < 6
    ) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดใส่ชื่อผู้ใช้ให้ถูกต้อง",
            text: "กรุณาใส่ชื่อผู้ใช้ 6 ตัวขึ้นและไม่ใช้ตัวอักษรพิเศษ",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        username.style.border = "1px solid red";
    } else if (!name.value || name.value.length < 6) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดใส่ชื่อ - นามสกุลให้ถูกต้อง",
            text: "โปรดใส่ชื่อ - นามสกุลให้ถูกต้อง",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        name.style.border = "1px solid red";
    } else if (!phone.value || phone.value.length != 10) {
        pass = false;
        Swal.fire({
            icon: "error",
            title: "โปรดกรอกเบอร์โทรศัพท์ให้ถูกต้อง",
            text: "กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        phone.style.border = "1px solid red";
    }

    return pass;
}

function edit_password() {
    if (validate()) {
        Swal.fire({
            title: "เปลี่ยนรหัสผ่านผู้ใช้",
            text: "แน่ใจหรือไม่",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#5fe280",
            cancelButtonColor: "#d33",
            confirmButtonText: "ยืนยัน",
            timer: 10000,
            timerProgressBar: true,
        }).then((result) => {
            if (result.isConfirmed) {
                setTimeout(() => {
                    document.getElementById("edit_password").submit();
                }, 1000);
            }
        });
    }
}

function validate() {
    var pass = true;
    var password = document.querySelector("#password");
    var confirmPassword = document.querySelector("#confirmPassword");

    if (!password.value || password.value.length < 8) {
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
    }

    return pass;
}

function clearBorder(e) {
    document.querySelector(`#${e.id}`).style.border = "1px solid #dee2e6";
}
