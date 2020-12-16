<?php
class Department
{
    public function getDepartment()
    {
        $sql = "SELECT dept_id, dept_name FROM cr_department ORDER BY dept_name";
        return $sql;
    }

    public function getDepartmentByID($id)
    {
        $sql = "SELECT dept_name FROM cr_department WHERE dept_id = '$id'";
        return $sql;
    }
}
