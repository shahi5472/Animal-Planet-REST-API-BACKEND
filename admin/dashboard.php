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

    <!-- amount cards -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class="info_amount1">
                        <div class="info_icon text-center">
                            <i class="fas fa-users"></i>

                            <p>Users</p>

                            <h2 class="info_numb text-center"><?php echo DashboardValue::getUserValue(); ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="info_amount2">
                        <div class="info_icon text-center">
                            <i class="fas fa-user-md"></i>

                            <p>Doctors</p>

                            <h2 class="info_numb text-center"><?php echo DashboardValue::getTotalDoctor(); ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="info_amount3">
                        <div class="info_icon text-center">
                            <i class="fas fa-clipboard"></i>

                            <p>Post</p>

                            <h2 class="info_numb text-center"><?php echo DashboardValue::getPostValue(); ?></h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- /.row -->
    </div>

    <div class="row">
        <div class="col-md-12">

            <h2>New Posts</h2>
            <div class="table-responsive">
                <table class="table table-light">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User Name</th>
                        <th scope="col">User Id</th>
                        <th scope="col">Post ID</th>
                        <th scope="col">Answered</th>
                        <th scope="col">Edit</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $result = DashboardValue::getNewPost();
                    for ($i = 0; $i < count($result); $i++) {
                        ?>
                        <tr>
                            <th><?php echo $i + 1; ?></th>
                            <td><?php echo $result[$i]['user']['name']; ?></td>
                            <td><?php echo $result[$i]['user']['id']; ?></td>
                            <td><?php echo $result[$i]['id']; ?></td>
                            <td><?php echo $result[$i]['is_answered'] == 0 ? 'False' : 'True'; ?></td>
                            <td>
                                <a href="#"><i class="far fa-eye eye"></i></a>&nbsp;
                                <a href="#"><i class="fas fa-trash delete"></i></a>&nbsp;
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
    <div hidden class="row">
        <div class="col-md-12">

            <h2>New Comments</h2>

            <div class="table-responsive">
                <table class="table table-light">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">Post ID</th>
                        <th scope="col">User Name</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result = DashboardValue::getNewPost();
                    for ($i = 0; $i < count($result); $i++) {
                        ?>
                        <tr>
                            <th>P111 <?php echo count($result[$i]['comments']); ?></th>
                            <td>Ria</td>
                            <td>125</td>
                            <td>
                                <a href="#"><i class="far fa-edit eye"></i></a>&nbsp;
                                <a href="#"><i class="fas fa-trash delete"></i></a
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
