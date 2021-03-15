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
            <h2>All Hospitals</h2>

            <div class="table-responsive">
                <table class="table table-light">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Address</th>
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
        $.ajax({
            url: '../hospital/index.php',
            method: 'get',
            success: function (response) {
                var json = JSON.parse(response);
                var x = 0;
                $.each(json.hospitals, function (key, value) {
                    x++;
                    $('.showList').append('<tr><th>' + x + '' +
                        '</th><td><img height="80" width="100" src="../userview/uploads/' + value['URL'] + '" alt=""/>' +
                        '</th><td>' + value['name'] + '' +
                        '</td><td>' + value['contact'] + '' +
                        '</td><td>' + value['address'] + '' +
                        '</td><td>' +
                        '<a href="#"><i class="far fa-eye eye"></i></a>&nbsp;' +
                        '<a href="#"><i class="fas fa-sync-alt refresh"></i></a>&nbsp;' +
                        '<a id="deleteHospital" data-id="' + value.id + '"  href="#"><i class="fas fa-times delete"></i></a>&nbsp;' +
                        '</td></tr>');
                });
            }
        });

        $(document).on('click', '#deleteHospital', function () {
            var el = this;
            var id = $(this).data('id');
            $.ajax({
                url: '../hospital/delete.php',
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
