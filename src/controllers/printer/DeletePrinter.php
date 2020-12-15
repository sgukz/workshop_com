<?php
include '../../../config/config_db.php';
include '../../models/PrinterModel.php';
$resp = [];
$id = $_GET["id"];
$del_printer = DeletePrinter($id);
$query_printer = $conn_main->query($del_printer);
if ($query_printer) {
    $resp = [
        "status_code" => 200,
        "text" => "ลบข้อมูลเรียบร้อย",
        "type" => "success",
        "data" => $id
    ];
} else {
    $resp = [
        "status_code" => 400,
        "text" => $conn_main->error,
        "type" => "error",
        "data" => $id
    ];
}

echo json_encode($resp);
