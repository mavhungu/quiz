<?php
require_once '../info.php';

function exams_count()
{

    global $con;

    $result = mysqli_query($con, "SELECT * FROM exam ORDER BY date DESC") or die('Error');

    $count = mysqli_num_rows($result);

    echo $count;

};

function addStudents(){

    if(isset($_POST['register'])){

        StudentsAdd();

    }

};

function AsideAddStudents(){
    if (isset($_POST['asideaddstudent'])) {
        StudentsAdd();
    }
};

function StudentsAdd(){
    global $con;

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $role = $_POST['role'];

    if(($password1 == $password2) && ($username !="") && ($email !="") ){

        $query = ("INSERT INTO users (username, email, password, role) VALUES ('$username','$email','$password1',$role ) ");
        $result = mysqli_query($con,$query);

        if($result){
            header('Location:students.php');
            ob_end_flush();

            $con->close();
        }
    }
};

function studentCount(){
    global $con;

    $query =("SELECT * FROM users WHERE role = 3");
    $result = mysqli_query($con,$query);

    $count = mysqli_num_rows($result);

    echo $count;
};

function exam_create(){

    global $con;

    $email = $_SESSION['email'];

    $result = mysqli_query($con,"SELECT * FROM exam ORDER BY date DESC") or die('Error');

    $num = mysqli_num_rows($result);
    if($num == 0){
        echo '<tr>
<td class="text-center" colspan="4">Nothing has been found</td></tr>';
    }
    $c=1;
    while($row = mysqli_fetch_array($result)) {
        //$id = $row['id'];
        $title = $row['title'];
        $sahi = $row['correct'];
        $total = $row['total'];
        $time = $row['time'];
        $eid = $row['eid'];
        //$sum = $sahi*$total;

        $q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
        $rowcount=mysqli_num_rows($q12);
        if($rowcount == 0){

            echo '<tr class="text-center"><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>

	<!--td>
	    <b><a href="test.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn btn-info sub1">&nbsp;<span class="title1">Edit </span></a>
	</b>
	    <a href="#" class="btn btn-danger">Delete</a>
	</td--></tr>';
        }
        else
        {
            echo '<tr style="color:#99cc32"><td>'.$c++.'</td><td>'.$title.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
	<td><b><a href="update.php?q=quizre&step=25&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Restart</b></span></a></b></td></tr>';
        }
    }
    $c = 0;

};

function exams(){

    global $con;

    $email = $_SESSION['email'];

    $result = mysqli_query($con,"SELECT * FROM exam ORDER BY date DESC") or die('Error');

    $num = mysqli_num_rows($result);
    if($num == 0){
        echo '<tr>
<td class="text-center" colspan="4">Nothing has been found</td></tr>';
    }
    $c=1;
    while($row = mysqli_fetch_array($result)) {
        //$id = $row['id'];
        $title = $row['title'];
        $sahi = $row['correct'];
        $total = $row['total'];
        $time = $row['time'];
        $eid = $row['eid'];

        $q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
        $rowcount=mysqli_num_rows($q12);
        if($rowcount == 0){

            echo '<tr class="text-center">
                <td class="text-center">'.$c++.'</td>
                <td class="text-center">'.$title.'</td>
                <td class="text-center">'.$total.'</td>
                <td class="text-center">'.$sahi*$total.'</td>
                <td class="text-center">'.$time.'&nbsp;min</td>
	<td class="text-center">
	<a href="test.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="btn btn-info btn-sm sub1 text-center">
	<span class="fa fa-pen-nib"></span>&nbsp;<span class="title1 text-center">Start</span></a>
	</td></tr>';
        }
        else
        {
            echo '<tr style="color:#99cc32">
                        <td class="text-center">'.$c++.'</td>
                        <td class="text-center">'.$title.'&nbsp;<span title="This quiz is already solve by you" 
class="fa fa-check" aria-hidden="true"></span></td>
                        <td class="text-center">'.$total.'</td>
                        <td class="text-center">'.$sahi*$total.'</td>
                        <td class="text-center">'.$time.'&nbsp;min</td>
        <td class="text-center">
            <button class="btn btn-success btn-sm sub1">
                &nbsp;<span class="title1">Completed</span>
            </button>
        </td>
    </tr>';
        }
    }
        $c = 0;

};

