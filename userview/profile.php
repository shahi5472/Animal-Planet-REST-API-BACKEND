<?php

include '../auth/Session.php';

Session::init();

if (Session::get("id") == false) {
    header("Location:login.php");
    exit();
}
if (Session::get("user_type") == 'admin') {
    Session::destroy();
    header("Location:index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo Session::get('name') == null ? '' : Session::get('name') ?> | Animal Planet</title>
    <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous"
    />
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
            integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
            crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./resources/css/style.css"/>
    <link rel="stylesheet" href="./resources/css/responsive.css"/>
</head>
<body>
<div class="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.php">Animal Planet</a>
            <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarTogglerDemo02"
                    aria-controls="navbarTogglerDemo02"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="all-questions.php">All Questions </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all-doctors.php">All Doctors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all-hospitals.php">Hospitals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all-pharmacy.php">All Pharmacy</a>
                    </li>
                </ul>
                <!--                //Notification-->
                <ul class="notifications">
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a
                                class="nav-link "
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
                        <div class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="alertsDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="title-section">
        <h2>Edit your profile</h2>
    </div>
</div>

<!-- user profile -->

<div class="section profile-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-img">
                    <img src="uploads/<?php echo Session::get('image'); ?>" alt=""/>
                </div>
                <form id="form-data" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" hidden value="<?php echo Session::get('id') ?>">
                        <label for="exampleInputName">User Name</label>
                        <input type="name"
                               class="form-control"
                               name="name"
                               placeholder="User name"
                               value="<?php echo Session::get('name') == null ? '' : Session::get('name') ?>"
                        />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="email"
                               class="form-control"
                               name="email"
                               disabled
                               value="<?php echo Session::get('email') == null ? '' : Session::get('email') ?>"
                        />
                        <small id="emailHelp" class="form-text text-muted"
                        >We'll never share your email with anyone else.</small
                        >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputContact">Contact</label>
                        <input name="phone"
                               type="text"
                               class="form-control"
                               value="<?php echo Session::get('phone') == null ? '' : Session::get('phone') ?>"
                        />
                    </div>
                    <?php
                    $value = Session::get('specialists');
                    if (Session::get('user_type') == 'doctor') {
                        ?>
                        <div class="form-group">
                            <label for="specialists">Specialists</label>
                            <input type="specialists"
                                   class="form-control"
                                   name="specialists"
                                   placeholder="Specialists"
                                   value="<?php echo $value == null ? '' : $value; ?>"
                            />
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <label for="exampleInputName">Address</label>
                        <input type="address"
                               class="form-control"
                               name="address"
                               placeholder="Address"
                               value="<?php echo Session::get('address') == null ? '' : Session::get('address') ?>"
                        />
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Change picture</label>
                        <input
                                type="file" id="file" name="file"
                                class="form-control-file"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <br>
                </form>
                <br>
                <a id="logoutBtn" class="btn btn-primary" href="#">Logout</a>
                <br>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="section footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <p>logo</p>
                </div>
                <div class="col-md-3">
                    <ul>
                        <li>Home</li>
                        <li>All Question</li>
                        <li>All Doctors</li>
                        <li>Hospitals</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul>
                        <li>FAQ</li>
                        <li>FAQ</li>
                        <li>FAQ</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul>
                        <li>FAQ</li>
                        <li>FAQ</li>
                        <li>FAQ</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<script
        src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"
></script>
<script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"
></script>
<script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"
></script>
<script src="./resources/vendor/jquery/jquery.min.js"></script>

<script>
    $("#myModal").on("shown.bs.modal", function () {
        $("#myInput").trigger("focus");
    });
</script>

<script>

    $(document).ready(function () {
        $("#form-data").on("submit", function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "../user/updateUser.php",
                type: "POST",
                cache: false,
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                }
            });
        });

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

