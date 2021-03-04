<?php

include '../auth/Session.php';

Session::init();

if (Session::get("id") == false) {
    header("Location:login.php");
    exit();
}

if (Session::get("user_type") != 'admin') {
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

    <title>Woofs&Paws - Dashboard</title>

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

    <link href="./resource/css/cal.css" rel="stylesheet"/>

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

    <!-- MDB core JavaScript -->
    <script
            type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/js/mdb.min.js"
    ></script>

    <!-- Demo scripts for this page-->
    <script src="./resource/js/demo/datatables-demo.js"></script>
    <script src="./resource/js/demo/chart-area-demo.js"></script>
    <script src="./resource/js/demo/chart-bar-new.js"></script>
    <script src="./resource/js/demo/cal.js"></script>
</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="index.php">Woofs&Paws</a>

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
            <a
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

<!-- Logout Modal-->
<div
        class="modal fade"
        id="logoutModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button
                        class="close"
                        type="button"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Select "Logout" below if you are ready to end your current session.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary"
                        type="button"
                        data-dismiss="modal">Cancel
                </button>
                <a id="logoutBtn" class="btn btn-primary" href="#">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(targetObj, View_area) {
        var preview = document.getElementById(View_area); //div id
        var ua = window.navigator.userAgent;

        if (ua.indexOf("MSIE") > -1) {
            targetObj.select();
            try {
                var src = document.selection.createRange().text;
            /
                var ie_preview_error = document.getElementById("ie_preview_error_" + View_area);


                if (ie_preview_error) {
                    preview.removeChild(ie_preview_error);
                }

                var img = document.getElementById(View_area);

                img.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "', sizingMethod='scale')";
            } catch (e) {
                if (!document.getElementById("ie_preview_error_" + View_area)) {
                    var info = document.createElement("<p>");
                    info.id = "ie_preview_error_" + View_area;
                    info.innerHTML = e.name;
                    preview.insertBefore(info, null);
                }
            }

        } else {
            var files = targetObj.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var imageType = /image.*/;
                if (!file.type.match(imageType))
                    continue;
                var prevImg = document.getElementById("prev_" + View_area);
                if (prevImg) {
                    preview.removeChild(prevImg);
                }
                var img = document.createElement("img");
                img.id = "prev_" + View_area;
                img.classList.add("obj");
                img.file = file;
                img.style.width = '100px';
                img.style.height = '100px';
                preview.appendChild(img);
                if (window.FileReader) {
                    var reader = new FileReader();
                    reader.onloadend = (function (aImg) {
                        return function (e) {
                            aImg.src = e.target.result;
                        };
                    })(img);
                    reader.readAsDataURL(file);
                } else {

                    if (!document.getElementById("sfr_preview_error_"
                        + View_area)) {
                        var info = document.createElement("p");
                        info.id = "sfr_preview_error_" + View_area;
                        info.innerHTML = "not supported FileReader";
                        preview.insertBefore(info, null);
                    }
                }
            }
        }
    }

    $(document).ready(function () {
        $(document).on('click', '#logoutBtn', function () {
            $.ajax({
                url: '../auth/logout.php',
                method: 'post',
                success: function (response) {
                    console.log(response);
                    if (!response.error) {
                        window.location = 'index.php';
                    }
                }
            });
        });
    });

</script>

</body>
</html>

