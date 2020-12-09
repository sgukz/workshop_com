<?php
session_start();
// error_reporting(0);
include '../../config/config_db.php';
include '../models/DepartmentModel.php';
include '../models/ComputerModel.php';
include '../functions/_function.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.lumen.css">
    <link rel="stylesheet" href="../../assets/css/select2.min.css">
    <link rel="stylesheet" href="../../assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>

<body class="bg-info">
    <!-- initial section form client information -->
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <?php
                if (isset($_GET["page"])) {
                    if ($_GET["page"] === "main-create") {
                        include '../components/form-computer.php';
                    } else if ($_GET["page"] === "main-showdata") {
                        include '../components/showdata-computer.php';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

<script src="../../assets/js/sweetalert2.js"></script>
<script src="../../assets/js/jquery-3.5.1.min.js"></script>
<script src="../../assets/js/select2.min.js"></script>
<script src="../../assets/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(() => {
        $(".select-depart").select2();
        $("#show-data-com").DataTable();

        $('.delete').click(function() {
            let base_url = "../controllers/computer/DeleteComputer.php";
            let data_comid = $(this).attr('data-comid');
            Swal.fire({
                title: "แจ้งเตือน",
                text: `คุณต้องการข้อมูล หมายเลขคอมพิวเตอร์ ${data_comid} ใช่หรือไม่?`,
                showCancelButton: true,
                confirmButtonText: `ใช่`,
                denyButtonText: `ไม่ใช่`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                            method: "GET",
                            url: base_url,
                            data: `id=${data_comid}`
                        })
                        .done((response) => {
                            let data = JSON.parse(response);
                            if (data.status_code === 200) {
                                Swal.fire({
                                    title: "แจ้งเตือน",
                                    text: data.text,
                                    icon: data.type
                                });
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            } else {
                                Swal.fire({
                                    title: "เกิดข้อผิดพลาด !!!",
                                    text: data.text,
                                    icon: data.type
                                });
                            }
                        })
                        .fail((error) => {
                            console.log(error);
                        })
                }
            })
        });

        $("#logout").click(() => {
            Swal.fire({
                title: 'คุณต้องการออกจากระบบใช่หรือไม่?',
                showCancelButton: true,
                confirmButtonText: `ใช่`,
                denyButtonText: `ไม่ใช่`,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "../controllers/logout.php";
                }
            })
        });

        $("#form-client").submit((event) => {
            let base_url = "../controllers/computer/ComputerController.php";
            $.ajax({
                    method: "POST",
                    url: base_url,
                    data: $("#form-client").serialize()
                })
                .done((response) => {
                    let data = JSON.parse(response);
                    if (data.status_code === 200) {
                        Swal.fire({
                            "title": "แจ้งเตือน",
                            "text": data.msg,
                            "icon": data.type
                        });
                        setTimeout(() => {
                            if (data.section === "add") {
                                window.location = "?page=main-create&id="+data.data;
                            } else if (data.section === "update") {
                                window.location.reload();
                            }
                        }, 2000);
                    } else {
                        Swal.fire({
                            "title": "แจ้งเตือน",
                            "text": data.text,
                            "icon": data.type
                        });
                    }
                })
                .fail((error) => {
                    console.log(JSON.parse(error));
                });
            event.preventDefault();
        });
    });
</script>

</html>`