<?php
session_start();
// error_reporting(0);
include '../../config/config_db.php';
include '../models/DepartmentModel.php';
include '../models/ComputerModel.php';
include '../models/PrinterModel.php';
include '../models/ManageModel.php';
include '../functions/_function.php';
$computer = new Computer();
$printer = new Printer();
$dept = new Department();
$db = new DB();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการครุภัณฑ์คอมพิวเตอร์</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.lumen.css">
    <link rel="stylesheet" href="../../assets/css/select2.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/jquery.dataTables.min.css">
    <link rel="icon" href="../../assets/img/icon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
</head>

<body class="bg-dark">
    <?php
    include '../components/_navbar.php';
    ?>
    <!-- initial section form client information -->
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <?php
                if (isset($_GET["page"])) {
                    if ($_GET["page"] === "computer-create") {
                        include '../components/form-computer.php';
                    } else if ($_GET["page"] === "showdata-computer") {
                        include '../components/showdata-computer.php';
                    } else if ($_GET["page"] === "printer-create") {
                        include '../components/form-printer.php';
                    } else if ($_GET["page"] === "showdata-printer") {
                        include '../components/showdata-printer.php';
                    } else if ($_GET["page"] === "show-report") {
                        include '../components/report.php';
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
<script src="../functions/js/printer.js"></script>
<script src="../functions/js/computer.js"></script>
<script src="../functions/js/report.js"></script>

<script>
    $(document).ready(() => {
        $(".select2").select2();
        $("#show-data").DataTable({
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "ทั้งหมด"]
            ],
            "oLanguage": {
                "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
                "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                "sSearch": "ค้นหา :",
                "oPaginate": {
                    "sFirst": "หน้าแรก",
                    "sLast": "หน้าสุดท้าย",
                    "sNext": "ถัดไป",
                    "sPrevious": "ย้อนกลับ",
                }
            }
        });
    });
</script>

</html>