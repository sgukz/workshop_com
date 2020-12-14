<?php
include '../../../config/config_db.php';
include '../../models/PrinterModel.php';
$pattern_printer_barcode = "";
// is_add_new = 1 ### This is add data new
if ($_POST["is_add_new"] == 1) {
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
            "printer_id" => $pattern_printer_barcode,
            "printer_model" => $_POST["p_brand"]." ".$_POST["pmodel"],
            "printer_type" => $_POST["p_type"],
            "printer_detail" => $_POST["p_detail"],
            "printer_equip" => $_POST["p_equip"],
            "printer_dep_id" => $_POST["department"],
            "created_date" => "NOW()",
        ];
        $query_cr_printer = Insert("cr_computer", $arrCrPrinetr);
        $insert_cr_printer = $conn_backoffice->query($query_cr_printer);
    }
}
