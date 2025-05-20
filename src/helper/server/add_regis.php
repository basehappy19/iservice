<?php
require './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = [
        'category_id' => (int)$_POST['category_id'],
        'mission_group_id' => (int)$_POST['mission_group_id'],
        'work_group_id' => (int)$_POST['work_group_id'],
        'department_id' => (int)$_POST['department_id'],
        'institute_id' => (int)$_POST['institute_id'] == 0 ? null : (int)$_POST['institute_id'],
        'building_id' => (int)$_POST['building_id'],
        'floor_id' => (int)$_POST['floor_id'],
        'type_id' => (int)$_POST['type_id'],
        'brand' => $_POST['brand'],
        'model' => $_POST['model'],
        'regis_number' => $_POST['regis_number'],
        'responsible' => $_POST['responsible'],
        'year_received' => $_POST['year_received'],
        'budget_year' => $_POST['budget_year'],
        'budget_source_id' => $_POST['budget_source_id'],
        'regis_date' => date("Y-m-d"),
        'old_department' => $_POST['old_department'],
        'service_life' => $_POST['service_life'],
        'depreciation' => $_POST['depreciation'],
        'netbook_value' => $_POST['netbook_value'],
        'serialnumber' => $_POST['serialnumber'],
        'transfer_date' => date("Y-m-d", strtotime(str_replace('-', '/', $_POST['transfer_date']))),
        'unit' => $_POST['unit'],
        'change_date' => date("Y-m-d", strtotime(str_replace('-', '/', $_POST['change_date']))),
        'exp_date' => date("Y-m-d", strtotime(str_replace('-', '/', $_POST['exp_date']))),
        'shop' => $_POST['shop'],
        'warranty_start' => date("Y-m-d", strtotime(str_replace('-', '/', $_POST['warranty_start']))),
        'warranty' => $_POST['warranty'],
        'warranty_end' => date("Y-m-d", strtotime(str_replace('-', '/', $_POST['warranty_end']))),
        'note' => $_POST['note'],
        'status_id' => $_POST['status_id']
    ];


    var_dump($data);
    
    $sql = "INSERT INTO device (
        category_id, mission_group_id, work_group_id, department_id, institute_id, 
        building_id, floor_id, type_id, brand, model, regis_number, responsible, 
        year_received, budget_year, budget_source_id, regis_date, old_department, 
        service_life, depreciation, netbook_value, serialnumber, transfer_date, 
        unit, change_date, exp_date, shop, warranty_start, warranty, warranty_end, 
        note, status_id
    ) VALUES (
        :category_id, :mission_group_id, :work_group_id, :department_id, :institute_id, 
        :building_id, :floor_id, :type_id, :brand, :model, :regis_number, :responsible, 
        :year_received, :budget_year, :budget_source_id, :regis_date, :old_department, 
        :service_life, :depreciation, :netbook_value, :serialnumber, :transfer_date, 
        :unit, :change_date, :exp_date, :shop, :warranty_start, :warranty, :warranty_end, 
        :note, :status_id
    )";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);

        header("location: ../../list-item.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
