<?php
include '../../../config/config_db.php';
// include '../../models/ReportModel.php';
include '../../models/DepartmentModel.php';
if ($_POST) {
  $params = $totalRecords = $data = array();

  $dep_id = $_REQUEST["dep_id"];
  $is_equip = $_REQUEST["is_equip"];
  $not_equip = $_REQUEST["not_equip"];

  $where_condition =  $sqlTot = $sqlRec = "";
  if ($dep_id === "all") {
    if($is_equip == "true" && $not_equip == "true"){
      $where_condition .= " GROUP BY Dep_ID";
    }else if($is_equip == "true" && $not_equip == "false"){
      $where_condition .= " WHERE Com_Equip <> '' AND Com_Equip <> 'ไม่มี' AND Com_Equip IS NOT NULL GROUP BY Dep_ID";
    }else if($is_equip == "false" && $not_equip == "true"){
      $where_condition .= " WHERE Com_Equip = '' OR Com_Equip = 'ไม่มี' OR Com_Equip IS NULL GROUP BY Dep_ID";
    }else{
      $where_condition .= " GROUP BY Dep_ID";
    }
  } else {
    $where_condition .= " WHERE Dep_ID = '{$dep_id}' GROUP BY Dep_ID";
  }
  $sql_query = "SELECT Dep_ID, COUNT(*) as cntCom FROM com ";
  $sqlTot .= $sql_query;
  $sqlRec .= $sql_query;

  if (isset($where_condition) && $where_condition != '') {
    $sqlTot .= $where_condition;
    $sqlRec .= $where_condition;
  }
  $sqlRec .= " ORDER BY cntCom";
  $queryTot = $conn_main->query($sqlTot);
  $totalRecords = $queryTot->num_rows;
  $queryRecords = $conn_main->query($sqlRec);
  if ($totalRecords > 0) {
    $no = 0;
    while ($data_report = $queryRecords->fetch_array()) {
      $sql_dept = Department::getDepartmentByID($data_report["Dep_ID"]);
      $query_dept = $conn_backoffice->query($sql_dept);
      $data_dept = $query_dept->fetch_array();
      $sql_printer = "SELECT * FROM printer WHERE printer_dep_id = '{$data_report["Dep_ID"]}'";
      $query_printer = $conn_main->query($sql_printer);
      $cntPrinter = $query_printer->num_rows;
      $data["recordsTotal"] = $totalRecords;
      $data["recordsFiltered"] = $totalRecords;
      $data["data"][$no]["order"] = intval($no + 1);
      $data["data"][$no]["dep_name"] = $data_dept["dept_name"];
      $data["data"][$no]["count_com"] = intval($data_report["cntCom"]);
      $data["data"][$no]["count_printer"] = intval($cntPrinter);
      $no++;
    }
  } else {
    $data["data"] = [];
    $data["recordsTotal"] = 0;
    $data["recordsFiltered"] = 0;
  }
  header("Content-type: application/json");
  echo json_encode($data);
}
