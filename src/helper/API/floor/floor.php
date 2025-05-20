<?php
header('Content-Type: application/json');

require_once '../../server/db.php';

if (isset($_GET['building_id'])) {
    $building_id = $_GET['building_id'];

    try {
        $stmt = $conn->prepare("SELECT floor_id, floor_name FROM floor WHERE building_id = :building_id");
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_INT);
        $stmt->execute();

        $floors = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($floors);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Missing floors']);
}
