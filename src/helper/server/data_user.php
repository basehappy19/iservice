<?php 
$user_id = $_SESSION['user_id'];

$Usersql = "SELECT * FROM user WHERE user_id = '$user_id'";
$Userresult = mysqli_query($conn, $Usersql);

if ($Userresult) {
    $data_user = mysqli_fetch_assoc($Userresult);
}