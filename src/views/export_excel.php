<?php
/*
 * ส่งออกรายงานเป็น excel
 */
ini_set('max_execution_time', 1500);
ini_set('memory_limit', '-1');
date_default_timezone_set('Asia/Bangkok');
$date_ = date('Y_m_d');
$params = $_REQUEST;
include '../../config/config_db.php';
include '../models/DepartmentModel.php';

$where_condition = $totalCom = $totalPrinter = "";
$sql_query = "SELECT Dep_ID, COUNT(*) as cntCom FROM com ";
if ($params['dep_id'] === "all") {
    $where_condition .= " GROUP BY Dep_ID ORDER BY cntCom";
} else {
    $where_condition .= " WHERE Dep_ID = '{$params['dep_id']}' GROUP BY Dep_ID ORDER BY cntCom";
}
$sql_query .= $where_condition;
$query = $conn_main->query($sql_query);
$checkData = $query->num_rows;
if ($checkData > 0) {
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment; filename="report_computer' . $date_ . '".xls"');
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        </meta>
    </head>

    <body STYLE='font-family:TH SarabunPSK;'>
        <table style="font-size: 14pt;font-family:  TH SarabunPSK;" border="1">
            <tr>
                <td colspan="4" style="font-size: 16pt;font-family:  TH SarabunPSK; font-weight: bold;"><b><?php echo "รายการครุภัณฑ์คอมพิวเตอร์และปริ้นเตอร์"; ?></b></td>
            </tr>
            <tr style="text-align: center;" height="50">
                <td align="center" width="80" style="font-size: 16pt;font-family:  TH SarabunPSK; font-weight: bold;">ลำดับ</td>
                <td align="center" width="250" style="font-size: 16pt;font-family:  TH SarabunPSK; font-weight: bold;">หน่วยงาน</td>
                <td align="center" width="120" style="font-size: 16pt;font-family:  TH SarabunPSK;font-weight: bold;">จำนวนคอมพิวเตอร์</td>
                <td align="center" width="120" style="font-size: 16pt;font-family:  TH SarabunPSK;font-weight: bold;">จำนวนปริ้นเตอร์</td>
            </tr>
            <?php
            $no = 1;
            while ($data_report = $query->fetch_array()) {
                $sql_dept = Department::getDepartmentByID($data_report["Dep_ID"]);
                $query_dept = $conn_backoffice->query($sql_dept);
                $data_dept = $query_dept->fetch_array();
                $sql_printer = "SELECT * FROM printer WHERE printer_dep_id = '{$data_report["Dep_ID"]}'";
                $query_printer = $conn_main->query($sql_printer);
                $cntPrinter = $query_printer->num_rows;
                $totalCom += $data_report["cntCom"];
                $totalPrinter += $cntPrinter;
            ?>
                <tr height="40">
                    <td align="center" style="font-size: 14pt;font-family:  TH SarabunPSK;">
                        <?php echo $no; ?>
                    </td>
                    <td style="font-size: 14pt;font-family:  TH SarabunPSK;"><?php echo $data_dept["dept_name"]; ?></td>
                    <td align="center" style="font-size: 14pt;font-family:  TH SarabunPSK;"><?php echo intval($data_report["cntCom"]); ?></td>
                    <td align="center" style="font-size: 14pt;font-family:  TH SarabunPSK;"><?php echo intval($cntPrinter); ?></td>
                </tr>
            <?php $no++;
            } ?>
            <tr height="40">
                <td colspan="2" align="center" style="font-size: 14pt;font-family: TH SarabunPSK; font-weight: bold;">
                    รวม
                </td>
                <td align="center" style="font-size: 14pt;font-family: TH SarabunPSK;font-weight: bold;"><?php echo intval($totalCom); ?></td>
                <td align="center" style="font-size: 14pt;font-family: TH SarabunPSK;font-weight: bold;"><?php echo intval($totalPrinter); ?></td>
            </tr>
        </table>
    </body>

    </html>
<?php } else {
    echo "<script>alert('ไม่มีข้อมูล!!!');window.location = 'main.php?page=show-report';</script>";
} ?>