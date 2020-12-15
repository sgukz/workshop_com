<?php
include '../../../config/config_db.php';
include '../../models/PrinterModel.php';

$printer_barcode = strtoupper(trim($_GET["id"]));
// echo $printer_barcode;
$sql_printer_barcode = getPrinterById($printer_barcode);
$query_printer_barcode = $conn_backoffice->query($sql_printer_barcode);
$num_row = $query_printer_barcode->num_rows;
$resp = [];
if ($num_row > 0) {
    $data_printer = $query_printer_barcode->fetch_assoc();
    $sql_printer = getCheckPrinterById($data_printer["printer_barcode"]);
    $query_printer = $conn_main->query($sql_printer);
    $num_printer = $query_printer->num_rows;
    if ($num_printer > 0) {
        $data_printer_check = $query_printer->fetch_assoc();
        $printer_barcode = $data_printer_check["printer_id"];
    } else {
        $printer_barcode = "";
    }

    $resp = [
        "status_code" => 200,
        "printer_barcode" => $printer_barcode,
        "printer_sn" => $data_printer["printer_sn"],
        "printer_name" => $data_printer["printer_name"],
        "printer_detail" => $data_printer["dept_addr"],
        "printer_dep_id" => $data_printer["dept_id"],
        "status_printer_check" => $num_printer,
        "text" => "โหลดข้อมูลเรียบร้อย",
        "type" => "success"
    ];
} else {
    $resp = [
        "status_code" => 400,
        "text" => "ไม่มีข้อมูล...",
        "type" => "error"
    ];
}

echo json_encode($resp);
