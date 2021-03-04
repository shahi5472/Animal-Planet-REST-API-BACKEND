<?php

include '../auth/Session.php';

Session::init();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>All Questions | Animal Planet</title>
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

    <script src="./resources/vendor/jquery/jquery.min.js"></script>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
        <h2>Find the relevant question here</h2>
    </div>
</div>

<div class="all-questions">
    <div class="container">
        <div class="question-query">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                    <div class="ask-question">
                        <?php
                        if (Session::get('name')) {
                            ?>
                            <a href="ask-question.php"
                               class="btn btn-default my-2 my-sm-0 px-5 py-2 mb-4 mt-4 primary-button">Ask a question
                            </a>
                            <?php
                        } else { ?>
                            <a href="login.php" class="btn btn-default my-2 my-sm-0 px-5 py-2 primary-button">Login</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <div class="find-question">
                        <div class="input-group">
                            <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Recipient's username"
                                    aria-label="Recipient's username"
                                    aria-describedby="basic-addon2"
                            />
                            <div class="input-group-append">
                                <button class="btn primary-button" type="button">
                                    Search the question
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="question-list showList">

        </div>
    </div>
</div>


<script>

    $(document).ready(function () {
        $.ajax({
            url: '../post/index.php',
            method: 'get',
            success: function (response) {
                var json = JSON.parse(response);
                $.each(json, function (key, value) {
                    console.log(value)
                    $('.showList').append('<div class="single-question"><a href="single-question.php?id=' + value.id + '"><div class="single-question-title"><h4>' + value.title + '?</h4></div><div class="single-question-body"><p>' + value.description + '</p></div><div class="single-question-tags"><p class="single-tag">' + value.animal_type + '</p></div></a></div>');
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
