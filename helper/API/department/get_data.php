<?php

include '../../server/db.php';

if (isset($_POST['workGroupId'])) {
    $workGroupId = $_POST['workGroupId'];

    $departmentSql = "SELECT * FROM department WHERE work_group_id = $workGroupId";
    $result = $conn->query($departmentSql);


    $departments = array();
    while ($departmentRow = mysqli_fetch_assoc($result)) {
      $departments[] = array(
        'department_id' => $departmentRow['department_id'],
        'department_name' => $departmentRow['department_name'],
      );
    }
    header('Content-Type: application/json');
    echo json_encode($departments);
} else {
    echo "Error: Missing missionGroupId parameter";
    exit;
}

?>