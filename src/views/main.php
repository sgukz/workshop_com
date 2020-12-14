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
                    if ($_GET["page"] === "main-create") {
                        include '../components/form-computer.php';
                    } else if ($_GET["page"] === "main-showdata") {
                        include '../components/showdata-computer.php';
                    } else if ($_GET["page"] === "main-printer") {
                        include '../components/form-printer.php';
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

<script>
    $(document).ready(() => {
        $(".select-depart").select2();
        $("#show-data-com").DataTable();
    });
</script>

</html>`