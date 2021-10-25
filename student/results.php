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
<?php
if(@$_GET['q']== 'result' && @$_GET['eid'])
{
    global $con;

    $email = $_SESSION['email'];

    $eid=@$_GET['eid'];
    $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error157');
    echo  '
<h1 class="title text-center font-weight-bolder" style="color:#660033">Result</h1><br />
<table class="table table-striped title1 font-weight-bold" style="font-size:20px;">';

    while($row=mysqli_fetch_array($q) )
    {
        $s=$row['score'];
        $w=$row['wrong'];
        $r=$row['sahi'];
        $qa=$row['level'];
        echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>'.$qa.'</td></tr>
              <tr style="color:#99cc32"><td>right Answer&nbsp;<i class="fa fa-check-circle"></i></td><td>'.$r.'</td></tr> 
              <tr style="color:red"><td>Wrong Answer&nbsp;<i class="fas fa-minus-circle"></i></td><td>'.$w.'</td></tr>
              <tr style="color:#66CCFF"><td>Score&nbsp;<span class="fa fa-star"></span></td><td>'.$s.'</td></tr>';

        if($w>$r){
            $query =mysqli_query($con,"insert into final VALUES ('$eid','$email','Fail')");
        }
        if($w<$r){
            $query =mysqli_query($con,"insert into final VALUES ('$eid','$email','Pass')");
        }
    }

    $q=mysqli_query($con,"SELECT * FROM rank WHERE  email='$email' " )or die('Error157');
    while($row=mysqli_fetch_array($q) )
    {
        $s=$row['score'];
        echo '<tr style="color:#990000"><td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats fa fa-signal" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
    }
    echo '</table>';

}
?>

                </div>
            </div>
        </div>
</section>

<?php require_once 'partial/footer.php'; ?>