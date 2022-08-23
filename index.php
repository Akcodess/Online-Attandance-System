<?php
// connect to the database
include('dbcon.php');

if(isset($_POST['btn-send']))
{
    // Checking for Empty Fields
    if(($_POST['name'] == "") || ($_POST['email'] == "") || ($_POST['message'] == ""))
    {
        $ctmsg = '<div class="alert"> All Fields are Required </div>';
    }
    else
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $to = "attendancesystem800@gmail.com";

        if(mail($to,$name,$message,$email))
        {
            $ctmsg = '<div class="alert2"> Sent Successfully </div>';
        }
        else
        {

        }

    }



}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ONLINE ATTENDANCE SYSTEM</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" media="screen and (max-width: 1170px)" href="css/phone.css?v=<?php echo time(); ?>">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai|Bree+Serif&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        a {
        color: blue;
        text-decoration: none;
        }

        .active {
        color: white;
        }

        a:hover {
        color: #f26571;
        }
        footer{
            border-top: 3px solid #DC3545;
        }
        .alert{
            background-color: #DC3545;
            width: 200px;
            color: white;
            border-radius: 2px;
            border: 2px solid black;
            padding: 5px 5px;
            

        }
        .alert2{
            background-color: rgb(52, 221, 52);
            width: 200px;
            color: white;
            border-radius: 2px;
            border: 2px solid black;
            padding: 5px 5px;
            

        }
    </style>
</head>
<body>
<!-- Start Navigation -->
<nav id="navbar">
        <div id="logo">
           <a href="#home"><img src="img/logo.png" alt="O A S"></a> 
        </div>
        <ul>
            <li class="item"><a href="#home">Home</a></li>
            <li class="item"><a href="#about">About Us</a></li>
            <li class="item"><a href="#contact">Contact Us</a></li>
        </ul>
        <div class="right">
            <a href="Teacher/TeacherLogin.php"><button class="btn1">Login</button></a>
            <!-- <a href="regis.php"><button class="btn1">Register</button></a> -->
        </div>
    </nav> <!-- End Navigation -->
    
    <!-- Start Header Jumbotron-->
    <section id="home">
        <h1 class="h-primary">Welcome to Online Attendance System</h1>
        <p>“Attend today, and achieve tomorrow.”</p>
    </section> <!-- End Header Jumbotron -->

    <!--About Section-->
    <h1 id="about" class="h-primary center">About Us</h1>
    <section id="abouts-section">
        <div class="about-container">
        <div class="inner-container">
        <p class="text">
            Attendance is the concept of people, individually or as a group, appearing at a location for a previously scheduled event. Measuring attendance is a significant concern for many organizations, which can use such information to gauge the effectiveness of their efforts and to plan for future efforts.
        </p>
        </div>
        </div>
    </section> <!--About Section End-->
    
    <!--Start Contact Us-->
    <section id="contact">
        <h1 class="h-primary center">Contact Us</h1>
        <div id="contact-box">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
            <?php if(isset($ctmsg)) {echo $ctmsg; } ?>
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="name" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="message">Message: </label>
                    <textarea name="message" id="message" cols="30" rows="3"></textarea>
                </div>
                <button class="btn" name="btn-send">Submit</button>
            </form>
        </div>
    </section>
    <!-- End Contact Us -->
    
    <!-- Start Footer-->
    <footer>
        <div class="center">
            Copyright &copy; All rights reserved! &nbsp;By- AK
        </div>
        <div class="center"><small class="active"><a href="Admin/login.php">Admin Login</a></small></div>
    </footer> <!-- End Footer -->
</body>

</html>