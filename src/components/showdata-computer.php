<div class="card bg-light">
    <div class="card-header">
        <h3 class="text-danger font-weight-bold">Data Informations</h3>
    </div>
    <div class="card-body">
        <table class="table" id="show-data-com">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Computer Number</th>
                    <th class="text-center">Computer Name</th>
                    <th class="text-center">OS Version</th>
                    <th class="text-center">RAM</th>
                    <th class="text-center">CPU</th>
                    <th class="text-center">IP Address</th>
                    <th class="text-center">Created at</th>
                    <th class="text-center" width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query_get_com = getDataAll();
                $get_com = $conn_main->query($query_get_com);
                $no = 1;
                while ($rs_com = $get_com->fetch_assoc()) {
                    $com_number = $rs_com["Com_number"];
                    $com_name = $rs_com["Com_name"];
                    $com_osversion = $rs_com["Com_OS_Version"];
                    $com_ram = $rs_com["Com_RAM"];
                    $com_cpu = $rs_com["Com_CPU"];
                    $com_ipaddress = $rs_com["Com_IP_Address"];
                    $com_created_at = $rs_com["Com_Date"];
                ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td>
                        <td class="text-center"><?= $com_number ?></td>
                        <td class="text-center"><?= $com_name ?></td>
                        <td class="text-center"><?= $com_osversion ?></td>
                        <td class="text-center"><?= $com_ram ?></td>
                        <td class="text-center"><?= $com_cpu ?></td>
                        <td class="text-center"><?= $com_ipaddress ?></td>
                        <td class="text-center"><?= $com_created_at ?></td>
                        <td class="text-center">
                            <a href="?page=main-create&id=<?= $com_number ?>" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm delete" data-comid="<?= $com_number ?>">
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