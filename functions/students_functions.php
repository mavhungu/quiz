<?php
require_once '../info.php';

function students(){

    global $con;

    $query =("SELECT * FROM users WHERE role = 3");
    $result = mysqli_query($con,$query);

    $count = mysqli_num_rows($result);

    if($count==0){
        echo <<<_END
            <tr class="text-center">
                <td colspan="5">No record has been found</td>
            </tr>
_END;
    }

    while($row = mysqli_fetch_assoc($result)){

        $username_id = $row['id'];
        $username = $row['username'];
        $email = $row['email'];
        $created = $row['created_at'];

        echo <<<_END
            <tr class="text-center">
                <td>$username_id</td>
                <td>$username</td>
                <td>$email</td>
                <td>$created</td>
                <td>
                    <a class="btn btn-info btn-sm" href="edit_students.php?edit=$username_id">Edit</a>
                    <a class="btn btn-danger btn-sm" href="delete.php?id=$username_id&name=$username">Delete</a>
                </td>
            </tr>
_END;


    }
};

function TeacherAddStudent(){

    if(isset($_SESSION['id'])){

    }
};

function logout(){
    if(isset($_POST['logout'])) {
        if (isset($_SESSION['username'])) {
            destroySession();
        }
    }
};

function destroySession(){

    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();

    header('Location:../index.php');

};

function results(){


    if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {

        global $con;

        $email = $_SESSION['email'];
        $eid=@$_GET['eid'];
        $sn=@$_GET['n'];
        $total=@$_GET['t'];
        $ans=$_POST['ans'];
        $qid=@$_GET['qid'];
        $q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
        while($row=mysqli_fetch_array($q) )
        {
            $ansid=$row['ansid'];
        }
        if($ans == $ansid)
        {
            $q=mysqli_query($con,"SELECT * FROM exam WHERE eid='$eid' " );
            while($row=mysqli_fetch_array($q) )
            {
                $sahi=$row['correct'];
            }
            if($sn == 1)
            {
                $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW())")or die('Error');
            }
            $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');

            while($row=mysqli_fetch_array($q) )
            {
                $s=$row['score'];
                $r=$row['sahi'];
            }
            $r++;
            $s=$s+$sahi;
            $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');

        }
        else
        {
            $q=mysqli_query($con,"SELECT * FROM exam WHERE eid='$eid' " )or die('Error129');

            while($row=mysqli_fetch_array($q) )
            {
                $wrong=$row['wrong'];
            }
            if($sn == 1)
            {
                $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
            }
            $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
            while($row=mysqli_fetch_array($q) )
            {
                $s=$row['score'];
                $w=$row['wrong'];
            }
            $w++;
            $s=$s-$wrong;
            $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
        }
        if($sn != $total)
        {
            $sn++;
            header("location:.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total")or die('Error152');
        }
        else if( $_SESSION['role']!= 1 )
        {
            $q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
            while($row=mysqli_fetch_array($q) )
            {
                $s=$row['score'];
            }
            $q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
            $rowcount=mysqli_num_rows($q);
            if($rowcount == 0)
            {
                $q2=mysqli_query($con,"INSERT INTO rank VALUES('$email','$s',NOW())")or die('Error165');
            }
            else
            {
                while($row=mysqli_fetch_array($q) )
                {
                    $sun=$row['score'];
                }
                $sun=$s+$sun;
                $q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
            }
            header("location:results.php?q=result&eid=$eid");
            ob_end_flush();
        }
        else
        {
            header("location:results.php?q=result&eid=$eid");
            ob_end_flush();
        }
    }
};

function student_passed(){
    global $con;
    $email = $_SESSION['email'];

    $query = mysqli_query($con,"SELECT * FROM final WHERE email='$email'");
    while($row= mysqli_fetch_assoc($query)){

        $pass = $row['score'];

        if($pass == "Pass"){

            $d = mysqli_query($con,"SELECT * from final WHERE score = 'Pass'");
            $count = mysqli_num_rows($d);

            echo $count;
        }

        }
};

function student_failed(){
  global $con;

    $email = $_SESSION['email'];

    $query = mysqli_query($con,"SELECT * FROM final WHERE email='$email'");

    while($row= mysqli_fetch_assoc($query)){

        $pass = $row['score'];

        if($pass == "Fail"){

            $d = mysqli_query($con,"SELECT * from final WHERE score = 'Fail'");
            $count = mysqli_num_rows($d);

            if($count == 0){

                echo $count;
            }
            //$count = mysqli_num_rows($d);

            echo $count;
        }


    }
};

function student_pass_record(){
    global $con;

    $query = mysqli_query($con, "SELECT * FROM final WHERE score ='Pass'");

        $passed_test = array();

    while($row = mysqli_fetch_assoc($query)) {

        array_push($passed_test, $row['eid']);
    }

        foreach ($passed_test as $passed){
            $query = mysqli_query($con, "SELECT * FROM exam WHERE eid = '$passed'");

            while($row = mysqli_fetch_assoc($query)){

                $eid = $row['eid'];
                $intro = $row['intro'];
                $title = $row['title'];
                $total = $row['total'];
                $correct = $row['correct'];

                echo <<<_END
                        <tr class="text-center">
                            <td>$eid</td>
                            <td>$intro</td>
                            <td>$title</td>
                            <td>$total</td>
                            <td>$correct</td>
                        </tr>
_END;

            }

        }

};

function student_exam_pass(){
    global $con;

    $user = $_SESSION['email'];

    $a = mysqli_query($con,"select * from final where email='$user' and score ='Pass'");
    $student_fail = mysqli_num_rows($a);

    if($student_fail == 0){

        echo "
        <tr>
            <td colspan='5' class='text-center'>No Passed Exam</td>
        </tr>
        ";
    }

    $ss = array();
    while ($row = mysqli_fetch_assoc($a)){

        array_push($ss,$row['eid']);
    }
    foreach ($ss as $s){
        //echo $s;

        $query = mysqli_query($con,"SELECT * FROM exam WHERE eid = '$s'");

        while($row = mysqli_fetch_assoc($query)){

            $eid = $row['eid'];
            $intro = $row['intro'];
            $title = $row['title'];
            $total = $row['total'];
            $correct = $row['correct'];

            echo <<<_END
                        <tr class="text-center">
                            <td>$eid</td>
                            <td>$intro</td>
                            <td>$title</td>
                            <td>$total</td>
                            <td>$correct</td>
                        </tr>
_END;

        }
    }

};

function student_exam_fail(){
    global $con;

    $user = $_SESSION['email'];

    $a = mysqli_query($con,"select * from final where email='$user' and score ='Fail'");
    $student_fail = mysqli_num_rows($a);

    if($student_fail == 0){

        echo "
        <tr>
            <td colspan='5' class='text-center'>No failed Exam</td>
        </tr>
        ";
    }

    $ss = array();
    while ($row = mysqli_fetch_assoc($a)){

        array_push($ss,$row['eid']);
    }
        foreach ($ss as $s){
            //echo $s;

            $query = mysqli_query($con,"SELECT * FROM exam WHERE eid = '$s'");

            while($row = mysqli_fetch_assoc($query)){

                $eid = $row['eid'];
                $intro = $row['intro'];
                $title = $row['title'];
                $total = $row['total'];
                $correct = $row['correct'];

                echo <<<_END
                        <tr class="text-center">
                            <td>$eid</td>
                            <td>$intro</td>
                            <td>$title</td>
                            <td>$total</td>
                            <td>$correct</td>
                        </tr>
_END;

            }
        }

};

?>