<?php
include '../../../config/config_db.php';
include '../../models/ComputerModel.php';
$computer = new Computer();
$db = new DB();
$pattern_com_barcode = "";

$table_com = "com";
$resp = [];
if (isset($_POST["is_submit"])) {
    if ($_POST["is_submit"] !== "") {
        $arrDataCom = [
            "Com_name" => $_POST["cname"],
            "Com_Brand" => $_POST["model"],
            "Com_Equip" => $_POST["equip"],
            "Com_CPU" => $_POST["cpu"],
            "Com_RAM" => $_POST["ram"],
            "Com_OS_Version" => $_POST["osversion"],
            "Com_IP_Address" => $_POST["ipaddress"],
            "Com_Detail" => $_POST["detail"],
            "harddisk_model" => $_POST["harddisk_model"],
            "harddisk_serial" => $_POST["harddisk_serial"],
            "harddisk_type" => $_POST["harddisk_type"],
            "harddisk_size" => $_POST["harddisk_size"],
            "Dep_ID" => $_POST["department"]
        ];
        $arrCrComputer = [
            "computer_sn" => $_POST["equip"],
            "computer_name" => $_POST["cname"],
            "computer_ip" => $_POST["ipaddress"],
            "dept_id" => $_POST["department"],
            "dept_addr" => $_POST["detail"],
            "cpu_speed" => $_POST["cpu"],
            "ram_size" => $_POST["ram"],
            "hardisk_size" => $_POST["harddisk_type"] . " " . $_POST["harddisk_size"],
            "status" => 1,
        ];
        $condition = "Com_number = '{$_POST["cnum"]}'";
        $query_com_update = $db->Update($table_com, $arrDataCom, $condition);
        $update_com = $conn_main->query($query_com_update);
        $condition_cr_com = "computer_barcode = '{$_POST["cnum"]}'";
        $query_cr_com_update = $db->Update("cr_computer", $arrCrComputer, $condition_cr_com);
        $update_cr_com = $conn_backoffice->query($query_cr_com_update);
        if ($update_com) {
            $resp = [
                "status_code" => 200,
                "msg" => "แก้ไขข้อมูลเรียบร้อย",
                "type" => "success",
                "text" => "Successfully",
                "section" => "update",
                "data" => $arrDataCom
            ];
        } else {
            $resp = [
                "status_code" => 400,
                "msg" => "แก้ไขข้อมูลไม่ได้",
                "type" => "error",
                "text" => $conn_main->error,
                "data" => $arrDataCom
            ];
        }
    } else {
        if (isset($_POST["cnum"]) && $_POST["cnum"] === "") {
            $year_ = (int)date("y") + 43;
            $month_ = (int)date("m");
            $fix_com_barcode = "C" . $year_ . "" . $month_; //C6312
            $new_order = str_pad(1, 4, '0', STR_PAD_LEFT); //0001
            $sql = $computer->getComputerBarcode($fix_com_barcode);
            $query = $conn_backoffice->query($sql);
            $getData = $query->fetch_assoc();
            if ($getData["computer_barcode"] !== null) {
                $sub_str = substr($getData["computer_barcode"], 5);
                $number = (int)$sub_str + 1;
                $order = str_pad($number, 4, '0', STR_PAD_LEFT);
                $pattern_com_barcode = $fix_com_barcode . $order;
            } else {
                $pattern_com_barcode = $fix_com_barcode . $new_order;
            }

            $arrCrComputer = [
                "computer_barcode" => $pattern_com_barcode,
                "computer_sn" => $_POST["equip"],
                "computer_date" => "NOW()",
                "computer_name" => $_POST["cname"],
                "computer_ip" => $_POST["ipaddress"],
                "dept_id" => $_POST["department"],
                "dept_addr" => $_POST["detail"],
                "cpu_speed" => $_POST["cpu"],
                "ram_size" => $_POST["ram"],
                "hardisk_size" => $_POST["harddisk_type"] . " " . $_POST["harddisk_size"],
                "status" => 1,
            ];
            $query_cr_computer = $db->Insert("cr_computer", $arrCrComputer);
            $insert_cr_computer = $conn_backoffice->query($query_cr_computer);
        } else {
            $computer_number = $_POST["cnum"];
            $arrDataCrComputer = [
                "computer_sn" => $_POST["equip"],
                "computer_name" => $_POST["cname"],
                "computer_ip" => $_POST["ipaddress"],
                "dept_id" => $_POST["department"],
                "dept_addr" => $_POST["detail"],
                "cpu_speed" => $_POST["cpu"],
                "ram_size" => $_POST["ram"],
                "hardisk_size" => $_POST["harddisk_type"] . " " . $_POST["harddisk_size"],
            ];
            $condition_cr_com = "computer_barcode = '$computer_number'";
            $query_cr_com_update = $db->Update("cr_computer", $arrDataCrComputer, $condition_cr_com);
            $update_cr_com = $conn_backoffice->query($query_cr_com_update);
        }
        $cnum = $pattern_com_barcode !== "" ? $pattern_com_barcode : strtoupper($_POST["cnum"]);
        $arrDataCom = [
            "Com_number" => $cnum,
            "Com_name" => $_POST["cname"],
            "Com_Brand" => $_POST["model"],
            "Com_Equip" => $_POST["equip"],
            "Com_CPU" => $_POST["cpu"],
            "Com_RAM" => $_POST["ram"],
            "Com_OS_Version" => $_POST["osversion"],
            "Com_IP_Address" => $_POST["ipaddress"],
            "Com_Detail" => $_POST["detail"],
            "Com_Date" => "NOW()",
            "harddisk_model" => $_POST["harddisk_model"],
            "harddisk_serial" => $_POST["harddisk_serial"],
            "harddisk_type" => $_POST["harddisk_type"],
            "harddisk_size" => $_POST["harddisk_size"],
            "Dep_ID" => $_POST["department"],
        ];

        $query_com = $db->Insert($table_com, $arrDataCom);
        $insert_com = $conn_main->query($query_com);

        if ($insert_com) {
            $resp = [
                "status_code" => 200,
                "msg" => "บันทึกข้อมูลเรียบร้อย",
                "type" => "success",
                "text" => "Successfully",
                "section" => "add",
                "data" => $cnum
            ];
        } else {
            $resp = [
                "status_code" => 400,
                "msg" => "บันทึกข้อมูลไม่ได้",
                "type" => "error",
                "text" => $conn_main->error,
                "data" => $arrDataCom
            ];
        }
    }
}

echo json_encode($resp);
