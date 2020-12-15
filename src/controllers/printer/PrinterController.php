<?php
include '../../../config/config_db.php';
include '../../models/ComputerModel.php';
include '../../models/PrinterModel.php';
$pattern_printer_barcode = "";
// is_add_new = 1 ### This is add data new
if ($_POST["is_add_new"] == "add") {
    if ($_POST["pnum"] === "") {
        $year_ = (int)date("y") + 43;
        $month_ = (int)date("m");
        $fix_printer_barcode = "P" . $year_ . "" . $month_; //C6312
        $new_order = str_pad(1, 4, '0', STR_PAD_LEFT); //0001
        $sql = getPrinterByBarcode($fix_printer_barcode);
        $query = $conn_backoffice->query($sql);
        $getData = $query->fetch_assoc();
        if ($getData["printer_barcode"] !== null) {
            $sub_str = substr($getData["printer_barcode"], 5);
            $number = (int)$sub_str + 1;
            $order = str_pad($number, 4, '0', STR_PAD_LEFT);
            $pattern_printer_barcode = $fix_printer_barcode . $order;
        } else {
            $pattern_printer_barcode = $fix_printer_barcode . $new_order;
        }
        $arrCrPrinetr = [
            "printer_barcode" => $pattern_printer_barcode,
            "printer_sn" => $_POST["p_equip"],
            "printer_date" => "NOW()",
            "printer_name" => $_POST["p_brand"] . " " . $_POST["pmodel"],
            "dept_id" => $_POST["p_dept"],
            "dept_addr" => $_POST["p_detail"],
            "printer_inpdate" => "NOW()",
            "status" => 1
        ];
        $checkDuplicatePrinter = getPrinterById($pattern_printer_barcode);
        $query_check = $conn_backoffice->query($checkDuplicatePrinter);
        $num_row_duplicate = $query_check->num_rows;
        if ($num_row_duplicate === 0) {
            $query_cr_printer = Insert("cr_printer", $arrCrPrinetr);
            $insert_cr_printer = $conn_backoffice->query($query_cr_printer);
            if ($conn_backoffice->error) {
                $resp = [
                    "status_code" => 200,
                    "title" => "เกิดข้อผิดพลาด",
                    "text" => $conn_backoffice->error,
                    "type" => "error"
                ];
            }
        }
    } else {
        $printer_barcode = $_POST["pnum"];
        $arrCrPrinter = [
            "printer_sn" => $_POST["p_equip"],
            "printer_name" => $_POST["p_brand"] . " " . $_POST["pmodel"],
            "dept_id" => $_POST["p_dept"],
            "dept_addr" => $_POST["p_detail"],
        ];
        $condition_printer = "printer_barcode = '$printer_barcode'";
        $query_cr_printer_update = Update("cr_printer", $arrCrPrinter, $condition_printer);
        $update_cr_printer = $conn_backoffice->query($query_cr_printer_update);
    }
    $pnum = $pattern_printer_barcode !== "" ? $pattern_printer_barcode : strtoupper($_POST["pnum"]);
    $arrDataPrinter = [
        "printer_id" => $pnum,
        "printer_model" => $_POST["p_brand"] . " " . $_POST["pmodel"],
        "printer_type" => $_POST["p_type"],
        "printer_detail" => $_POST["p_detail"],
        "printer_equip" => $_POST["p_equip"],
        "printer_dep_id" => $_POST["p_dept"],
        "created_date" => "NOW()",
    ];
    $query_add_printer = Insert("printer", $arrDataPrinter);
    $insert_printer = $conn_main->query($query_add_printer);

    if ($insert_printer) {
        $resp = [
            "status_code" => 200,
            "title" => "บันทึกข้อมูลเรียบร้อย",
            "type" => "success",
            "section" => "add",
            "printer_id" => $pnum
        ];
    } else {
        $resp = [
            "status_code" => 400,
            "title" => "เกิดข้อผิดพลาด!!!",
            "type" => "error",
            "text" => $conn_main->error,
            "sql" => $query_add_printer
        ];
    }
} else if ($_POST["is_add_new"] == "update") {
    $pnum = $_POST["pnum"];
    $condition_cr_printer = "printer_barcode = '$pnum'";
    $condition_printer = "printer_id = '$pnum'";
    $arrCrPrinetr = [
        "printer_sn" => $_POST["p_equip"],
        "printer_name" => $_POST["p_brand"] . " " . $_POST["pmodel"],
        "dept_id" => $_POST["p_dept"],
        "dept_addr" => $_POST["p_detail"]
    ];
    $arrDataPrinter = [
        "printer_model" => $_POST["p_brand"] . " " . $_POST["pmodel"],
        "printer_type" => $_POST["p_type"],
        "printer_detail" => $_POST["p_detail"],
        "printer_equip" => $_POST["p_equip"],
        "printer_dep_id" => $_POST["p_dept"],
        "updated_date" => "NOW()",
    ];

    $query_cr_printer_update = Update("cr_printer", $arrCrPrinetr, $condition_printer);
    $update_cr_printer = $conn_backoffice->query($query_cr_printer_update);
    $query_printer_update = Update("printer", $arrDataPrinter, $condition_printer);
    $update_printer = $conn_main->query($query_printer_update);

    if ($update_printer) {
        $resp = [
            "status_code" => 200,
            "title" => "แก้ไขข้อมูลเรียบร้อย",
            "type" => "success",
            "section" => "update",
            "printer_id" => $pnum
        ];
    } else {
        $resp = [
            "status_code" => 400,
            "title" => "เกิดข้อผิดพลาด!!!",
            "type" => "error",
            "text" => $conn_main->error,
            "sql" => $query_printer_update
        ];
    }

}
echo json_encode($resp);
