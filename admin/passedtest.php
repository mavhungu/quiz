<?php
require_once 'files/dashboard.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php require_once 'files/home_paginate.php'?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="example1">
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
                        <?php student_pass_record();?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<?php require_once 'files/footer.php';?>
