<?php
session_start();
if (isset($_POST)) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $userFix = "admin";
    $passFix = "admin";

    $resp = [];
    //Case login successfuly
    if ($username == $userFix && $password == $passFix) {
        $_SESSION["user_login"] = $username;
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
