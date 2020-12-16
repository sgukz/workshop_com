<?php
$printer_id = isset($_GET["printer_id"]) ? $_GET["printer_id"] : "";
$sql_get_printer = $printer->getCheckPrinterById($printer_id);
$query_get_printer = $conn_main->query($sql_get_printer);
$data_printer = $query_get_printer->fetch_assoc();
$p_equip = $data_printer["printer_equip"];
if ($data_printer["printer_model"] !== null) {
    $subStrModel = explode(" ", $data_printer["printer_model"]);
    $p_brand = trim($subStrModel[0]);
    $p_model = trim($subStrModel[1]);
} else {
    $p_brand = "";
    $p_model = "";
}
$p_type = $data_printer["printer_type"];
$printer_dep_id = $data_printer["printer_dep_id"];
$p_detail = $data_printer["printer_detail"];
?>

<div class="card bg-light">
    <div class="card-header">
        <h3 class="text-warning font-weight-bold">ข้อมูลปริ้นเตอร์</h3>
    </div>
    <div class="card-body">
        <a href="?page=showdata-printer" class="btn btn-outline-success">รายการปริ้นเตอร์ทั้งหมด</a> <br><br>
        <form id="form-printer">
            <div class="form-group col-4">
                <label for="pnum" class="text-primary font-weight-bold">เลขทะเบียนปริ้นเตอร์ ตัวอย่าง P63120001</label>
                <input type="text" class="form-control " id="pnum" name="pnum" placeholder="เลขทะเบียนปริ้นเตอร์" value="<?= $printer_id ?>" <?= ($printer_id !== "") ? "readonly" : "" ?>>
                <button type="button" class="btn btn-info btn-xl mt-2" id="check_printer">ตรวจสอบ</button>
            </div>
            <div class="form-group col-4">
                <label for="p_equip" class="text-primary font-weight-bold">เลขครุภัณฑ์ ปริ้นเตอร์</label>
                <input type="text" class="form-control " id="p_equip" name="p_equip" placeholder="เลขครุภัณฑ์ ปริ้นเตอร์" value="<?= $p_equip ?>">
            </div>
            <div class="form-group col-2">

                <label for="p_brand" class="text-primary font-weight-bold"><span>ยี่ห้อ (Brand) <strong class="text-danger">*</strong></span> </label>
                <select name="p_brand" id="p_brand" class="form-control select2">
                    <option value="0" selected disabled>เลือกยี่ห้อปริ้นเตอร์</option>
                    <?php
                    $data_brand = DataBrand();
                    foreach ($data_brand as $index => $value) {
                    ?>
                        <option value="<?= $value ?>" <?= ($p_brand === $value) ? "selected" : "" ?>><?= $value ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-4">
                <label for="pmodel" class="text-primary font-weight-bold">
                    <span>รุ่น (Model) <strong class="text-danger">*</strong></span>
                </label>
                <input type="text" class="form-control " id="pmodel" name="pmodel" placeholder="รุ่น (Model)" value="<?= $p_model ?>" required>
            </div>
            <div class="form-group col-2">
                <label for="Printer_type" class="text-primary font-weight-bold">
                    <span>ประเภทปริ้นเตอร์ <strong class="text-danger">*</strong></span>
                </label>
                <select name="p_type" id="p_type" class="form-control">
                    <option value="Standard" <?= $p_type === "Standard" ? "selected" : "" ?>>Standard</option>
                    <option value="All in One" <?= $p_type === "All in One" ? "selected" : "" ?>>All in One</option>
                </select>
            </div>
            <div class="form-group col-4">
                <label for="" class="text-primary font-weight-bold">
                    <span>หน่วยงาน <strong class="text-danger">*</strong></span>
                </label>
                <select name="p_dept" id="p_dept" class="form-control select2" required>
                    <option value="0" disabled selected>เลือกหน่วยงาน</option>
                    <?php
                    $get_dep = $dept->getDepartment();
                    $query_dep = $conn_backoffice->query($get_dep);
                    while ($rows = $query_dep->fetch_assoc()) {
                        $dep_id = $rows["dept_id"];
                        $dep_name = $rows["dept_name"];
                    ?>
                        <option value="<?= $dep_id ?>" <?= ($printer_dep_id === $dep_id) ? "selected" : "" ?>>
                            <?= $dep_name ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="detail" class="text-primary font-weight-bold">ตำแหน่งที่ตั้ง</label>
                <textarea class="form-control" id="p_detail" name="p_detail" cols="15" rows="5"><?= $p_detail ?></textarea>
            </div>
            <div class="form-group col-6">
                <input type="hidden" name="is_add_new" value="<?= ($printer_id === "") ? "add" : "update" ?>">
                <button type="submit" class="btn <?= $printer_id !== "" ? "btn-warning" : "btn-success" ?>">
                    <?= $printer_id !== "" ? "Save change" : "Save add" ?>
                </button>
            </div>
        </form>

    </div>
</div>