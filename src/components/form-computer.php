<?php
$com_number = "";
if (isset($_GET["cname"])) {
    $checkData = $computer->getComputerByName($_GET["cname"]);
    $query_data = $conn_main->query($checkData);
    $get_data = $query_data->fetch_assoc();
    $com_name = $get_data["Com_name"];
    $com_number = $get_data["Com_number"];
} else {
    $com_number = isset($_GET["id"]) ? $_GET["id"] : "";
}

$getComputerByID = $computer->getComputerByID($com_number);
$queryComputerByID = $conn_main->query($getComputerByID);
$data_com = $queryComputerByID->fetch_assoc();
$cnum = ($data_com["Com_number"] !== null) ? $data_com["Com_number"] : "";
$cname = ($data_com["Com_name"] !== null) ? $data_com["Com_name"] : (isset($_GET["cname"]) ? $_GET["cname"] : "");
$equip = ($data_com["Com_Equip"] !== null) ? $data_com["Com_Equip"] : "";
$model = ($data_com["Com_Brand"] !== null) ? $data_com["Com_Brand"] : (isset($_GET["model"]) ? $_GET["model"] : "");
$ram = ($data_com["Com_RAM"] !== null) ? $data_com["Com_RAM"] : (isset($_GET["ram"]) ? $_GET["ram"] : "");
$cpu = ($data_com["Com_CPU"] !== null) ? $data_com["Com_CPU"] : (isset($_GET["cpu"]) ? $_GET["cpu"] : "");
$osversion = ($data_com["Com_OS_Version"] !== null) ? $data_com["Com_OS_Version"] : (isset($_GET["osversion"]) ? $_GET["osversion"] : "");
$ipaddress = ($data_com["Com_IP_Address"] !== null) ? $data_com["Com_IP_Address"] : $_SERVER['REMOTE_ADDR'];
$department = ($data_com["Dep_ID"] !== null) ? $data_com["Dep_ID"] : "";
$detail = ($data_com["Com_Detail"] !== null) ? $data_com["Com_Detail"] : "";
$harddisk_model = ($data_com["harddisk_model"] !== null) ? $data_com["harddisk_model"] : (isset($_GET["model_disk"]) ? $_GET["model_disk"] : "");
$harddisk_serial = ($data_com["harddisk_serial"] !== null) ? $data_com["harddisk_serial"] : (isset($_GET["serail_disk"]) ? $_GET["serail_disk"] : "");
$harddisk_type = ($data_com["harddisk_type"] !== null) ? $data_com["harddisk_type"] : (isset($_GET["type_disk"]) ? $_GET["type_disk"] : "");
$harddisk_size = ($data_com["harddisk_size"] !== null) ? $data_com["harddisk_size"] : (isset($_GET["total_disk"]) ? $_GET["total_disk"] : "");

