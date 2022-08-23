<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Custome CSS -->
    <link rel="stylesheet" href="../css/custom.css?v=<?php echo time(); ?>">
    <!-- Data table Css -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <title><?php echo TITLE ?></title>
    
    <style>
    footer
    {
    margin-top: 250px;
    border-top: 3px solid #DC3545;
    background: black;
    color: white;
    padding: 9px 10px;
    }
    </style>
</head>
<body>

<!-- Top Navbar -->
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="TeacherProfile.php">OAS</a>
</nav>

<!-- Side Bar -->
<div class="container-fluid mb-5 " style="margin-top:40px;">
 <div class="row">
    <nav class="col-sm-2 bg-light sidebar py-5 d-print-none">
        <div class="sidebar-sticky">
        <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link <?php if(PAGE == 'TeacherProfile'){echo 'active';} ?>" href="TeacherProfile.php">
            <i class="fas fa-user"></i>
            Profile <span class="sr-only">(current)</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if(PAGE == 'AddStudent'){echo 'active';} ?>" href="AddStudent.php">
            <i class="fas fa-plus"></i>
            Add Student
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if(PAGE == 'viewstudent'){echo 'active';} ?>" href="viewstudent.php">
            <i class="fas fa-user-graduate"></i>
            View Student
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if(PAGE == 'TakeAttendance'){echo 'active';} ?>" href="TakeAttendance.php">
            <i class="fas fa-edit"></i>
            Take Attendance
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if(PAGE == 'Attendancedate'){echo 'active';} ?>" href="Attendancedate.php">
            <i class="fas fa-clipboard-list"></i>
            Attendance Reports
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if(PAGE == 'Teacherchangepass'){echo 'active';} ?>" href="Teacherchangepassword.php">
            <i class="fas fa-key"></i>
            Change Password
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="../logout.php">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </a>
        </li>
        </ul>
        </div>
    </nav> <!-- End Side Bar -->