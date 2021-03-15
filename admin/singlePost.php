<?php
if (isset($_GET['id'])) {
    $pageId = $_GET['id'];
    include "../post/PostController.php";
    $response = PostController::getSinglePostById($pageId);
}
?>

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Admin</li>
    </ol>

    <div class="question-post">
        <div class="container">
            <h2 class="question-title"><?php echo $response['post']['title']; ?></h2>
            <div class="question-posted">
                <p class="question-posted-time">
                    <?php echo date_format(date_create($response['post']['created_at']), "h:m:s a"); ?>
                </p>
                <p class="question-posted-date">
                    <?php echo date_format(date_create($response['post']['created_at']), "d-M-Y"); ?>
                </p>
                <p class="font-weight-bold">Posted by -
                    <b><?php echo ucwords($response['post']['user']['name']); ?></b>
                </p>
            </div>
            <p class="question-description"><?php echo $response['post']['description']; ?></p>
            <div class="question-images">
                <?php
                $result = $response['post']['images'];
                for ($x = 0; $x < count($result); $x++) {
                    ?>
                    <div id="showImageBtn" data-id="<?php echo $x; ?>" type="button" data-toggle="modal"
                         data-target="#exampleModal">
                        <img src="../userview/uploads/<?php echo $result[$x]['url']; ?>" alt="<?php echo $result[$x]['url']; ?>"
                             id="getImageUrl<?php echo $x; ?>"
                        />
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
            if (!$response['post']['comments']) {
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
                                            <?php
                                            if (PostController::getPostImage($result[$x]['user']['id'], $result[$x]['user']['user_type']) == null) {
                                                ?>
                                                src="./resource/img/doc-1.png"
                                                <?php
                                            } else {
                                                ?>
                                                src="../userview/uploads/<?php echo PostController::getPostImage($result[$x]['user']['id'], $result[$x]['user']['user_type']); ?>"
                                                <?php
                                            }
                                            ?>

                                                alt=""/>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="comment-posted">
                                            <p class="comment-posted-time">
                                                <?php echo date_format(date_create($result[$x]['created_at']), "h:m:s a"); ?>
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
                                        if (Session::get('id')) {
                                            ?>
                                            <div class="new-reply">
                                                <form id="form-data" enctype="multipart/form-data" method="post">
                                                    <div class="form-group">
                                                        <input id="commentId" hidden name="commentId"
                                                               value="<?php echo $result[$x]['id']; ?>">

                                                        <input id="userId" hidden
                                                               name="userId"
                                                               value="<?php echo Session::get('id'); ?>">

                                                        <textarea
                                                                class="form-control"
                                                                id="message"
                                                                rows="1"
                                                                placeholder="reply here"
                                                                name="message"></textarea>
                                                        <br>
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
                                                        <?php
                                                        if (PostController::getPostImage($replyResult[$y]['user']['id'], $replyResult[$y]['user']['user_type']) == null) {
                                                            ?>
                                                            src="./resource/img/doc-1.png"
                                                            <?php
                                                        } else {
                                                            ?>
                                                            src="../userview/uploads/<?php echo PostController::getPostImage($replyResult[$y]['user']['id'], $replyResult[$y]['user']['user_type']); ?>"
                                                            <?php
                                                        }
                                                        ?>
                                                            alt=""
                                                    />
                                                </div>
                                                <div class="col-md-11">
                                                    <div class="comment-posted">
                                                        <p class="comment-posted-time">
                                                            <?php echo date_format(date_create($replyResult[$y]['created_at']), "h:m:s a"); ?>
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
    if (Session::get('id') != false) {
        ?>
        <div class="post-comment">
            <div class="container">
                <h2>Post a comment</h2>
                <form id="comment-data" enctype="multipart/form-data" method="post">
                    <input id="postId" hidden name="postId"
                           value="<?php echo $pageId; ?>">

                    <input id="userId" hidden
                           name="userId"
                           value="<?php echo Session::get('id'); ?>">

                    <div class="form-group">
                  <textarea
                          class="form-control"
                          id="exampleFormControlTextarea1"
                          rows="3"
                          name="message"
                          placeholder="reply here"
                  ></textarea>
                        <br>
                        <button id="postComment" type="submit" class="btn btn-success">Comment</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="footer">
                <p>&copy; <a href="#">Animal Planet </a> | 2021</p>
                <p>
                    Contact information:
                    <a href="mailto:someone@example.com">someone@example.com</a>.
                </p>
            </div>
        </div>
    </div>
</div>


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



