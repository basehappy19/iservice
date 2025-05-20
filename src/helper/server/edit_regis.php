<?php
require_once 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $device_id = $_POST['device_id'];
        $category_id = $_POST['category_id'];
        $regis_number = $_POST['regis_number'];
        $mission_group_id = $_POST['mission_group_id'];
        $work_group_id = $_POST['work_group_id'];
        $department_id = $_POST['department_id'];
        $institute_id = $_POST['institute_id'];
        $building_id = $_POST['building_id'];
        $floor_id = $_POST['floor_id'];
        $type_id = $_POST['type_id'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $serialnumber = $_POST['serialnumber'];
        $responsible = $_POST['responsible'];
        $status_id = $_POST['status_id'];
        $year_received = $_POST['year_received'];
        $budget_year = $_POST['budget_year'];
        $budget_source_id = $_POST['budget_source_id'];
        $old_department = $_POST['old_department'];
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
        
        $query = "UPDATE device 
                  SET 
                      category_id=?, 
                      regis_number=?, 
                      mission_group_id=?, 
                      work_group_id=?, 
                      department_id=?, 
                      institute_id=?, 
                      building_id=?, 
                      floor_id=?, 
                      type_id=?, 
                      brand=?, 
                      model=?, 
                      serialnumber=?, 
                      responsible=?, 
                      status_id=?, 
                      year_received=?, 
                      budget_year=?, 
                      budget_source_id=?, 
                      old_department=?, 
                      service_life=?, 
                      depreciation=?, 
                      netbook_value=?, 
                      transfer_date=?, 
                      unit=?, 
                      change_date=?, 
                      exp_date=?, 
                      shop=?, 
                      warranty_start=?, 
                      warranty=?, 
                      warranty_end=?, 
                      note=?
                  WHERE 
                      device_id=?";
        
        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($stmt, "isiiiiiiissssissiissssisssssssi", 
        $category_id, $regis_number, $mission_group_id, $work_group_id, $department_id, $institute_id, $building_id, $floor_id, $type_id, $brand, $model, $serialnumber, $responsible, $status_id, $year_received, $budget_year, $budget_source_id, $old_department, $service_life, $depreciation, $netbook_value, $transfer_date, $unit, $change_date, $exp_date, $shop, $warranty_start, $warranty, $warranty_end, $note, $device_id);


        if (mysqli_stmt_execute($stmt)) {
            header("location: ../../list-item.php");
        } else {
            header("location: ../../list-item.php");
        }

} else {
    header("location: ../../list-item.php"); 
}

?>
