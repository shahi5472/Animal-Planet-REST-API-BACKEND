<?php
include '../auth/Session.php';
Session::init();

if (Session::get("id") != false) {
    header("Location:index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Login || Animal Planet</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./resource/css/login.css"/>
</head>


<body>

<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
            <form id="form-data" enctype="multipart/form-data" method="post">
                <h2 class="title">Sign in</h2>

                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input id="email" type="email"
                           class="form-control" name="email"
                           required autocomplete="email" autofocus placeholder="E-mail">
                </div>

                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password"
                           class="form-control" name="password"
                           required autocomplete="current-password" placeholder="Password">
                </div>
                <button id="loginBtn" type="submit" class="btn btn-primary btn solid">
                    Login
                </button>
            </form>

        </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <div hidden class="content">
                <h3>New here ?</h3>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
                    ex ratione. Aliquid!
                </p>
                <button class="btn transparent" id="sign-up-btn">
                    Sign up
                </button>
            </div>
            <img src="./resource/img/log.svg" class="image" alt=""/>
        </div>
        <div class="panel right-panel">
            <div class="content">
                <h3>One of us ?</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
                    laboriosam ad deleniti.
                </p>
                <button class="btn transparent" id="sign-in-btn">
                    Sign in
                </button>
            </div>
            <img src="./resource/img/register.svg" class="image" alt=""/>
        </div>
    </div>
</div>

<script src="./resource/vendor/jquery/jquery.min.js"></script>

<!-- for login js file -->
<script src="./resource/js/login.js"></script>

<script>

    $(document).ready(function () {
        $(document).on('click', '#loginBtn', function () {
            $.ajax({
                url: '../auth/login.php',
                method: 'post',
                data: $("#form-data").serialize(),
                success: function (response) {
                    console.log(response);
                    if (!response.error) {
                        $("#form-data")[0].reset();
                        window.location = 'index.php';
                    }
                }
            });
        });
    });

</script>

</body>

</html>
