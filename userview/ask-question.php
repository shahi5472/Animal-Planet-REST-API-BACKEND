<?php

include '../auth/Session.php';

require_once '../controller/db_functions.php';

require_once '../post/PostController.php';

$db = new DB_Functions();

Session::init();

if (Session::get("id") == false) {
    header("Location:login.php");
    exit();
}

if (isset($_POST['questionPostBtn'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $animalType = $_POST['animalType'];
    $userId = Session::get('id');
    $created_at = date("Y-m-d  h:i:s");
    $updated_at = date("Y-m-d  h:i:s");

    $result = $db->createPost($title, $description, $animalType, $userId, $created_at, $updated_at);

    $imageCount = count($_FILES['photo']['name']);

    if ($result) {
        $post_data = PostController::getSinglePostById($result);
        $postId = $post_data['post']['id'];
        $response = $post_data;

        for ($x = 0; $x < $imageCount; $x++) {
            $photo = explode(".", $_FILES['photo']['name'][$x]);
            $photo = end($photo);

            $photo_name = "IMG_" . rand(10000000000, 9999999999999) . "." . $photo;

            $db->imageInsert($photo_name, 'post', $postId, $created_at, $updated_at);

            move_uploaded_file($_FILES['photo']['tmp_name'][$x], 'uploads/' . $photo_name);
        }
        $response['error'] = FALSE;
        $response['message'] = 'Create post successful';

        header("Location:single-question.php?id=" . $postId);
    } else {
        $response['error'] = TRUE;
        $response['message'] = 'Internal server error';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Ask Question | Animal Planet</title>
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
        <h2>Ask your question here</h2>
    </div>
</div>

<div class="ask-question">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form id="form-data" enctype="multipart/form-data" method="post">
                    <br>
                    <div class="form-group">
                        <label for="questionTitle">Question Title</label>
                        <input
                                type="text"
                                name="title"
                                class="form-control"
                                placeholder="My cat is vomiting"/>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputState">Animal Type</label>
                            <select name="animalType" id="inputState" class="form-control">
                                <option selected disabled>Choose</option>
                                <option value="cat">Cat</option>
                                <option value="dog">Dog</option>
                                <option value="bird">Bird</option>
                                <option value="rabbit">Rabbit</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1"
                                  rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Example file input</label>
                        <input id="photo" type="file" name="photo[]" multiple class="form-control-file">
                    </div>
                    <br>
                    <button id="questionPostBtn" type="submit" name="questionPostBtn" class="btn btn-primary">Submit
                    </button>
                    <br>
                    <br>
                </form>
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

<!--<script>-->
<!---->
<!--    $(document).ready(function () {-->
<!--        $('#form-data').on('submit', function (e) {-->
<!--            e.preventDefault();-->
<!--            $.ajax({-->
<!--                url: '../post/create.php',-->
<!--                method: 'post',-->
<!--                data: $(this).serialize(),-->
<!--                success: function (response) {-->
<!--                    console.log(response);-->
<!--                    alert(response);-->
<!--                    // if (!response.error) {-->
<!--                    //     $("#form-data")[0].reset();-->
<!--                    //     window.location = 'index.php';-->
<!--                    // }-->
<!--                }-->
<!--            });-->
<!--        });-->
<!---->
<!--        // $(document).on('click', '#questionPostBtn', function () {-->
<!--        //     $.ajax({-->
<!--        //         url: '../post/create.php',-->
<!--        //         method: 'post',-->
<!--        //         mimeType: "multipart/form-data",-->
<!--        //         contentType: false,-->
<!--        //         cache: false,-->
<!--        //         processData: false,-->
<!--        //         data: $("#form-data").serialize(),-->
<!--        //         success: function (response) {-->
<!--        //             console.log(response);-->
<!--        //             // if (!response.error) {-->
<!--        //             //     $("#form-data")[0].reset();-->
<!--        //             //     window.location = 'index.php';-->
<!--        //             // }-->
<!--        //         }-->
<!--        //     });-->
<!--        // });-->
<!---->
<!--    });-->
<!---->
<!--</script>-->

</body>
</html>

