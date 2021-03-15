<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Admin</li>
    </ol>

    <!-- DataTables Example -->
    <div class="container-fluid">
        <div class="row">
            <h2>All Posts</h2>

            <div class="table-responsive">
                <table class="table table-light">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">Post Id</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Address</th>
                        <th scope="col">Create Time & Date</th>
                        <th scope="col">is Answered</th>
                        <th scope="col">Edit</th>
                    </tr>
                    </thead>
                    <tbody class="showList">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
        loadData();

        function loadData() {
            $.ajax({
                url: '../post/index.php',
                method: 'get',
                success: function (response) {
                    var json = JSON.parse(response);
                    var x = 0;
                    $.each(json, function (key, value) {
                        console.log(value)
                        x++;
                        $('.showList').append('<tr><th>' +
                            '' + x + '' +
                            '</th><td>' + value.user.name + '' +
                            '</td><td>' + value.user.email + '' +
                            '</td><td>' + value.user.phone + '' +
                            '</td><td>' + value.user.address + '' +
                            '</td><td>' + (value.created_at == null ? '' : value.created_at) + '' +
                            '</td><td>' + (value.is_answered != 0 ? 'Yes' : 'No') + '' +
                            '</td><td>' +
                            '<a id="showPost" data-id="' + value.id + '" href="#"><i class="far fa-eye eye"></i></a>&nbsp' +
                            '<a id="reload" data-id="' + value.id + '" href="#"><i class="fas fa-sync-alt refresh"></i></a>&nbsp' +
                            '<a id="deletePost" data-id="' + value.id + '" href="#"><i class="fas fa-times delete"></i></a>&nbsp' +
                            '</td></tr>');
                    });
                }
            });
        }

        $(document).on('click', '#showPost', function () {
            var id = $(this).data('id');
            alert("Id " + id)
        });

        $(document).on('click', '#deletePost', function () {
            var el = this;
            var id = $(this).data('id');
            $.ajax({
                url: '../post/deletePost.php',
                method: 'post',
                data: {
                    'id': id,
                },
                success: function (response) {
                    $(el).closest('tr').css('background', 'tomato');
                    $(el).closest('tr').fadeOut(800, function () {
                        $(el).remove();
                    });
                    console.log(response);
                }
            });
        });
    });

</script>
