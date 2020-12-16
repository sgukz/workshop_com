<?php
include '../../../config/config_db.php';
include '../../models/ComputerModel.php';
$computer = new Computer();
$barcode = strtoupper(trim($_GET["id"])); //C63020001
$sql_barcode = $computer->getComputerByBarcode($barcode);
$query_barcode = $conn_backoffice->query($sql_barcode);
$num_row = $query_barcode->num_rows;
$resp = [];

if($num_row > 0){
    $data_com = $query_barcode->fetch_assoc();
    $sql_com = $computer->getComputerByID($data_com["computer_barcode"]);
    $query_com = $conn_main->query($sql_com);
    $num_com = $query_com->num_rows;
    $computer_name = "";
    if($num_com > 0){
        $data_com_check = $query_com->fetch_assoc();
        $computer_name = $data_com_check["Com_name"];
    }else{
        $computer_name = $data_com["computer_name"];
    }
    
    $resp = [
        "status_code" => 200,
        "com_number" => $data_com["computer_barcode"],
        "com_equip" => $data_com["computer_sn"],
        "com_name" => $computer_name,
        "com_detail" => $data_com["dept_addr"],
        "status_com_check" => $num_com,
        "text" => "กำลังโหลดข้อมูล",
        "type" => "success"
    ];
}else {
    $resp = [
        "status_code" => 400,
        "text" => "ไม่มีข้อมูล...",
        "type" => "error"
    ];
}

echo json_encode($resp);