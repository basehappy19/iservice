<?php
$regisall = "SELECT COUNT(*) as total FROM device";
$broken = "SELECT COUNT(*) as total FROM device_broken WHERE status_repair_id NOT IN (1, 4, 5)";
$pending_confirm = "SELECT COUNT(*) as total FROM device_broken WHERE status_repair_id = 3";
$pending_regis = "SELECT COUNT(*) as total FROM device_broken WHERE status_repair_id = 2";
$success_fix = "SELECT COUNT(*) as total FROM device_broken WHERE status_repair_id = 1";

try {

    $stmt1 = $conn->query($regisall);
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    $total1 = $row1['total'];

    $stmt2 = $conn->query($broken);
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $total2 = $row2['total'];

    $stmt5 = $conn->query($pending_confirm);
    $row5 = $stmt5->fetch(PDO::FETCH_ASSOC);
    $total5 = $row5['total'];

    $stmt3 = $conn->query($pending_regis);
    $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
    $total3 = $row3['total'];

    $stmt4 = $conn->query($success_fix);
    $row4 = $stmt4->fetch(PDO::FETCH_ASSOC);
    $total4 = $row4['total'];
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}