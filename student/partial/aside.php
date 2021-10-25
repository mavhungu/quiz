<?php
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../dist/img/avatar.png" alt="avatar Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"> <?php echo $_SESSION['username']; ?> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview menu-open">
                    <a href="index.php" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-secret"></i>
                        <p>
                           Exams
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="test_set.php?view=exams" class="nav-link">
                                <i class="far fa-meh-rolling-eyes"></i>
                                <p>View Exams</p>
                            </a>
                        </li>
                    </ul>
                </li><!-- END OF STUDENTS -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
</aside>

<div class="modal fade" id="addstudents" tabindex="-1" role="dialog" aria-labelledby="addstudents" aria-hidden="true">
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
                    <p class="login-box-msg">Register a new Students</p>

                    <form action="" method="post">

                        <?php ?>

                        <input type="hidden" name="role" value="3">
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
                                <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
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
