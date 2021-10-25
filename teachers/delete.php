<?php
require_once ('../info.php');

if(isset($_GET['id']) && is_numeric($_GET['id'])){

    global $con;
    $delete = $_GET['id'];

    $q =mysqli_query($con,"DELETE FROM users WHERE id=$delete");

        header('Location:students.php');
        ob_end_flush();
};