?>
<div class="card bg-light">
    <div class="card-header">
        <h3 class="text-warning font-weight-bold">ข้อมูลครุภัณฑ์คอมพิวเตอร์</h3>
    </div>
    <div class="card-body">
        <a href="?page=showdata-computer" class="btn btn-outline-success">รายการคอมพิวเตอร์ทั้งหมด</a> <br><br>
        <?php if (isset($com_name) && $com_name !== null) { ?>
            <div class="alert alert-dismissible alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4 class="alert-heading">แจ้งเตือนจากระบบ</h4>
                <p class="mb-0">ข้อมูลคอมพิวเตอร์เครื่องนี้มีในฐานข้อมูลแล้ว</p>
            </div>
        <?php } ?>
        <form id="form-client">
            <div class="form-group col-4">
                <label for="cnum" class="text-primary font-weight-bold">เลขทะเบียนคอมพิวเตอร์ ตัวอย่าง C63120001</label>
                <input type="text" class="form-control " id="cnum" name="cnum" placeholder="เลขทะเบียนคอมพิวเตอร์" value="<?= $cnum ?>" <?= $cnum !== "" ? "readonly" : "" ?>>
                <button type="button" class="btn btn-info btn-sm mt-2" id="check_barcode">ตรวจสอบ</button>
            </div>
            <div class="form-group col-4">
                <label for="equip" class="text-primary font-weight-bold">เลขครุภัณฑ์</label>
                <input type="text" class="form-control " id="equip" name="equip" placeholder="เลขครุภัณฑ์" value="<?= $equip ?>">
            </div>
            <div class="form-group col-4">
                <label for="cname" class="text-primary font-weight-bold"><span>ชื่อเครื่องคอมพิวเตอร์ <strong class="text-danger">*</strong></span> </label>
                <input type="text" class="form-control " id="cname" name="cname" placeholder="ชื่อเครื่องคอมพิวเตอร์" value="<?= $cname ?>" required>
            </div>
            <div class="form-group col-12">
                <label for="model" class="text-primary font-weight-bold">
                    <span>รุ่น/ยี่ห่อ <strong class="text-danger">*</strong></span>
                </label>
                <input type="text" class="form-control " id="model" name="model" placeholder="รุ่น/ยี่ห่อ" value="<?= $model ?>" required>
            </div>
            <div class="form-group col-12">
                <label for="ram" class="text-primary font-weight-bold">
                    <span>หน่วยความจำ (RAM) <strong class="text-danger">*</strong></span>
                </label>
                <input type="text" class="form-control " id="ram" name="ram" placeholder="RAM" value="<?= $ram ?>" required>
            </div>
            <div class="form-group col-12">
                <label for="cpu" class="text-primary font-weight-bold">
                    <span>หน่วยประมวลผล (CPU) <strong class="text-danger">*</strong></span>
                </label>
                <input type="text" class="form-control " id="cpu" name="cpu" placeholder="CPU" value="<?= $cpu ?>" required>
            </div>
            <div class="form-group col-12">
                <label for="osversion" class="text-primary font-weight-bold">
                    <span>ระบบปฏิบัติการ <strong class="text-danger">*</strong></span>
                </label>
                <input type="text" class="form-control " id="osversion" name="osversion" placeholder="ระบบปฏิบัติการ" value="<?= $osversion ?>" required>
            </div>
            <div class="form-group col-6">
                <label for="ipaddress" class="text-primary font-weight-bold">
                    <span>ไอพีเครื่อง <strong class="text-danger">*</strong></span>
                </label>
                <input type="text" class="form-control " id="ipaddress" name="ipaddress" placeholder="ไอพีเครื่อง" value="<?= $ipaddress ?>" required>
            </div>
            <div class="form-group col-6">
                <label for="harddisk_model" class="text-primary font-weight-bold">
                    <span>รุ่นฮาร์ดดิส <strong class="text-danger">*</strong></span>
                </label>
                <input type="text" class="form-control " id="harddisk_model" name="harddisk_model" placeholder="รุ่นฮาร์ดดิส" value="<?= $harddisk_model ?>" required>
            </div>
            <div class="form-group col-6">
                <label for="harddisk_serial" class="text-primary font-weight-bold">
                    <span>ฮาร์ดดิส Serial Number <strong class="text-danger">*</strong></span>
                </label>
                <input type="text" class="form-control " id="harddisk_serial" name="harddisk_serial" placeholder="Serial Number" value="<?= $harddisk_serial ?>" required>
            </div>
            <div class="form-group col-6">
                <label for="harddisk_type" class="text-primary font-weight-bold">
                    <span>ประเภทฮาร์ดดิส <strong class="text-danger">*</strong></span>
                </label>
                <input type="text" class="form-control " id="harddisk_type" name="harddisk_type" placeholder="ประเภทฮาร์ดดิส" value="<?= $harddisk_type ?>" required>
            </div>
            <div class="form-group col-6">
                <label for="harddisk_size" class="text-primary font-weight-bold">
                    <span>ขนาดฮาร์ดดิส <strong class="text-danger">*</strong></span>
                </label>
                <input type="text" class="form-control " id="harddisk_size" name="harddisk_size" placeholder="ขนาดฮาร์ดดิส" value="<?= $harddisk_size ?>" required>
            </div>
            <div class="form-group col-6">
                <label for="department" class="text-primary font-weight-bold">
                    <span>หน่วยงาน <strong class="text-danger">*</strong></span>
                </label>
                <select name="department" id="department" class="form-control select2" required>
                    <option value="" disabled selected>เลือกหน่วยงาน</option>
                    <?php
                    $get_dep = $dept->getDepartment();
                    $query_dep = $conn_backoffice->query($get_dep);
                    while ($rows = $query_dep->fetch_assoc()) {
                        $dep_id = $rows["dept_id"];
                        $dep_name = $rows["dept_name"];
                    ?>
                        <option value="<?= $dep_id ?>" <?= ($dep_id === $department) ? "selected" : "" ?>>
                            <?= $dep_name ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-6">
                <label for="detail" class="text-primary font-weight-bold">ตำแหน่งที่ตั้ง</label>
                <textarea class="form-control" id="detail" name="detail" cols="15" rows="5"><?= $detail ?></textarea>
            </div>
            <div class="form-group col-6">
                <input type="hidden" name="is_submit" value="<?= $cnum ?>">
                <button type="submit" class="btn <?= $cnum !== "" ? "btn-warning" : "btn-success" ?>">
                    <?= $cnum !== "" ? "Save change" : "Save add" ?>
                </button>
            </div>
        </form>
    </div>
</div>