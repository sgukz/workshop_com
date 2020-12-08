<?php

function getDep(){
    $sql = "SELECT * FROM hrd.department ORDER BY dep_code_name";
    return $sql;
}