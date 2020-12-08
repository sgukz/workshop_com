<?php
include '../../../config/config_db.php';
include '../../models/DepartmentModel.php';

$get_dep = getDep();
// echo $get_dep;
$query_dep = $conn_dep->query($get_dep);
$result = [];
while ($rs = $query_dep->fetch_array()) {
    array_push($result, $rs);
}
echo json_encode($result);