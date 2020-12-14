<?php
$pnum =  "";
?>

<div class="card bg-light">
    <div class="card-header">
        <h3 class="text-warning font-weight-bold">ข้อมูลปริ้นเตอร์</h3>
    </div>
    <div class="card-body">
        <a href="?page=main-showdata" class="btn btn-outline-success">รายการปริ้นเตอร์ทั้งหมด</a> <br><br>
        <!-- <div class="alert alert-dismissible alert-warning">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 class="alert-heading">แจ้งเตือนจากระบบ</h4>
            <p class="mb-0">ข้อมูลปริ้นเตอร์เครื่องนี้มีในฐานข้อมูลแล้ว</p>
        </div> -->
        <form id="form-printer">
            <div class="form-group col-4">
                <label for="cnum" class="text-primary font-weight-bold">เลขทะเบียนปริ้นเตอร์</label>
                <input type="text" class="form-control " id="pnum" name="pnum" placeholder="เลขทะเบียนปริ้นเตอร์" value="">
                <button type="button" class="btn btn-info btn-xl mt-2" id="check_printer">ตรวจสอบ</button>
            </div>
            <div class="form-group col-4">
                <label for="cnum" class="text-primary font-weight-bold">เลขครุภัณฑ์ ปริ้นเตอร์</label>
                <input type="text" class="form-control " id="p_equip" name="p_equip" placeholder="เลขครุภัณฑ์ ปริ้นเตอร์" value="">
            </div>
            <div class="form-group col-4">
                <label for="cname" class="text-primary font-weight-bold"><span>ยี่ห้อ (Brand) <strong class="text-danger">*</strong></span> </label>
                <select name="p_brand" id="p_brand" class="form-control">
                    <option value="0" selected disabled>เลือกยี่ห้อปริ้นเตอร์</option>
                    <option value="Canon">Canon</option>
                    <option value="HP">HP</option>
                    <option value="Epson">Epson</option>
                    <option value="Brother">Brother</option>
                    <option value="XEROX">XEROX</option>
                </select>
            </div>
            <div class="form-group col-4">
                <label for="model" class="text-primary font-weight-bold">
                    <span>รุ่น (Model) <strong class="text-danger">*</strong></span>
                </label>
                <input type="text" class="form-control " id="pmodel" name="pmodel" placeholder="รุ่น (Model)" value="" required>
            </div>
            <div class="form-group col-2">
                <label for="Printer_type" class="text-primary font-weight-bold">
                    <span>ประเภทปริ้นเตอร์ <strong class="text-danger">*</strong></span>
                </label>
                <select name="p_type" id="p_type" class="form-control">
                    <option value="Standard">Standard</option>
                    <option value="All in One">All in One</option>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="" class="text-primary font-weight-bold">
                    <span>หน่วยงาน <strong class="text-danger">*</strong></span>
                </label>
                <select name="department" id="department" class="form-control select-depart" required>
                    <option value="" disabled selected>เลือกหน่วยงาน</option>
                    <?php
                    $get_dep = getDep();
                    $query_dep = $conn_backoffice->query($get_dep);
                    while ($rows = $query_dep->fetch_assoc()) {
                        $dep_id = $rows["dept_id"];
                        $dep_name = $rows["dept_name"];
                    ?>
                        <option value="<?= $dep_id ?>">
                            <?= $dep_name ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="detail" class="text-primary font-weight-bold">ตำแหน่งที่ตั้ง</label>
                <textarea class="form-control" id="p_detail" name="p_detail" cols="15" rows="5"></textarea>
            </div>
            <div class="form-group col-6">
                <input type="hidden" name="is_add_new" value="1">
                <button type="submit" class="btn <?= $pnum !== "" ? "btn-warning" : "btn-success" ?>">
                    <?= $pnum !== "" ? "Save change" : "Save add" ?>
                </button>
            </div>
        </form>

    </div>
</div>