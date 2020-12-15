<?php
function getPrinterAll()
{
    $sql = "SELECT * FROM printer ORDER BY created_date DESC";
    return $sql;
}

function getCheckPrinterById($printer_id)
{
    $sql = "SELECT * 
            FROM printer
            WHERE printer_id = '$printer_id'
            LIMIT 1";
    return $sql;
}

function getPrinterById($printer_barcode)
{
    $sql = "SELECT * 
            FROM cr_printer
            WHERE printer_barcode = '$printer_barcode'
            LIMIT 1";
    return $sql;
}

function getPrinterByBarcode($fix_printer_barcode)
{
    $sql = "SELECT printer_barcode 
                    FROM cr_printer
                    WHERE  printer_barcode LIKE '%$fix_printer_barcode%'
                    ORDER BY printer_barcode DESC
                    LIMIT 1";
    return $sql;
}

function DeletePrinter($id)
{
    $sql = "DELETE FROM printer WHERE printer_id = '$id'";
    return $sql;
}