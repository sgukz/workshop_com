<?php
function Insert($table, $arrayData)
{
    $fields = "";
    $values = "";
    $i = 1;
    $str_fix = "NOW()";
    foreach ($arrayData as $key => $value) {

        if ($i != 1) {
            $fields .= ", ";
            $values .= ", ";
        }
        $fields .= "$key";
        if (strpos($value, $str_fix) !== false) {
            $values .= "$value";
        } else {
            $values .= "'$value'";
        }
        $i++;
    }
    $sql = "INSERT INTO $table($fields) VALUES($values)";
    return $sql;
}
function Update($table, $arrayData, $condition)
{
    $fields = "";
    $i = 1;
    foreach ($arrayData as $key => $value) {
        if ($i != 1) {
            $fields .= ", ";
        }
        $fields .= "$key = " . "'$value'";
        $i++;
    }
    $sql = "UPDATE $table SET $fields WHERE $condition";
    return $sql;
}

function Delete($id)
{
    $sql = "DELETE FROM com WHERE Com_number = '$id'";
    return $sql;
}

function getDataAll()
{
    $sql = "SELECT * FROM com ORDER BY Com_Date DESC";
    return $sql;
}

function getComputerByID($id)
{
    $sql = "SELECT * FROM com WHERE Com_number = '$id'";
    return $sql;
}

function getComputerByName($name)
{
    $sql = "SELECT * FROM com WHERE Com_name = '$name'";
    return $sql;
}

function getComputerBarcode($fix_com_barcode)
{
    $sql = "SELECT computer_barcode 
                    FROM cr_computer
                    WHERE  computer_barcode LIKE '%$fix_com_barcode%'
                    ORDER BY computer_id DESC
                    LIMIT 1";
    return $sql;
}

function getComputerByBarcode($barcode)
{
    $sql = "SELECT * 
            FROM cr_computer
            WHERE  computer_barcode = '$barcode'
            LIMIT 1";
    return $sql;
}



