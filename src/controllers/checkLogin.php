<?php
session_start();
include '../../config/config_db.php';
include '../models/LoginModel.php';
if (isset($_POST)) {
    $login = new Login();
    $username = trim($_POST["username"]);
    $password = md5(trim($_POST["password"]));

    $set_check_login = $login->setUserLogin($username, $password);
    $get_check_login = $login->getUserLogin();
    $query_check_login = $conn_main->query($get_check_login);
    $checkData = $query_check_login->num_rows;
    $resp = [];
    //Case login successfuly
    if ($checkData > 0) {
        $data_user = $query_check_login->fetch_assoc();
        $_SESSION["user_login"] = $data_user["user_name"];
        $_SESSION["is_login"] = 1;
        $resp = [
            "status_code" => 200,
            "msg" => "เข้าสู่ระบบสำเร็จ",
            "type" => "success"
        ];
        // header("Location: ../views/main.php");
    } else { //Case login failur
        $_SESSION["invalid_login"] = true;
        $_SESSION["is_login"] = 0;
        $resp = [
            "status_code" => 400,
            "msg" => "เข้าสู่ระบบล้มเหลว",
            "type" => "error"
        ];
        // header("Location: ../../index.php");
    }
    echo json_encode($resp);
}
