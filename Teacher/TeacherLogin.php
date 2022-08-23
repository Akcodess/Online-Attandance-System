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
    height: 703px;
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
        margin-top: 6vh;
    }
   </style>
</head>
<body>

<?php
// connect to the database
include '../dbcon.php';

if(!isset($_SESSION['is_login']))
{
  if(isset($_POST['lsubmit']))
  {

    if(($_POST['lemail'] == "") || ($_POST['lpassword'] == ""))
    {
      $lmsg = '<div class="alert alert-warning mt-2 font-weight-bold" role="alert"> Enter Both Email & Password </div>';
    }
    else
    {
        $email = mysqli_real_escape_string($con,$_POST['lemail']);
        $password = mysqli_real_escape_string($con,$_POST['lpassword']);

        $email_search = "SELECT * FROM registration_tb WHERE email='$email' AND `status`='Active'";
        $query = mysqli_query($con, $email_search);

        $email_count = mysqli_num_rows($query);

        if($email_count)
        {
          $email_pass = mysqli_fetch_assoc($query);

          $db_pass = $email_pass['fpassword'];

          $_SESSION['username'] = $email_pass['username'];

          $pass_decode = password_verify($password, $db_pass);

          if($pass_decode)
          {
            $_SESSION['is_login'] = true;
            $_SESSION['lemail'] = $email;
            $lmsg = '<div class="alert alert-success mt-2 font-weight-bold" role="alert"> login successfull </div>';
            ?>
              <script>
                  location.replace("TeacherProfile.php");
              </script>
            <?php
          }
          else
          {
          $lmsg = '<div class="alert alert-danger mt-2 font-weight-bold" role="alert"> Incorrect Password </div>';
          }
        }
        else
        {
          $lmsg = '<div class="alert alert-warning mt-2 font-weight-bold" role="alert"> Account not Created or not Activated </div>';
        }
    }
  }
}
else
{
  ?>
  <script>
      location.replace("TeacherProfile.php");
  </script>
  <?php
}

?>
  <div class="mb-3 text-center mt-3" style="font-size: 40px;">
    <i class="fas fa-calendar"></i>
    <span>Online Attendance System</span>
  </div>
  <p class="text-center" style="font-size: 25px; font-family: serif;"><i class="fas fa-user-secret text-danger"></i> Teacher Login
  </p>
  <div class="container-fluid mb-5">
    <div class="row justify-content-center custom-margin">
      <div class="col-sm-6 col-md-4">
      <div>
        <p class="alert alert-success mt-2 font-weight-bold" role="alert">
          <?php
            if(isset($_SESSION['msg']))
            {
              echo $_SESSION['msg'];
            }
            else
            {
              echo $_SESSION['msg'] = "Login your Account. You have in logout";
            }
          ?>
        </p>
      </div>
      <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" class="shadow-lg p-4" method="POST">
        <p><?php if(isset($lmsg)) {echo $lmsg; } ?></p>
          <div class="form-group">
            <i class="fas fa-envelope"></i><label for="email" class="pl-2 font-weight-bold">Email</label><input type="email"
              class="form-control" placeholder="Email" name="lemail">
            <!--Add text-white below if want text color white-->
            <small class="form-text">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <i class="fas fa-key"></i><label for="pass" class="pl-2 font-weight-bold">Password</label><input type="password"
              class="form-control" placeholder="Password" name="lpassword">
          </div>
          <button type="submit" name="lsubmit" class="btn btn-outline-dark mt-3 btn-block shadow-sm font-weight-bold">Login</button>
          <div class="text-center mt-1">Not yet an account?<a href="../TeacherRegistration.php">Signup</a></div>
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