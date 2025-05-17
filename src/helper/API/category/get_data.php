<?php

include '../../server/db.php';

if (isset($_POST['categoryId'])) {
    $categoryId = $_POST['categoryId'];

    $typeSql = "SELECT * FROM type WHERE category_id = $categoryId";
    $result = $conn->query($typeSql);

    $types = array();
    while ($typeRow = mysqli_fetch_assoc($result)) {
      $types[] = array(
        'type_id' => $typeRow['type_id'],
        'type_name' => $typeRow['type_name'],
      );
    }
    header('Content-Type: application/json');
    echo json_encode($types);
} else {
    echo "Error: Missing missionGroupId parameter";
    exit;
}

?>