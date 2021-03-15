<?php

include '../auth/Session.php';

Session::init();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>All Hospitals | Animal Planet</title>

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

    <!-- Bootstrap core JavaScript-->
    <script src="./resources/vendor/jquery/jquery.min.js"></script>

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
                        <a class="nav-link" href="all-hospitals.php">All Hospitals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all-pharmacy.php">All Pharmacy</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <?php
                    if (Session::get('name')) {
                        ?>
                        <a href="profile.php"
                           class="btn btn-default my-2 my-sm-0 px-5 py-2 primary-button"><?php echo Session::get('name'); ?>
                        </a>
                        <?php
                    } else { ?>
                        <a href="login.php" class="btn btn-default my-2 my-sm-0 px-5 py-2 primary-button">Login</a>
                    <?php } ?>
                </form>
            </div>
        </nav>
    </div>
    <div class="title-section">
        <h2>Find the best hospitals near you</h2>
    </div>
</div>


<div class="all-hospitals">
    <div class="container">
        <div class="row showList"></div>
    </div>
</div>


<script>

    $(document).ready(function () {
        $.ajax({
            url: '../hospital/index.php',
            method: 'get',
            success: function (response) {
                var json = JSON.parse(response);
                $.each(json.hospitals, function (key, value) {
                    $('.showList').append('<div class="col-md-4">' +
                        '<div class="hospital-card">' +
                        '<div class="hospital-img">' +
                        '<img height="200" width="200" src="../userview/uploads/' + value['URL'] + '" alt=""/></div>' +
                        '<h4 class="doc-name">' + value.name + '</h4>' +
                        '<p class="hospital-description">' +
                        '' + value.contact +
                        '<br>' + value.address + '</p>' +
                        '</div></div>');
                });
            }
        });
    });

</script>

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
</body>
</html>
