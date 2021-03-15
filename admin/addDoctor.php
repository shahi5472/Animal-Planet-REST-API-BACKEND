<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add Doctor</li>
    </ol>

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="addAdmitForm">
                <div class="addAdmitForm-header-One">
                    <h2>Add Doctor Form</h2>
                </div>
                <hr/>
                <form id="form-data" enctype="multipart/form-data" method="post">
                    <div class="doctorForm">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input hidden
                                       type="text"
                                       class="form-control"
                                       id="user_type"
                                       name="user_type"
                                       value="doctor"
                                />
                                <div class="form-group">
                                    <label for="fname">Name:</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            id="form-fname"
                                            name="name"
                                    />
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input
                                            type="email"
                                            class="form-control"
                                            id="form-email"
                                            name="email"
                                    />
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="email">Contact</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            id="phone"
                                            name="phone"
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
                                    <label for="email">Upload doctor Photo </label>
                                    <input
                                            type="file" id="file" name="file"
                                    />
                                    <div
                                            id="View_area"
                                            style="
                            position: relative;
                            width: 100px;
                            height: 100px;
                            color: black;
                            border: 0px solid black;
                            display: inline;"></div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="specialists">Speciality</label>
                                    <select class="form-control" id="specialists" name="specialists">
                                        <!-- <option>Select a Speciality</option> -->
                                        <option>Dog</option>
                                        <option>Cat</option>
                                        <option>Birds</option>
                                        <option>Rabbit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button style="margin-right: 10px; margin-left: 20px" type="submit" id="create" class="btn btn-success btn-lg">
                            Create
                        </button>
                        <button type="button" id="reset" class="btn btn-danger btn-lg">
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
        // $(document).on('click', '#create', function () {
        //     $.ajax({
        //         url: '../user/createDoctor.php',
        //         method: 'post',
        //         data: $("#form-data").serialize(),
        //         success: function (response) {
        //             $("#form-data")[0].reset();
        //             // alert(response);
        //             console.log(response);
        //         }
        //     });
        // });
        $("#form-data").on("submit", function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "../user/createDoctor.php",
                type: "POST",
                cache: false,
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    window.location = 'index.php?page=addDoctor';
                }
            });
        });

        $(document).on('click', '#reset', function () {
            window.location = 'index.php?page=addDoctor';
        })
    });

</script>
