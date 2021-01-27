<div class="card bg-light">
    <div class="card-header">
        <h4 class="text-primary font-weight-bold">รายการครุภัณฑ์คอมพิวเตอร์และปริ้นเตอร์</h4>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-12">
                <form class="form-inline" id="search-report" method="post">
                    <div class="form-group col-4">
                        <label for="email">หน่วยงาน </label>
                        <select name="department" id="department" class="form-control select2" required>
                            <option value="all" selected>ทั้งหมด</option>
                            <?php
                            $get_dep = $dept->getDepartment();
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
                    <div class="form-group col-8">
                        <div class="form-check mt-3">
                            <label class="form-check-label">
                                <input class="form-check-input"  id="is_equip" type="checkbox" value="true"> <label for="is_equip">มีเลขครุภัณฑ์</label>
                                <input class="form-check-input ml-3" id="not_equip" type="checkbox" value="true"> <label for="not_equip">ไม่มีเลขครุภัณฑ์</label>
                            </label>
                            <button type="submit" class="btn btn-primary ml-2" id="check-search-report">
                               <i class="fa fa-search"></i> ค้นหา
                            </button>
                        </div>
                        <div id="export_report">    
                        </div>
                        <input type="hidden" name="page" value="show-report">
                    </div>
                    <div class="form-group col-3">
                    </div>
                </form>
            </div>
        </div>
        <table class="table" id="show-data-report">
            <thead>
                <tr>
                    <th class="text-center">ลำดับ</th>
                    <th class="text-center">หน่วยงาน</th>
                    <th class="text-center">จำนวนคอมพิวเตอร์</th>
                    <th class="text-center">จำนวนปริ้นเตอร์</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="text-center">ลำดับ</th>
                    <th class="text-center">หน่วยงาน</th>
                    <th class="text-center">จำนวนคอมพิวเตอร์</th>
                    <th class="text-center">จำนวนปริ้นเตอร์</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>