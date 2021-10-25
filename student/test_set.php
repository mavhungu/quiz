<?php
require_once 'partial/header.php';
require_once 'partial/nav.php';
require_once 'partial/aside.php';
require_once 'partial/dashboard.php';
?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!--div-- class="card"-->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-sm" id="example1">
                            <thead class="bg-info text-center">
                                <tr class="text-center">
                                    <th>Exam ID</th>
                                    <th>Topic</th>
                                    <th>Total question</th>
                                    <th>Marks</th>
                                    <th>Time limit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php exams();?>
                            </tbody>
                        </table>
                    </div>
                    <!--/div-->
                </div>
            </div>
        </div>
    </section>

<?php require_once 'partial/footer.php'; ?>