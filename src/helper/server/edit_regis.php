<?php
require './db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $device_id = $_POST['device_id'];

    $query = "SELECT * FROM device WHERE device_id = :device_id";
    $stmt = $conn->prepare($query);
    $stmt->execute([':device_id' => $device_id]);
    $existingData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$existingData) {
        header("location: ../../list-item.php");
        exit;
    }
    $fields = [
        'category_id',
        'regis_number',
        'mission_group_id',
        'work_group_id',
        'department_id',
        'institute_id',
        'building_id',
        'floor_id',
        'type_id',
        'brand',
        'model',
        'serialnumber',
        'responsible',
        'status_id',
        'year_received',
        'budget_year',
        'budget_source_id',
        'old_department',
        'service_life',
        'depreciation',
        'netbook_value',
        'transfer_date',
        'unit',
        'change_date',
        'exp_date',
        'shop',
        'warranty_start',
        'warranty',
        'warranty_end',
        'note'
    ];

    $updateData = [];
    foreach ($fields as $field) {
        if (in_array($field, ['year_received', 'budget_year', 'transfer_date', 'change_date', 'exp_date', 'warranty_start', 'warranty_end'])) {
            $value = !empty($_POST[$field]) ? $_POST[$field] : $existingData[$field];

            if (!empty($value) && strpos($value, '-') !== false) {
                $dateParts = explode('-', $value);
                $year = (int)$dateParts[0];

                if ($year > 2500) {
                    $dateParts[0] = $year - 543;
                    $value = implode('-', $dateParts);
                }
            }
            else if (!empty($value) && is_numeric($value) && (int)$value > 2500) {
                $value = (int)$value - 543;
            }

            $updateData[$field] = $value;
            continue;
        }

        $updateData[$field] = !empty($_POST[$field]) ? $_POST[$field] : $existingData[$field];
    }

    $setClause = implode(", ", array_map(fn($field) => "$field = :$field", $fields));
    $query = "UPDATE device SET $setClause WHERE device_id = :device_id";

    $updateData['device_id'] = $device_id;

    $stmt = $conn->prepare($query);

    try {
        $stmt->execute($updateData);
        header("location: ../../list-item.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
