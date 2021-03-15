<?php

?>

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add Hospital</li>
    </ol>

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="addAdmitForm">
                <div class="addAdmitForm-header-One">
                    <h2>Add Hospital Form</h2>
                </div>
                <hr/>
                <form id="form-data" enctype="multipart/form-data" method="post">
                    <div class="doctorForm">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            id="name"
                                            name="name"
                                    />
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="contact">Contact</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            id="contact"
                                            name="contact"
                                    />
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            id="address"
                                            name="address"
                                    />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="email">Upload Hospital Photo </label>
                                    <input
                                            type="file" id="file" name="file"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div style="margin-left: 10px;"></div>
                        <button type="submit" class="btn btn-success btn-lg">
                            Create
                        </button>
                        <div style="margin-left: 20px;"></div>
                        <button id="clear_hospital"  type="button" class="btn btn-danger btn-lg">
                            Reset
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        $("#form-data").on("submit", function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "../hospital/create.php",
                type: "POST",
                cache: false,
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    $("#form-data")[0].reset();
                }
            });
        });
        // $(document).on('click', '#create_hospital', function () {
        //     $.ajax({
        //         url: '../hospital/create.php',
        //         method: 'post',
        //         data: $("#form-data").serialize(),
        //         success: function (response) {
        //             $("#form-data")[0].reset();
        //             // alert(response);
        //             console.log(response);
        //         }
        //     });
        // });

        $(document).on('click', '#clear_hospital', function () {
            $("#form-data")[0].reset();
        })
    });

</script>

