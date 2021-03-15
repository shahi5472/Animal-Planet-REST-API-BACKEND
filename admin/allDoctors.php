<?php

include "../controller/dashboard_value.php";

?>
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
            <h2>All Doctors</h2>

            <div class="table-responsive">
                <table class="table table-light">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Address</th>
                        <th scope="col">Create Time & Date</th>
                        <th scope="col">Specialists</th>
                        <th scope="col">Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result = DashboardValue::getAllDoctor();
                    $x = 0;
                    while ($item = mysqli_fetch_assoc($result)) {
                        $x++;
                        ?>
                        <tr>
                            <th><?php echo $x; ?></th>
                            <td><img height="80" width="100"
                                    <?php
                                    $image = DashboardValue::getDoctorImage($item['id']);
                                    if ($image == null) {
                                        ?>
                                        src="./resource/img/doc-1.png"
                                    <?php
                                    } else {
                                        ?>
                                        src="../userview/uploads/<?php echo DashboardValue::getDoctorImage($item['id']); ?>"
                                    <?php
                                    } ?>
                                     alt=""/></td>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo $item['email']; ?></td>
                            <td><?php echo $item['phone']; ?></td>
                            <td><?php echo $item['address']; ?></td>
                            <td><?php echo $item['specialists']; ?></td>
                            <td><?php echo date_format(date_create($item['created_at']), "d-M-Y H:m:s"); ?></td>
                            <td>
                                <a hidden href="#"><i class="far fa-eye eye"></i></a>&nbsp;
                                <a hidden href="#"><i class="fas fa-sync-alt refresh"></i></a>&nbsp;
                                <a id="deleteDoctor" data-id="<?php echo $item['id']; ?>" href="#"> <i
                                            class="fas fa-times delete"></i></a>&nbsp;
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
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
        $(document).on('click', '#deleteDoctor', function () {
            var el = this;
            var id = $(this).data('id');
            $.ajax({
                url: '../user/deleteUser.php',
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


