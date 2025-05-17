<?php
$regisall = "SELECT COUNT(*) as total FROM device";
$broken = "SELECT COUNT(*) as total FROM report WHERE status_repair_id NOT IN (1, 4, 5)";
$pending_confirm = "SELECT COUNT(*) as total FROM report WHERE status_repair_id = 3";
$pending_regis = "SELECT COUNT(*) as total FROM report WHERE status_repair_id = 2";
$success_fix = "SELECT COUNT(*) as total FROM report WHERE status_repair_id = 1";

$result1  = mysqli_query($conn, $regisall);
$row1 = mysqli_fetch_assoc($result1);
$total1 = $row1['total'];

$result2 = mysqli_query($conn, $broken);
$row2 = mysqli_fetch_assoc($result2);
$total2 = $row2['total'];

$result5 = mysqli_query($conn, $pending_confirm);
$row5 = mysqli_fetch_assoc($result5);
$total5 = $row5['total'];

$result3 = mysqli_query($conn, $pending_regis);
$row3 = mysqli_fetch_assoc($result3);
$total3 = $row3['total'];

$result4 = mysqli_query($conn, $success_fix);
$row4 = mysqli_fetch_assoc($result4);
$total4 = $row4['total'];