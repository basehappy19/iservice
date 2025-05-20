<?php
session_start();
require 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM user WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['error'] = '<script>
        Swal.fire({
            icon: "error",
            title: "เกิดข้อผิดพลาด",
            text: "ไม่พบข้อมูลผู้ใช้",
            confirmButtonColor: "#ff7961",
            confirmButtonText: "ลองอีกครั้ง",
        });
        </script>';
        header("Location: ../../profile.php");
        exit();
    }

    $new_username = $_POST['username'] ?? $user['username'];
    $name = $_POST['name'] ?? $user['name'];
    $phone = $_POST['phone'] ?? $user['phone'];

    $check_username_already = "SELECT * FROM user WHERE username = :username";
    $stmt = $conn->prepare($check_username_already);
    $stmt->bindParam(':username', $new_username, PDO::PARAM_STR);
    $stmt->execute();
    $check_username = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($check_username) {
        $_SESSION['error'] = '<script>
        Swal.fire({
            icon: "error",
            title: "ชื่อผู้ใช้ซ้ำ",
            text: "ชื่อผู้ใช้ที่คุณเลือกมีอยู่แล้ว โปรดลองอีกครั้ง",
            confirmButtonColor: "#ff7961",
            confirmButtonText: "ลองอีกครั้ง",
        });
        </script>';
        header("Location: ../../profile.php");
        exit();
    }

    
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['profile_pic']['name'];
        $file_name = preg_replace('/[^a-zA-Z0-9._-]/', '', $file_name);
        $file_tmp_name = $_FILES['profile_pic']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png");

        if (in_array($file_ext, $allowed_extensions)) {
            $file_destination = $user_id . '_' . $file_name;
            $file_folder = '../data/profile/' . $file_destination;

            if (move_uploaded_file($file_tmp_name, $file_folder)) {                
                $sql = "UPDATE user SET profile_pic = :profile_pic WHERE user_id = :user_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':profile_pic', $file_destination, PDO::PARAM_STR);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                if ($stmt->execute()) {
                    $_SESSION['success'] = '<script>
                    Swal.fire({
                        icon: "success",
                        title: "เรียบร้อย!",
                        text: "อัพเดทข้อมูลผู้ใช้เรียบร้อย!",
                        confirmButtonColor: "#5fe280",
                        confirmButtonText: "โอเค",
                    });
                    </script>';
                    header("Location: ../../profile.php");
                } else {
                    $_SESSION['error'] = '<script>
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "ไม่สามารถอัปเดตข้อมูลผู้ใช้ได้",
                        confirmButtonColor: "#ff7961",
                        confirmButtonText: "ลองอีกครั้ง",
                    });
                    </script>';
                    header("Location: ../../profile.php");
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
                header("Location: ../../profile.php");
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
            header("Location: ../../profile.php");
        }
    } 

    $sql = "UPDATE user SET username = :username, name = :name, phone = :phone WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $new_username, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        $_SESSION['success'] = '<script>
        Swal.fire({
            icon: "success",
            title: "เรียบร้อย!",
            text: "อัพเดทข้อมูลผู้ใช้เรียบร้อย!",
            confirmButtonColor: "#5fe280",
            confirmButtonText: "โอเค",
        });
        </script>';
        header("Location: ../../profile.php");
    } else {
        $_SESSION['error'] = '<script>
        Swal.fire({
            icon: "error",
            title: "เกิดข้อผิดพลาด",
            text: "ไม่สามารถอัปเดตข้อมูลผู้ใช้ได้",
            confirmButtonColor: "#ff7961",
            confirmButtonText: "ลองอีกครั้ง",
        });
        </script>';
        header("Location: ../../profile.php");
    }
}

