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
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
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
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="Admindashboard.php">OAS</a>
    </nav>

<!-- Side Bar -->
<div class="container-fluid mb-5 " style="margin-top:40px;">
 <div class="row">
    <nav class="col-sm-3 col-md-2 bg-light sidebar py-5 d-print-none">
        <div class="sidebar-sticky">
        <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link <?php if(PAGE == 'Admindashboard'){echo 'active';} ?>" href="Admindashboard.php">
            <i class="fas fa-tachometer-alt"></i>
            Dashboard <span class="sr-only">(current)</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if(PAGE == 'Allteacher'){echo 'active';} ?>" href="AllTeachers.php">
            <i class="fas fa-user-tie"></i>
            All Teacher
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if(PAGE == 'Allstudent'){echo 'active';} ?>" href="AllStudent.php">
            <i class="fas fa-users"></i>
            All Student
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if(PAGE == 'AllAttendance'){echo 'active';} ?>" href="AllAttendanceReports.php">
            <i class="fas fa-clipboard-list"></i>
            All Attendance Reports
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if(PAGE == 'Adminchangepass'){echo 'active';} ?>" href="Adminchangepassword.php">
            <i class="fas fa-key"></i>
            Change Password
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="logout.php">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </a>
        </li>
        </ul>
        </div>
    </nav> <!-- End Side Bar -->