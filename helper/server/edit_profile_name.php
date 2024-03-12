<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'db.php'; 

    $user_id = $_SESSION['user_id'];
    $newUsername = htmlspecialchars($_POST['username']);
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);

    $checkUsernameQuery = "SELECT * FROM user WHERE username = ? AND user_id != ?";
    $stmt = mysqli_prepare($conn, $checkUsernameQuery);
    mysqli_stmt_bind_param($stmt, "si", $newUsername, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $rows = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($rows > 0) {
        $_SESSION['error'] = '<script>
        Swal.fire({
            icon: "error",
            title: "มีชื่อผู้ใช้ซ้ำแล้ว",
            text: "โปรดเลือกชื่อผู้ใช้อื่น!",
            confirmButtonColor: "#e25f5f",
            confirmButtonText: "ลองใหม่อีกครั้ง",
        });
        </script>';
        header("Location: ../../profile");
        exit();
    }
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['profile_pic']['name'];
        $file_tmp_name = $_FILES['profile_pic']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png");

        if (in_array($file_ext, $allowed_extensions)) {
            $file_folder = '../data/profile/' . $user_id . '_' . $file_name;
            $file_destination = $user_id . '_' . $file_name;
            if (move_uploaded_file($file_tmp_name, $file_folder)) {                
                $sql = "UPDATE user SET profile_pic = '$file_destination' WHERE user_id = '$user_id'";
                    
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['success'] = '<script>
                    Swal.fire({
                        icon: "success",
                        title: "เรียบร้อย!",
                        text: "อัปโหลดรูปโปรไฟล์เรียบร้อย!",
                        confirmButtonColor: "#5fe280",
                        confirmButtonText: "โอเค",
                    });
                    </script>';
                    header("Location: ../../profile");
                } else {
                    $_SESSION['error'] = '<script>
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "มีข้อผิดพลาดในการบันทึกข้อมูล",
                        confirmButtonColor: "#ff7961",
                        confirmButtonText: "ลองอีกครั้ง",
                    });
                    </script>';
                    header("Location: ../../profile");
                }
            } else {
                $_SESSION['error'] = '<script>
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: "มีข้อผิดพลาดในการอัปโหลดรูปภาพ",
                    confirmButtonColor: "#ff7961",
                    confirmButtonText: "ลองอีกครั้ง",
                });
                </script>';
                header("Location: ../../profile");
            }
        } else {
            $_SESSION['error'] = '<script>
            Swal.fire({
                icon: "error",
                title: "อัพโหลดภาพโปรไฟล์ไม่ได้",
                text: "รูปแบบไฟล์ไม่ถูกต้อง โปรดเลือกไฟล์รูปภาพเท่านั้น",
                confirmButtonColor: "#ff7961",
                confirmButtonText: "ลองใหม่อีกครั้ง",
                footer: "รองรับแค่ไฟล์ชนิด jpg jpeg png",
            });
            </script>';
            header("Location: ../../profile");
        }
    } 

    $sql = "UPDATE user SET username = ?, name = ?, phone = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $newUsername, $name, $phone, $user_id);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = '<script>
        Swal.fire({
        icon: "success",
        title: "เรียบร้อย!",
        text: "อัพเดทข้อมูลผู้ใช้เรียบร้อย!",
        confirmButtonColor: "#5fe280",
        confirmButtonText: "โอเค",
        });
        </script>';
        header("Location: ../../profile");
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

