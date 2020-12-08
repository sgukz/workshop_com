<?php

$HOST_MAIN = "";
$USER_MAIN = "";
$PASS_MAIN = '';
$DBNAME_MAIN = "";

$HOST = "";
$USER = "";
$PASS = '';
$DBNAME = "";

$conn_main = new mysqli(
    $HOST_MAIN,
    $USER_MAIN,
    $PASS_MAIN,
    $DBNAME_MAIN
);

$conn_backoffice = new mysqli(
    $HOST,
    $USER,
    $PASS,
    $DBNAME
);

//Connection Database Hospital
#### Check connection to database ####
if ($conn_main->connect_error) {
    //Error connection
    die("Connection error message: " . $conn_main->connect_error);
    exit;
} else {
    //Correct connection
    $conn_main->query("SET NAMES UTF8");
    // echo "Connected database hospital...";
}

//Connection Database Backoffice
#### Check connection to database ####
if ($conn_backoffice->connect_error) {
    //Error connection
    die("Connection error message: " . $conn_backoffice->connect_error);
    exit;
} else {
    //Correct connection
    $conn_backoffice->query("SET NAMES UTF8");
    // echo "Connected database hospital...";
}
