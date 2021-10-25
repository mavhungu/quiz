<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <?php
                    if(isset($_GET['view'])){
                        $st = $_GET['view'];
                        echo '<li class="breadcrumb-item active">'.ucfirst($st).'</li>';
                    }else{
                        echo '<li class="breadcrumb-item active">Dashboards</li>';
                    }
                    ?>

                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->