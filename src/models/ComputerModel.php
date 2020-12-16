<?php
class Computer
{
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
}
