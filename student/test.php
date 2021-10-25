<?php
require_once 'partial/header.php';
require_once 'partial/nav.php';
require_once 'partial/aside.php';
require_once 'partial/dashboard.php';
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <?php
                if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {

                    global $con;

                $eid=@$_GET['eid'];
                $sn=@$_GET['n'];
                $total=@$_GET['t'];
                $q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
                echo '<div class="panel" style="margin:5%">';
                    while($row=mysqli_fetch_assoc($q) )
                    {
                    $qns=$row['qns'];
                    $qid=$row['qid'];
                    echo '<b>Question &nbsp;'.$sn.'&nbsp;::<br />'.$qns.'</b><br /><br />';
                    }
                    global $con;
                    $q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid'" );
                    echo '<form action="update.php?q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="form-horizontal">
                        <br />';

                        while($row=mysqli_fetch_assoc($q) ) {

                        $option = $row['options'];
                        $option_id = $row['optionid'];

                        echo'<input type="radio" name="ans" value="'.$option_id.'"> '.$option.'<br /><br />';
                        }
                        echo'
                            <button type="submit" class="btn btn-primary text-center mb-4">
                            &nbsp;Submit
                            </button>
                                </form>
                           </div>';
                //header("location:dash.php?q=4&step=2&eid=$id&n=$total");
                }
                ?>
            </div>
        </div>
</section>

<?php require_once 'partial/footer.php'; ?>