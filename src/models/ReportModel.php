<?php
class Report{
    public static function getReportByDepartment($field,$condition){
        $sql = "SELECT 
                    Dep_ID, 
                    $field
                FROM com 
                $condition";
        return $sql;
    }
}