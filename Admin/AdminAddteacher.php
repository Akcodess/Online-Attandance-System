<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OAS | ADD TEACHER</title>
      <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
      body::before{
        content: "";
        position: absolute;
        background: url('../img/login.png')no-repeat center center/cover;
        top:10px;
        left:0px;
        height: 798px;
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
    </style>
</head>
<body>

<?php
// connect to the database
include '../dbcon.php';
if(isset($_POST['asubmit']))
{
  // Checking for Empty Fields
  if(($_POST['username'] == "") || ($_POST['remail'] == "") || ($_POST['rmobile'] == "") || ($_POST['fpassword'] == "") || ($_POST['cpassword'] == ""))
  {
    $rmsg = '<div class="alert alert-warning mt-2 font-weight-bold" role="alert"> All Fields are Required </div>';
  }
  else
  {
      // Assigning User Values to Variable
      $username = mysqli_real_escape_string($con,$_POST['username']);
      $email = mysqli_real_escape_string($con,$_POST['remail']);
      $mobile = mysqli_real_escape_string($con,$_POST['rmobile']);
      $fpassword = mysqli_real_escape_string($con,$_POST['fpassword']);
      $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);

      $pass = password_hash($fpassword, PASSWORD_BCRYPT);
      $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

      $token = bin2hex(random_bytes(15));

      $emailquery = "SELECT * FROM registration_tb WHERE email='$email'";
      $query = mysqli_query($con,$emailquery);

      $emailcount = mysqli_num_rows($query);

      if($emailcount>0)
      {
        $rmsg = '<div class="alert alert-danger mt-2 font-weight-bold" role="alert">Email Already Exist.. </div>';
      }
      else
      {
        if($fpassword == $cpassword)
        {
          $insertquery = "INSERT INTO registration_tb (`username`, `email`, `mobile`, `fpassword`, `cpassword`, `token`, `status`) VALUES('$username', '$email', '$mobile', '$pass', '$cpass','$token','Active') ";

          $iquery = mysqli_query($con, $insertquery);

                // if($iquery)
                // {
                //   $subject = "Email Verification From OAS";
                //   $headers .= "MIME-Version: 1.0"."\r\n";
                //   $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                //   $headers .= 'from:OAS | OAS <attendancesystem800@gmail.com>'."\r\n";

                //   $ms.="<html></body><div><div>Dear $username,</div></br></br>";
                //   $ms.="<div style='padding-top:8px;'>Please Verify your email now for track your Attendnace & Activate your account</div>
                //   <div style='padding-top:10px;'><a href='http://localhost/OAS/activate.php?token=$token'>Verify Now</a></div>
                //   </div></body></html>";

                //   if (mail($email, $subject, $ms, $headers)) {
                //       $_SESSION['msg'] = "Please verify in the registered email-$email";
                //       header('location:Teacher/TeacherLogin.php');
                //   } 
                //   else {
                //     $rmsg = '<div class="alert alert-danger mt-2 font-weight-bold" role="alert">Activation link Sending Fail.. </div>';
                //   }
                // }
                // else
                // {
                //   $rmsg = '<div class="alert alert-warning mt-2 font-weight-bold" role="alert">Unable to Create account</div>';
                // }
        }
        else
        {
          $rmsg = '<div class="alert alert-danger mt-2 font-weight-bold" role="alert">Password not Matching</div>';
        }
      }
  }
}

?>

<div class="mb-3 text-center mt-3" style="font-size: 40px;">
    <i class="fas fa-calendar"></i>
    <span>Online Attendance System</span>
</div>
<div class="container" id="registration">
  <div class="row mt-4 mb-4">
    <div class="col-md-6 offset-md-3">
      <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" class="shadow-lg p-4" method="POST">
        <h2 class="text-center">Create an Account</h2>
        <p><?php if(isset($rmsg)) {echo $rmsg; } ?></p>
        <div class="form-group">
          <i class="fas fa-user"></i><label for="name" class="pl-2 font-weight-bold">Name</label><input type="text"
            class="form-control" onkeypress="isInputName(event)" placeholder="Full Name" name="username">
        </div>
        <div class="form-group">
          <i class="fas fa-envelope"></i><label for="email" class="pl-2 font-weight-bold">Email</label><input type="email"
            class="form-control" placeholder="Email" name="remail">
          <!--Add text-white below if want text color white-->
          <small class="form-text">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <i class="fas fa-phone"></i><label for="mobile" class="pl-2 font-weight-bold">Mobile
            </label><input type="text" class="form-control" onkeypress="isInputNumber(event)" placeholder="Mobile Number" name="rmobile">
        </div>
        <div class="form-group">
          <i class="fas fa-key"></i><label for="pass" class="pl-2 font-weight-bold">
            Password</label><input type="password" class="form-control" placeholder="Password" name="fpassword">
        </div>
        <div class="form-group">
          <i class="fas fa-key"></i><label for="pass" class="pl-2 font-weight-bold">Confirm
            Password</label><input type="password" class="form-control" placeholder="Password" name="cpassword">
        </div>
        <button type="submit" name="asubmit" class="btn btn-outline-dark mt-3 btn-block shadow-sm font-weight-bold">Add Teacher</button>
      </form>
      <div class="text-center"><a class="btn btn-info mt-2 shadow-sm font-weight-bold" href="AllTeachers.php">Back to Home</a>
      </div>
    </div>
  </div>
</div>


<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>

<!-- Only Alphabets for input fields -->
<script>
  function isInputName(evt) {
    var nm = String.fromCharCode(evt.which);
    if (!(/^[a-zA-Z\s]+$/.test(nm))) {
      evt.preventDefault();
    }
  }
</script>

<footer>
      <div class="text-center">
        Copyright &copy; All rights reserved! &nbsp;By- AK
      </div>
</footer>
  <!-- Boostrap JavaScript -->
  <script src="../js/jquery.min.js"></script>
  <!-- <script src="js/bootstrap.min.js"></script> -->
  <script src="../js/all.min.js"></script>
</body>

</html>