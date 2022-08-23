<?php

session_start();
// connect to the database
include 'dbcon.php';

if(isset($_GET['token']))
{
    $token = $_GET['token'];

    $updatequery = "UPDATE registration_tb SET `status`='Active' WHERE token='$token'";

    $query = mysqli_query($con, $updatequery);

    if($query)
    {
        if(isset($_SESSION['msg']))
        {
            $_SESSION['msg'] = "Account Created & Activated Successfully";
            header('location:Teacher/TeacherLogin.php');
        }
        else
        {
            $_SESSION['msg'] = "Wrong Verification link";
            header('location:Teacher/TeacherLogin.php');
        }
    }
    else
    {
        $_SESSION['msg'] = "Unable to Create account";
        header('location:TeacherRegistration.php');
    }
}

?>