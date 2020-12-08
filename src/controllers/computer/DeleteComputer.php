<?php
include '../../../config/config_db.php';
include '../../models/ComputerModel.php';
$resp = [];
$id = $_GET["id"];
$del_com = Delete($id);
$query_com = $conn_main->query($del_com);
if ($query_com) {
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
