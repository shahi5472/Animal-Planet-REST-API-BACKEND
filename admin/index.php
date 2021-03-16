<?php

date_default_timezone_set("Asia/Dhaka");

include '../auth/Session.php';

Session::init();

if (Session::get("id") == false) {
    header("Location:login.php");
    exit();
}

if (Session::get("user_type") == 'user') {
    Session::destroy();
    header("Location:login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <title>Admin Dashboard || Animal Planet</title>

    <!-- Bootstrap core CSS-->
    <link
            href="./resource/vendor/bootstrap/css/bootstrap.min.css"
            rel="stylesheet"
    />

    <!-- Custom fonts for this template-->
    <link
            href="./resource/vendor/fontawesome-free/css/all.min.css"
            rel="stylesheet"
            type="text/css"
    />

    <!-- Page level plugin CSS-->
    <link
            href="./resource/vendor/datatables/dataTables.bootstrap4.css"
            rel="stylesheet"
    />

    <!-- Custom styles for this template-->
    <link href="./resource/css/main.css" rel="stylesheet"/>

    <link href="./resource/css/custom.css" rel="stylesheet"/>

    <!--Script -->
    <!-- Bootstrap core JavaScript-->
    <script src="./resource/vendor/jquery/jquery.min.js"></script>
    <script src="./resource/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./resource/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="./resource/vendor/chart.js/Chart.min.js"></script>
    <script src="./resource/vendor/datatables/jquery.dataTables.js"></script>
    <script src="./resource/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./resource/js/main.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="./resource/js/demo/datatables-demo.js"></script>
</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="index.php">Animal Planet</a>

    <button
            style="margin-left 5% !important "
            class="btn btn-link btn-sm text-white order-1 order-sm-0"
            id="sidebarToggle"
            href="#"
    >
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <div
            class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"
    ></div>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
            <a hidden
               class="nav-link dropdown-toggle"
               href="#"
               id="alertsDropdown"
               role="button"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false"
            >
                <span class="badge badge-danger">9+</span>
                <i class="fas fa-bell fa-fw"></i>
            </a>
            <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="alertsDropdown"
            >
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li>
        <li class="nav-item dropdown no-arrow">
            <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="userDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
            >
                <img
                        style="width: 30px; height: 30px"
                        src="resource/img/user3.png"
                        class="rounded-circle"
                        alt="Avatar"
                />
                <span><?php echo Session::get("name"); ?></span>
                <i class="icon-submenu lnr lnr-chevron-down"></i>
            </a>
            <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="userDropdown"
            >
                <div class="dropdown-divider"></div>
                <a
                        id="logoutBtn"
                        class="dropdown-item"
                        href="#"
                        data-toggle="modal"
                        data-target="#logoutModal"
                >Logout</a
                >
            </div>
        </li>
    </ul>
</nav>

<div id="wrapper">
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item dropdown active">
            <a
                    class="nav-link"
                    href="index.php"
                    id="pagesDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
            >
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=allDoctors">
                <i class="fas fa-fw fa-table"></i>
                <span>All Doctors</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=addDoctor">
                <i class="fas fa-fw fa-table"></i>
                <span>Add Doctor</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=allHospitals">
                <i class="fas fa-fw fa-table"></i>
                <span>All Hospital</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=addHospital">
                <i class="fas fa-fw fa-table"></i>
                <span>Add Hospital</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=allPharmacy">
                <i class="fas fa-fw fa-table"></i>
                <span>All Pharmacy</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=addPharmacy">
                <i class="fas fa-fw fa-table"></i>
                <span>Add Pharmacy</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=allPosts">
                <i class="fas fa-fw fa-table"></i>
                <span>All Post</span>
            </a>
        </li>

    </ul>

    <!-- /.content-wrapper -->

    <div id="content-wrapper">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'] . '.php';
        } else {
            $page = "dashboard.php";
        }
        if (file_exists($page)) {
            require_once $page;
        }
        ?>
    </div>

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script>
    $(document).ready(function () {
        $(document).on('click', '#logoutBtn', function () {
            $.ajax({
                url: '../auth/logout.php',
                method: 'post',
                success: function (response) {
                    console.log(response);
                    window.location = 'login.php';
                }
            });
        });
    });

</script>

</body>
</html>

