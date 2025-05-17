<?php
include '../../server/db.php';
if (isset($_POST['buildingId'])) {
    $buildingId = $_POST['buildingId'];
    $floorSql = "SELECT * FROM floor WHERE building_id = $buildingId";
    $result = $conn->query($floorSql);
    
    $floors = array();
    while ($floorRow = mysqli_fetch_assoc($result)) {
      $floors[] = array(
        'floor_id' => $floorRow['floor_id'],
        'floor_name' => $floorRow['floor_name'],
      );
    }
    header('Content-Type: application/json');
    echo json_encode($floors);
  } else {
    echo "Error: Missing buildingId parameter";
    exit;
  }

  