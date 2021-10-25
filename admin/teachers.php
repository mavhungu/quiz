<?php
require_once 'files/dashboard.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php require_once ('files/home_paginate.php');?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
<div class="container-fluid">
<!-- TABLE: LATEST ORDERS -->
<div class="card">
    <div class="card-header border-transparent">
        <h3 class="card-title">Teachers</h3>
        <div class="card-tools">
            <button data-toggle="modal" data-target="#addteacherss" class="btn btn-sm btn-info float-left">Add New Teacher</button>
                <div class="modal fade" id="addteacherss" tabindex="-1" role="dialog" aria-labelledby="addteacherss" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <!--h5-- class="modal-title" id="addteachers">Add Teacher</h5-->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!--div-- class="card"-->
                                    <div class="register-card-body">
                                        <p class="login-box-msg">Register a new teacher</p>

                                        <form action="" method="post">

                                            <?php addTeachers();?>

                                            <input type="hidden" name="role" value="2">
                                            <div class="input-group mb-3">
                                                <input type="text" name="username" class="form-control" placeholder="Full name">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-user"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="email" name="email" class="form-control" placeholder="Email">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-envelope"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="password" name="password1" class="form-control" placeholder="Password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="password" name="password2" class="form-control" placeholder="Retype password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <button type="submit" name="register_teachers" class="btn btn-primary btn-block">Register</button>
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-8">

                                                </div>
                                                <!-- /.col -->
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.form-box -->
                                <!--/div--><!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="example1">
                <thead>
                <tr class="text-center">
                    <th>Teachers IDs</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php echo teachers();?>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
</div>
<!-- /.card -->
</div>
    </div>
</div>

<?php require_once 'files/footer.php';?>
