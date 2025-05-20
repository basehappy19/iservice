<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $regis_date = date("Y-m-d");
    $regis_number = $_POST['regis_number'];
    $category_id = $_POST['category_id'];
    $mission_group_id = $_POST['mission_group_id'];
    $work_group_id = $_POST['work_group_id'];
    $department_id = $_POST['department_id'];
    $institute_id = $_POST['institute_id'];
    $building_id = $_POST['building_id'];
    $floor_id = $_POST['floor_id'];
    $type_id = $_POST['type_id'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $responsible = $_POST['responsible'];
    $serialnumber = $_POST['serialnumber'];
    $status_id = $_POST['status_id'];
    $year_received = $_POST['year_received'];
    $budget_year = $_POST['budget_year'];
    $budget_source_id = $_POST['budget_source_id'];
    if ($_POST['old_department'] == '') {
        $old_department = '63';
    } else {
        $old_department = $_POST['old_department'];
    }
    
    $service_life = $_POST['service_life'];
    $depreciation = $_POST['depreciation'];
    $netbook_value = $_POST['netbook_value'];
    $transfer_date = $_POST['transfer_date'];
    $unit = $_POST['unit'];
    $change_date = $_POST['change_date'];
    $exp_date = $_POST['exp_date'];
    $shop = $_POST['shop'];
    $warranty_start = $_POST['warranty_start'];
    $warranty = $_POST['warranty'];
    $warranty_end = $_POST['warranty_end'];
    $note = $_POST['note'];
    
    $stmt = $conn->prepare("INSERT INTO device (
        category_id,
        mission_group_id,
        work_group_id, 
        department_id,
        institute_id,
        building_id, 
        floor_id, 
        type_id, 
        brand, 
        model, 
        regis_number, 
        responsible, 
        year_received, 
        budget_year, 
        budget_source_id, 
        regis_date, 
        old_department,
        service_life,
        depreciation,
        netbook_value,
        serialnumber, 
        transfer_date, 
        unit, 
        change_date, 
        exp_date, 
        shop, 
        warranty_start, 
        warranty, 
        warranty_end, 
        note,
        status_id
        )
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
    
    $stmt->bind_param("sssssssssssssssssssssssssssssss", 
        $category_id, 
        $mission_group_id, 
        $work_group_id, 
        $department_id, 
        $institute_id, 
        $building_id, 
        $floor_id, 
        $type_id, 
        $brand, 
        $model, 
        $regis_number, 
        $responsible, 
        $year_received, 
        $budget_year, 
        $budget_source_id, 
        $regis_date, 
        $old_department, 
        $service_life, 
        $depreciation, 
        $netbook_value, 
        $serialnumber, 
        $transfer_date, 
        $unit, 
        $change_date, 
        $exp_date, 
        $shop, 
        $warranty_start, 
        $warranty, 
        $warranty_end, 
        $note,
        $status_id);
    
    if ($stmt->execute()) {
        header("location: ../../list-item.php");
        exit(); 
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}    
?>
