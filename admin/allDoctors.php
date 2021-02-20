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
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo $item['email']; ?></td>
                            <td><?php echo $item['phone']; ?></td>
                            <td><?php echo $item['address']; ?></td>
                            <td><?php echo $item['specialists']; ?></td>
                            <td><?php echo date_format(date_create($item['created_at']), "d-M-Y H:m:s"); ?></td>
                            <td>
                                <a href="#"><i class="far fa-eye eye"></i></a>&nbsp;
                                <a href="#"><i class="fas fa-sync-alt refresh"></i></a
                                >&nbsp;
                                <a href="#"><i class="fas fa-times delete"></i></a
                                >&nbsp;
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
                <p>&copy; <a href="#">Woofs&Paws </a> | 2021</p>
                <p>
                    Contact information:
                    <a href="mailto:someone@example.com">someone@example.com</a>.
                </p>
            </div>
        </div>
    </div>
</div>
