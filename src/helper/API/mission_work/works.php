<?php
header('Content-Type: application/json');

require_once '../../server/db.php';

if (isset($_GET['mission_group_id'])) {
    $mission_group_id = $_GET['mission_group_id'];

    try {
        $stmt = $conn->prepare("SELECT work_group_id, work_group_name FROM work_group WHERE mission_group_id = :mission_group_id");
        $stmt->bindParam(':mission_group_id', $mission_group_id, PDO::PARAM_INT);
        $stmt->execute();

        $work_groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($work_groups);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Missing mission_group_id']);
}
