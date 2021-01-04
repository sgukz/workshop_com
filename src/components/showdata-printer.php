<div class="card bg-light">
    <div class="card-header">
        <h4 class="text-success font-weight-bold">รายการปริ้นเตอร์ทั้งหมด</h4>
    </div>
    <div class="card-body">
    <a href="?page=printer-create" class="btn btn-success btn-xl mb-3"><i class="fa fa-plus"></i> เพิ่มปริ้นเตอร์</a>
        <table class="table" id="show-data">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">เลขทะเบียนปริ้นเตอร์</th>
                    <th class="text-center">รุ่น</th>
                    <th class="text-center">เลขครุภัณฑ์</th>
                    <th class="text-center">หน่วยงาน</th>
                    <th class="text-center">ที่ตั้ง</th>
                    <th class="text-center" width="10%">เวลา</th>
                    <th class="text-center" width="15%">#</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_get_printer = $printer->getPrinterAll();
                $query_printer = $conn_main->query($sql_get_printer);
                $no = 1;
                while ($data_printer = $query_printer->fetch_assoc()) {
                    $printer_id = $data_printer["printer_id"];
                    $printer_model = $data_printer["printer_model"];
                    $printer_detail = $data_printer["printer_detail"];
                    $printer_equip = $data_printer["printer_equip"];
                    $printer_dep_id = $data_printer["printer_dep_id"];
                    $created_date = DateTimeThai($data_printer["created_date"]);
                    $sql_get_dep = $dept->getDepartmentByID($printer_dep_id);
                    $query_get_dep = $conn_backoffice->query($sql_get_dep);
                    $data_dept = $query_get_dep->fetch_assoc();
                    $dept_name = $data_dept["dept_name"];
                ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td>
                        <td class="text-center"><?= $printer_id ?></td>
                        <td class="text-center"><?= $printer_model ?></td>
                        <td class="text-center"><?= $printer_equip ?></td>
                        <td class="text-center"><?= $dept_name ?></td>
                        <td class="text-center"><?= $printer_detail ?></td>
                        <td class="text-center"><?= $created_date ?></td>
                        <td class="text-center">
                            <a href="?page=printer-create&printer_id=<?= $printer_id ?>" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm delete-printer" data-printid="<?= $printer_id ?>">
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