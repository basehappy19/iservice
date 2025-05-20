<?php
header('Content-Type: application/json');

require_once '../../server/db.php';

if (isset($_GET['work_group_id'])) {
    $work_group_id = $_GET['work_group_id'];

    try {
        $stmt = $conn->prepare("SELECT department_id, department_name FROM department WHERE work_group_id = :work_group_id");
        $stmt->bindParam(':work_group_id', $work_group_id, PDO::PARAM_INT);
        $stmt->execute();

        $work_groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($work_groups);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Missing work_group_id']);
}
