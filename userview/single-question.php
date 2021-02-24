<?php

include '../auth/Session.php';

Session::init();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Woofs&Paws</title>
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
                    <button class="btn btn-default my-2 my-sm-0 px-4 primary-button">
                        Login
                    </button>
                </form>
            </div>
        </nav>
    </div>
    <div class="title-section"></div>
</div>

<br>
<?php
if (isset($_GET['id'])) {
    $pageId = $_GET['id'];
    include "../post/PostController.php";
    $response = PostController::getSinglePostById($pageId);
}
?>


<div class="question-post">
    <div class="container">
        <h2 class="question-title"><?php echo $response['post']['title']; ?></h2>
        <div class="question-posted">
            <p class="question-posted-time">
                <?php echo date_format(date_create($response['post']['created_at']), "H-m-S a"); ?>
            </p>
            <p class="question-posted-date">
                <?php echo date_format(date_create($response['post']['created_at']), "d-M-Y"); ?>
            </p>
            <p>Posted by -
                <?php echo ucwords($response['post']['user']['name']); ?>
            </p>
        </div>
        <p class="question-description"><?php echo $response['post']['description']; ?></p>
        <div class="question-images">
            <?php
            $result = $response['post']['images'];
            for ($x = 0; $x < count($result); $x++) {
                ?>
                <div type="button" data-toggle="modal" data-target="#exampleModal">
                    <img src="<?php echo $result[$x]['url']; ?>" alt=""/>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<div class="section question-comments">
    <div class="container">
        <h2>Comments</h2>

        <?php
        if ($response['post']['comments'] == null) {
            ?>
            <br>
            <h1 style="color: red">No Comment Found</h1>
            <br>
            <?php
        } else {
            ?>
            <div class="all-comments">
                <?php
                $result = $response['post']['comments'];
                for ($x = 0; $x < count($result); $x++) {
                    ?>
                    <div class="single-comment">
                        <div class="comment">
                            <div class="row">
                                <div class="col-md-1">
                                    <img
                                            class="comment-pro-pic"
                                            src="./resources/images/doc-1.png"
                                            alt=""
                                    />
                                </div>
                                <div class="col-md-11">
                                    <div class="comment-posted">
                                        <p class="comment-posted-time">
                                            <?php echo date_format(date_create($result[$x]['created_at']), "H-m-s a"); ?>
                                        </p>
                                        <p class="comment-posted-date">
                                            <?php echo date_format(date_create($result[$x]['created_at']), "d-M-Y"); ?>
                                        </p>
                                        <p>Commented by - <?php echo $result[$x]['user']['name']; ?>
                                        </p>
                                    </div>
                                    <p class="comment-body">
                                        <?php echo $result[$x]['message']; ?>
                                    </p>
                                    <?php
                                    if (!Session::get('id')) {
                                        ?>
                                        <div class="new-reply">
                                            <form id="form-data" enctype="multipart/form-data" method="post">
                                                <div class="form-group">
                                                    <input id="commentId" hidden name="commentId"
                                                           value="<?php echo $result[$x]['id']; ?>">

                                                    <input id="userId" hidden
                                                           name="userId"
                                                           value="<?php echo Session::get('id') ?>"
                                                    >

                                                    <textarea
                                                            class="form-control"
                                                            id="message"
                                                            rows="1"
                                                            placeholder="reply here"
                                                            name="message"

                                                    ></textarea>
                                                    <button id="replyComment" type="submit" class="btn btn-success">
                                                        Reply
                                                    </button>

                                                </div>
                                            </form>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($result[$x]['replies'] != null) {
                            ?>
                            <div class="comment-reply">
                                <?php
                                $replyResult = $result[$x]['replies'];
                                for ($y = 0; $y < count($replyResult); $y++) {
                                    ?>
                                    <br>
                                    <div class="comment">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img
                                                        class="comment-pro-pic"
                                                        src="./resources/images/doc-1.png"
                                                        alt=""
                                                />
                                            </div>
                                            <div class="col-md-11">
                                                <div class="comment-posted">
                                                    <p class="comment-posted-time">
                                                        <?php echo date_format(date_create($replyResult[$y]['created_at']), "H-m-s a"); ?>
                                                    </p>
                                                    <p class="comment-posted-date">
                                                        <?php echo date_format(date_create($replyResult[$y]['created_at']), "d-M-Y"); ?>
                                                    </p>
                                                    <p>Commented by
                                                        - <?php echo $replyResult[$y]['user']['name']; ?></p>
                                                </div>
                                                <p class="comment-body">
                                                    <?php echo $replyResult[$y]['message']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<?php
if (!Session::get('id')) {
    ?>
    <div class="post-comment">
        <div class="container">
            <h2>Post a comment</h2>
            <form id="comment-data" enctype="multipart/form-data" method="post">
                <input id="postId" hidden name="postId"
                       value="<?php echo $pageId; ?>">

                <input id="userId" hidden
                       name="userId"
                       value="<?php echo Session::get('id') ?>"
                >

                <div class="form-group">
                  <textarea
                          class="form-control"
                          id="exampleFormControlTextarea1"
                          rows="3"
                          name="message"
                          placeholder="reply here"
                  ></textarea>
                    <button id="postComment" type="submit" class="btn btn-success">Comment</button>
                </div>
            </form>
        </div>
    </div>
    <?php
}
?>

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

<!-- Modal -->
<div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img style="width: 100%" src="./resources/images/pet1.jpg" alt=""/>
            </div>
            <div class="modal-footer">
                <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

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
<script>
    $("#myModal").on("shown.bs.modal", function () {
        $("#myInput").trigger("focus");
    });
</script>

<script>

    $(document).ready(function () {
        $(document).on('click', '#replyComment', function () {
            $.ajax({
                url: '../comments/createReplyComment.php',
                method: 'post',
                data: $("#form-data").serialize(),
                success: function (response) {
                    $("#form-data")[0].reset();
                    // alert(response);
                    console.log(response);
                    window.location = 'index.php?page=singlePost&id=<?php echo $pageId; ?>';
                }
            });
        });

        $(document).on('click', '#postComment', function () {
            $.ajax({
                url: '../comments/createComment.php',
                method: 'post',
                data: $("#comment-data").serialize(),
                success: function (response) {
                    $("#comment-data")[0].reset();
                    // alert(response);
                    console.log(response);
                    window.location = 'index.php?page=singlePost&id=<?php echo $pageId; ?>';
                }
            });
        });
    });

</script>

</body>
</html>
