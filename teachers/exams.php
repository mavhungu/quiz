<?php
require_once 'partial/header.php';
require_once 'partial/nav.php';
require_once 'partial/aside.php';
require_once 'partial/dashboard.php';

if(!(@$_GET['step'])){

    $user_id = $_SESSION['id'];
echo <<<_END
    <div class="container-fluid">
    <div class="row justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="text-center">
            <span class="title1 text-center" style="font-size:30px;"><b>Enter Exam Details</b></span>
        </div>
        <form class="form-horizontal title1" name="form" method="POST">
            <fieldset>
                <input type="hidden" value="$user_id" name="user_id"/>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-12 control-label" for="name"></label>
                    <div class="col-md-12">
                        <input id="name" name="name" placeholder="Enter Exam title" class="form-control input-md" type="text">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-12 control-label" for="total"></label>
                    <div class="col-md-12">
                        <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-12 control-label" for="right"></label>
                    <div class="col-md-12">
                        <input id="right" name="right" placeholder="Enter marks on right answer" class="form-control input-md" min="0" type="number">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-12 control-label" for="wrong"></label>
                    <div class="col-md-12">
                        <input id="wrong" name="wrong" placeholder="Enter minus marks on wrong answer without sign" class="form-control input-md" min="0" type="number">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-12 control-label" for="time"></label>
                    <div class="col-md-12">
                        <input id="time" name="time" placeholder="Enter time limit for test in minute" class="form-control input-md" min="1" type="number">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-12 control-label" for="tag"></label>
                    <div class="col-md-12">
                        <input id="tag" name="tag" placeholder="Enter #tag which is used for searching" class="form-control input-md" type="text">
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-12 control-label" for="desc"></label>
                    <div class="col-md-12">
                        <textarea rows="8" cols="8" name="desc" class="form-control" placeholder="Write description here..."></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12 control-label" for=""></label>
                    <div class="col-md-12 mb-5 text-center">
                        <input  type="submit" value="Submits" name="exam_details" class="btn btn-primary"/>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
</div>
_END;
}
?>

<?php

if (@$_GET['q']==4 && (@$_GET['step']) == 2) {
echo ' 
    <div class="container-fluid">
    <div class="row justify-content-center align-items-center">
        <div class="text-center mb-4">
            <span class="title1" style="font-size:30px;"><b>Enter Question Details</b></span>
        </div>
     </div>
     <div class="row justify-content-center align-items-center">
     <div class="col-md-6">
     <form class="form-horizontal title1" name="form" action="exams.php?q=addqns&n='.@$_GET['n'].'&eid='.@$_GET['eid'].'&ch=4 "  method="POST">
    <fieldset>
';

    for($i=1;$i<=@$_GET['n'];$i++)
    {
        echo '<b class="text-center">Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..."></textarea>  
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'1"></label>  
  <div class="col-md-12">
  <input id="'.$i.'1" name="'.$i.'1" placeholder="Enter option a" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'2"></label>  
  <div class="col-md-12">
  <input id="'.$i.'2" name="'.$i.'2" placeholder="Enter option b" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'3"></label>  
  <div class="col-md-12">
  <input id="'.$i.'3" name="'.$i.'3" placeholder="Enter option c" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'4"></label>  
  <div class="col-md-12">
    <input id="'.$i.'4" name="'.$i.'4" placeholder="Enter option d" class="form-control input-md" type="text">
  </div>
</div>
<br />
<b>Correct answer</b>:<br />
<select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="form-control input-md" >
      <option value="a">Select answer for question '.$i.'</option>
      <option value="a">option a</option>
      <option value="b">option b</option>
      <option value="c">option c</option>
      <option value="d">option d</option>
  </select><br/>';
    }

    echo '<div class="form-group">
      <label class="col-md-12 control-label" for=""></label>
          <div class="col-md-12 mb-5 text-center"> 
            <input  type="submit" name="submits" value="Submit" class="btn btn-primary"/>
          </div>
</div>

</fieldset>
</form>
</div>
</div>
</div>';

}
?>
    <?php
    require_once 'partial/footer.php';
    ?>
