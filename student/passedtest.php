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
                    <div class="table-responsive">
                        <table class="table table table-striped table-bordered table-hover" id="example1">
                            <thead>
                                <tr class="text-center">
                                    <th>Test ID</th>
                                    <th>Test Description</th>
                                    <th>Test Title</th>
                                    <th>Test Questions</th>
                                    <th>Test Marks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?student_exam_pass();?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require_once 'partial/footer.php'; ?>