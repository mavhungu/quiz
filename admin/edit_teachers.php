<?php
require_once 'files/dashboard.php';
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <!-- TABLE: LATEST ORDERS -->
                <div class="row justify-content-center mt-5">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="register-card-body">
                                <p class="login-box-msg">Update Teachers details</p>

                                <form action="" method="post">
                                    <?php
                                   if(($_POST['update_teachers'])==""){
                                     edit_teachers();
                                    }
                                    if(isset($_POST['update_teachers'])){
                                        update_teachers();
                                    }
                                    ?>


                                        <!-- /.col -->
                                        <div class="col-8">

                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
require_once 'files/footer.php';?>