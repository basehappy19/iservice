<?php

include '../../server/db.php';

if (isset($_POST['missionGroupId'])) {
    $missionGroupId = $_POST['missionGroupId'];

    $workGroupSql = "SELECT * FROM work_group WHERE mission_group_id = $missionGroupId";
    $result = $conn->query($workGroupSql);


    $workGroups = array();
    while ($workGroupRow = mysqli_fetch_assoc($result)) {
      $workGroups[] = array(
        'work_group_id' => $workGroupRow['work_group_id'],
        'work_group_name' => $workGroupRow['work_group_name'],
      );
    }
    header('Content-Type: application/json');
    echo json_encode($workGroups);
} else {
    echo "Error: Missing missionGroupId parameter";
    exit;
}

?>
