<?php
include '../../../config/config_db.php';
// include '../../models/ReportModel.php';
include '../../models/DepartmentModel.php';
if ($_POST) {
  $params = $columns = $totalRecords = $data = array();

  $params = $_REQUEST;

  $columns = array(
    0 => 'dep_name',
    1 => 'count_com',
  );

  $where_condition =   $sqlTot = $sqlRec = "";
  if ($params['dep_id'] === "all") {
    $where_condition .= " GROUP BY Dep_ID";
  } else {
    $where_condition .= " WHERE Dep_ID = '{$params['dep_id']}' GROUP BY Dep_ID";
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
      $data["draw"] = intval($params['draw']);
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

  // $fields = "COUNT(*) as cntCom";
  // $condition = $dep_id === "all" ? "Dep_ID GROUP BY Dep_ID" : "Dep_ID = '$dep_id'";
  // $sql = Report::getReportByDepartment($fields, $condition);
  // //get name department

  // //end get name department
  // $checkData = $query->num_rows;
  // $data = [];
  // if ($checkData > 0) {
  //     $no = 0;
  // while ($data_report = $query->fetch_array()) {
  //     $sql_dept = Department::getDepartmentByID($data_report["Dep_ID"]);
  //     $query_dept = $conn_backoffice->query($sql_dept);
  //     $data_dept = $query_dept->fetch_array();
  //     $data["draw"] = 1;
  //     $data["recordsTotal"] = $checkData;
  //     $data["recordsFiltered"] = $checkData;
  //     $data["data"][$no]["DT_RowId"] = "row_".($no+1);
  //     $data["data"][$no]["dep_name"] = $data_dept["dept_name"];
  //     $data["data"][$no]["count_com"] = (int)$data_report["cntCom"];
  //     $no++;
  // }
  // }
  // $data = [];

  // for ($i = 0; $i < 10 ; $i++) { 
  //     $data["data"][$i]["number"] = "num ".($i+1);
  //     $data["data"][$i]["number2"] = "num2 ".($i+1);
  // }
  echo json_encode($data);
}
