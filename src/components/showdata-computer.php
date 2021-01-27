<div class="card bg-light">
    <div class="card-header">
        <h4 class="text-success font-weight-bold">รายการคอมพิวเตอร์ทั้งหมด</h4>
    </div>
    <div class="card-body">
        <a href="?page=computer-create" class="btn btn-success btn-xl mb-3"><i class="fa fa-plus"></i> เพิ่มคอมพิวเตอร์</a>
        <table class="table" id="show-data">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">เลขทะเบียนคอมพิวเตอร์</th>
                    <th class="text-center">เลขครุภัณฑ์</th>
                    <th class="text-center">หน่วยงาน</th>
                    <th class="text-center">ที่ตั้ง</th>
                    <th class="text-center">ชื่อเครื่อง</th>
                    <th class="text-center">ระบบปฏิบัติการ</th>
                    <th class="text-center">ไอพีเครื่อง</th>
                    <th class="text-center" width="10%">เวลา</th>
                    <th class="text-center" width="15%">#</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query_get_com = $computer->getDataAll();
                $get_com = $conn_main->query($query_get_com);
                $no = 1;
                while ($rs_com = $get_com->fetch_assoc()) {
                    $com_number = $rs_com["Com_number"];
                    $com_name = $rs_com["Com_name"];
                    $com_equip = $rs_com["Com_Equip"];
                    $com_osversion = $rs_com["Com_OS_Version"];
                    $com_detail = $rs_com["Com_Detail"];
                    $com_ipaddress = $rs_com["Com_IP_Address"];
                    $com_created_at = $rs_com["Com_Date"];
                    $dept_id = $rs_com["Dep_ID"];
                    $sql_get_dep = $dept->getDepartmentByID($dept_id);
                    $query_get_dep = $conn_backoffice->query($sql_get_dep);
                    $data_dept = $query_get_dep->fetch_assoc();
                    $dept_name = $data_dept["dept_name"];
                ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td>
                        <td class="text-center"><?= $com_number ?></td>
                        <td class="text-center"><?= $com_equip ?></td>
                        <td class="text-center"><?= $dept_name ?></td>
                        <td class="text-center"><?= $com_detail ?></td>
                        <td class="text-center"><?= $com_name ?></td>
                        <td class="text-center"><?= $com_osversion ?></td>
                        <td class="text-center"><?= $com_ipaddress ?></td>
                        <td class="text-center"><?= DateTimeThai($com_created_at) ?></td>
                        <td class="text-center">
                            <a href="?page=main-create&id=<?= $com_number ?>" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm delete-computer" data-comid="<?= $com_number ?>">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>