if(isset($_POST['exam_details'])) {
    global $con;
    //$teacher_id = $_POST['user_id'];
    $name = $_POST['name'];
    $name= ucwords(strtolower($name));
    $total = $_POST['total'];
    $sahi = $_POST['right'];
    $wrong = $_POST['wrong'];
    $time = $_POST['time'];
    $tag = $_POST['tag'];
    $desc = $_POST['desc'];
    $id=uniqid();
    $q3=mysqli_query($con,"INSERT INTO exam(eid,title,correct, wrong, total, time, intro,tag) VALUES ('$id','$name' , '$sahi' , '$wrong','$total','$time' ,'$desc','$tag')");

    header("location:exams.php?q=4&step=2&eid=$id&n=$total");
    ob_end_flush();

    /*if($q3){

        header("location:exams.php?q=4&step=2&eid=$id&n=$total");
        header("location:exams.php?q=4&step=2&eid=$id&n=$total");
        ob_end_flush();
    }*/

};

if(isset($_POST['submits'])){

    if(@$_GET['q']== 'addqns') {
        //global $con;

        $n=@$_GET['n'];
        $eid=@$_GET['eid'];
        $ch=@$_GET['ch'];

        for($i=1;$i<=$n;$i++)
        {
            global $con;

            $qid=uniqid();
            $qns=$_POST['qns'.$i];
            $q3=mysqli_query($con,"INSERT INTO questions VALUES ('$eid','$qid','$qns' , '$ch' , '$i')");
            $oaid=uniqid();
            $obid=uniqid();
            $ocid=uniqid();
            $odid=uniqid();
            $a=$_POST[$i.'1'];
            $b=$_POST[$i.'2'];
            $c=$_POST[$i.'3'];
            $d=$_POST[$i.'4'];
            $qa=mysqli_query($con,"INSERT INTO options (qid,options, optionid) VALUES  ('$qid','$a','$oaid')") or die('Error61');
            $qb=mysqli_query($con,"INSERT INTO options (qid, options, optionid) VALUES  ('$qid','$b','$obid')") or die('Error62');
            $qc=mysqli_query($con,"INSERT INTO options (qid, options, optionid) VALUES  ('$qid','$c','$ocid')") or die('Error63');
            $qd=mysqli_query($con,"INSERT INTO options (qid, options, optionid) VALUES  ('$qid','$d','$odid')") or die('Error64');
            $e=$_POST['ans'.$i];
            switch($e)
            {
                case 'a':
                    $ansid=$oaid;
                    break;
                case 'b':
                    $ansid=$obid;
                    break;
                case 'c':
                    $ansid=$ocid;
                    break;
                case 'd':
                    $ansid=$odid;
                    break;
                default:
                    $ansid=$oaid;
            }


            $qans=mysqli_query($con,"INSERT INTO answer VALUES ('$qid','$ansid')");

        }
        header("location:test.php?q=0");
        ob_end_flush();
    }
};

function scrore_pass(){

    global $con;

        $query1 = "SELECT * FROM final WHERE score = 'pass'";
        $result1 = mysqli_query($con,$query1);

        $count_pass = mysqli_num_rows($result1);

        echo $count_pass;
};

function score_fail(){
    global $con;

        $query1 = "SELECT * FROM final WHERE score = 'fail'";
        $result1 = mysqli_query($con,$query1);

        $count_pass = mysqli_num_rows($result1);

        echo $count_pass;

};

function teacher_edit_student(){
    if(isset($_GET['edit'])){
        global  $con;
        $id = $_GET['edit'];

        $q = mysqli_query($con,"SELECT * FROM users WHERE id=$id");
        while($row = mysqli_fetch_assoc($q)){
            $role = $row['role'];
            $username = $row['username'];
            $email = $row['email'];

            echo <<<_END

                <input type="hidden" name="role" value="$role">
                    <div class="input-group mb-3">
                        <input type="text" name="username" value="$username" class="form-control" placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" value="$email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password1" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password2" class="form-control" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" name="update_students" class="btn btn-primary btn-block">Register</button>
                        </div>

_END;
        }

    }
};

function teachers_update_students(){
    if(isset($_POST['update_students'])){

        update_students_t();
    }
};
function update_students_t(){

    if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
        global $con;
        $id = $_GET['edit'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $role = $_POST['role'];

        if (($password1 == $password2) && ($username != "") && ($email != "")) {

            $query = "UPDATE users SET username='$username', email='$email', password='$password1',role='$role' WHERE id=$id";
            $result = mysqli_query($con, $query);

            if ($result) {
                header('Location:students.php');
                ob_end_flush();

                $con->close();
            }
        }
    }
};
?>