<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="views/assets/css/bootstrap5.2.min.css">

    <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">

    <link rel="stylesheet" href="views/bower_components/bootstrap-daterangepicker/daterangepicker.css">

    <!--  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css"> -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <!--   <link rel="stylesheet" href="assets/css/simple-datatables@7.1.2.min.css"> -->

    <link rel="stylesheet" href="views/assets/css/custom.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/skins/all.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/icheck.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.63/inputmask/jquery.inputmask.date.extensions.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.63/inputmask/jquery.inputmask.extensions.js"></script>

    <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>

    <script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>

    <script src="views/plugins/chartjs/chart.min.js"></script>



    <title>POS SYSTEM</title>

</head>

<body class="sb-nav-fixed ">

    <?php

    if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == "ok") {

        include 'modules/header.php';

        if (isset($_GET["route"])) {

            if (
                $_GET["route"] == 'login' ||
                $_GET["route"] == 'home' ||
                $_GET["route"] == 'logout' ||
                $_GET["route"] == 'users' ||
                $_GET["route"] == 'categories' ||
                $_GET["route"] == 'suppliers' ||
                $_GET["route"] == 'products' ||
                $_GET["route"] == 'customers' ||
                $_GET["route"] == 'create-sale' ||
                $_GET["route"] == 'sales' ||
                $_GET["route"] == 'edit-sale' ||
                $_GET["route"] == 'reports' ||
                $_GET["route"] == 'transaction' ||
                $_GET["route"] == 'profile'
            ) {

                include "modules/" . $_GET['route'] . ".php";
            } else {

                include "modules/404.php";
            }
        } else {

            include "modules/home.php";
        }

        include "modules/footer.php";
    } else {

        if (isset($_GET["route"]) && $_GET['route'] != 'login') {

            include "modules/404.php";
        }

        include "modules/login.php";
    }

    include 'modules/scripts.php';

    ?>
    <script src="views/js/products.js"></script>
    <script src="views/js/sales.js"></script>
    <script src="views/js/users.js"></script>
    <script src="views/js/categories.js"></script>
    <script src="views/js/suppliers.js"></script>
    <script src="views/js/customers.js"></script>
    <script src="views/js/reports.js"></script>

    <script>
        $('.tables').DataTable({

            "autoWidth": false,

        });

        $('.tables').on('column-sizing.dt', function(e, settings) {
            console.log('Column width recalculated in table');
        });
    </script>


</body>

</html>