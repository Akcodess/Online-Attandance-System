<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>OAS | LOGIN</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <style>
    body::before{
    content: "";
    position: absolute;
    background: url('../img/login.png')no-repeat center center/cover;
    top:10px;
    left:0px;
    height: 600px;
    width:100%;
    z-index: -1;
    }
    footer
    {
    border-top: 3px solid #DC3545;
    background: black;
    color: white;
    padding: 9px 10px;
    }
    .custom-margin {
        margin-top: 10vh;
    }
   </style>
</head>
<body>

<?php
// connect to the database
include '../dbcon.php';

if(!isset($_SESSION['is_adminlogin']))
{
  if(isset($_POST['asubmit']))
  {

    if(($_POST['aemail'] == "") || ($_POST['apassword'] == ""))
    {
      $lmsg = '<div class="alert alert-warning mt-2 font-weight-bold" role="alert"> Enter Both Email & Password </div>';
    }
    else
    {
        $aemail = mysqli_real_escape_string($con,$_POST['aemail']);
        $apassword = mysqli_real_escape_string($con,$_POST['apassword']);

        $email_search = "SELECT * FROM adminlogin_tb WHERE a_email='$aemail' AND a_password = '$apassword'";
        $query = mysqli_query($con, $email_search);

        $email_count = mysqli_num_rows($query);

        if($email_count)
        {
            $_SESSION['is_adminlogin'] = true;
            $_SESSION['aEmail'] = $aemail;
            $lmsg = '<div class="alert alert-success mt-2 font-weight-bold" role="alert"> login successfull </div>';
            ?>
              <script>
                  location.replace("Admindashboard.php");
              </script>
            <?php
        }
        else
        {
          $lmsg = '<div class="alert alert-danger mt-2 font-weight-bold" role="alert"> Enter Valid Email and Password </div>';
        }
    }
  }
}
else
{
  ?>
  <script>
      location.replace("Admindashboard.php");
  </script>
  <?php
}

?>
  <div class="mb-3 text-center mt-3" style="font-size: 40px;">
    <i class="fas fa-calendar"></i>
    <span>Online Attendance System</span>
  </div>
  <p class="text-center" style="font-size: 25px; font-family: serif;"><i class="fas fa-user-secret text-danger"></i> Admin Login
  </p>
  <div class="container-fluid mb-5">
    <div class="row justify-content-center custom-margin">
      <div class="col-sm-6 col-md-4">
      <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" class="shadow-lg p-4" method="POST">
        <p><?php if(isset($lmsg)) {echo $lmsg; } ?></p>
          <div class="form-group">
            <i class="fas fa-envelope"></i><label for="email" class="pl-2 font-weight-bold">Email</label><input type="email"
              class="form-control" placeholder="Email" name="aemail">
            <!--Add text-white below if want text color white-->
            <small class="form-text">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <i class="fas fa-key"></i><label for="pass" class="pl-2 font-weight-bold">Password</label><input type="password"
              class="form-control" placeholder="Password" name="apassword">
          </div>
          <button type="submit" name="asubmit" class="btn btn-outline-dark mt-3 btn-block shadow-sm font-weight-bold">Login</button>
        </form>
        <div class="text-center"><a class="btn btn-info mt-3 shadow-sm font-weight-bold" href="../index.php">Back
            to Home</a></div>
      </div>
    </div>
  </div>
<footer>
        <div class="text-center">
            Copyright &copy; All rights reserved! &nbsp;By- AK
        </div>
</footer>

  <!-- Boostrap JavaScript -->
  <script src="../js/jquery.min.js"></script>
  <!-- <script src="../js/popper.min.js"></script> -->
  <!-- <script src="../js/bootstrap.min.js"></script> -->
  <script src="../js/all.min.js"></script>
</body>

</html>