<?php
require_once "info.php";

function login(){

    if(isset($_POST['login'])){

        global $con;

        $email = $_POST['email'];
        $password = $_POST['password'];


        $query = ("SELECT * FROM users WHERE email='$email' AND password='$password'");
        $result = mysqli_query($con,$query);

        $count = mysqli_num_rows($result);
        if($count == 0){
            echo "Nothing has been found";
        }

        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $role = $row['role'];
            $username = $row['username'];
            $email = $row['email'];

            echo $role;

            switch ($role){

                case 1:
                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $role;
                    $_SESSION['email'] = $email;
                    header('Location:admin/index.php');
                    ob_end_flush();
                    break;
                case 2:
                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $role;
                    $_SESSION['email'] = $email;
                    header('Location:teachers/index.php');
                    ob_end_flush();
                    break;
                case 3:
                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $role;
                    $_SESSION['email'] = $email;
                    header('Location:student/index.php');
                    ob_end_flush();
            }
        }

        $con->close();

    }
};

function addStudents(){

    if(isset($_POST['register'])){

        StudentsAdd();

    }

};

function addTeachers(){

    if(isset($_POST['register_teachers'])){

        TeachersAdd();

    }

};

function AsideAddStudents(){
    if (isset($_POST['asideaddstudent'])) {
        StudentsAdd();
    }
};

function asideAddTeachers(){
    if(isset($_POST['asideaddteachers'])){
        TeachersAdd();
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
}

function TeachersAdd(){
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
            header('Location:teachers.php');
            ob_end_flush();

            $con->close();
        }
    }
};

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
                    <a class="btn btn-info btn-sm" href="edit.php?id=$username_id&name=$username">Edit</a>
                    <a class="btn btn-danger btn-sm" href="delete.php?id=$username_id">Delete</a>
                </td>
            </tr>
_END;


    }
};

function teachers(){

    global $con;

    $query =("SELECT * FROM users WHERE role = 2");
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
                    <a class="btn btn-info btn-sm" href="edit_teachers.php?id=$username_id&name=$username">Edit</a>
                    <a class="btn btn-danger btn-sm" href="teachers_delete.php?id=$username_id">Delete</a>
                </td>
            </tr>
_END;

    }
};

function studentCount(){
    global $con;

    $query =("SELECT * FROM users WHERE role = 3");
    $result = mysqli_query($con,$query);

    $count = mysqli_num_rows($result);

    echo $count;
};

function teachersCount(){
    global $con;

    $query =("SELECT * FROM users WHERE role = 2");
    $result = mysqli_query($con,$query);

    $count = mysqli_num_rows($result);

    echo $count;

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

function scrore_passs(){

    global $con;

    $query1 = "SELECT * FROM final WHERE score = 'pass'";
    $result1 = mysqli_query($con,$query1);

    $count_pass = mysqli_num_rows($result1);

    echo $count_pass;
};

function score_fails(){
    global $con;

    $query1 = "SELECT * FROM final WHERE score = 'fail'";
    $result1 = mysqli_query($con,$query1);

    $count_pass = mysqli_num_rows($result1);

    echo $count_pass;

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

function student_fail_record(){
    global $con;

    $query = mysqli_query($con, "SELECT * FROM final WHERE score ='Fail'");

    $count_fail = mysqli_num_rows($query);

    if($count_fail == 0){
        echo "
        <tr>
            <td colspan='5' class='text-center'>No failed Exam</td>
        </tr>
        ";
    }

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

function edit_students(){
    if(isset($_GET['id']) && is_numeric($_GET['id'])){

        global $con;
        $id = $_GET['id'];

        $q = mysqli_query($con, "Select * from users where id=$id");

        while($row = mysqli_fetch_assoc($q)){

            $id = $row['id'];
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

function edit_teachers(){
    if(isset($_GET['id']) && is_numeric($_GET['id'])){

        global $con;
        $id = $_GET['id'];

        $q = mysqli_query($con, "Select * from users where id=$id");

        while($row = mysqli_fetch_assoc($q)){

            $id = $row['id'];
            $role = $row['role'];
            $username = $row['username'];
            $email = $row['email'];

            echo <<<_END

                <input type="hidden" name="role" value="$id">
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
                            <button type="submit" name="update_teachers" class="btn btn-primary btn-block" onclick="teachers_update();">Register</button>
                        </div>
_END;

        }

    }
};

function update_teachers(){
    if(isset($_POST['update_teachers'])){

        update_student_teacher();
    }
};

function update_student_teacher()
{
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        global $con;
        $id = $_GET['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $role = $_POST['role'];

        if (($password1 == $password2) && ($username != "") && ($email != "")) {

            $query = "UPDATE users SET username='$username', email='$email', password='$password1',role='$role' WHERE id=$id";
            $result = mysqli_query($con, $query);

            if ($result) {
                header('Location:teachers.php');
                ob_end_flush();

                $con->close();
            }
        }
    }
};
function update_students(){
    if(isset($_POST['update_students'])) {

        student_updates();

    }
};

function student_updates(){
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        global $con;
        $id = $_GET['id'];
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
}
?>