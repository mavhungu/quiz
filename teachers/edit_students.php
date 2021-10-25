<?php
require_once 'partial/header.php';
require_once 'partial/nav.php';
require_once 'partial/aside.php';
require_once 'partial/dashboard.php';
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- TABLE: LATEST ORDERS -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-6">
                <div class="card">
                    <div class="register-card-body">
                        <p class="login-box-msg">Update Students details</p>

                        <form action="" method="post">
                            <?php
                            if(($_POST['update_students'])==""){
                                teacher_edit_student();
                            }
                            if(isset($_POST['update_students'])){
                                teachers_update_students();
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
</section>

<?php
require_once 'partial/footer.php';
?>
