<?php
require_once 'partial/header.php';
require_once 'partial/nav.php';
require_once 'partial/aside.php';
require_once ('partial/dashboard.php');

?>

<!-- Main content -->
<section class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="example1">
                            <thead>
                                <tr class="text-center">
                                    <th>Exam ID</th>
                                    <th>Topic</th>
                                    <th>Total question</th>
                                    <th>Marks</th>
                                    <th>Time limit</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php exam_create();?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?php
require_once 'partial/footer.php';
?>
