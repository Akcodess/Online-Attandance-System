<?php
session_start();
define('TITLE', 'Admin Change Password');
define('PAGE', 'Adminchangepass');
include('includes/header.php');
include('../dbcon.php');

if(isset($_SESSION['is_adminlogin']))
{
    $aemail = $_SESSION['aEmail'];
}
else
{
    header('location:login.php');
}

if(isset($_POST['passupdate']))
{
    if($_POST['fPassword'] == "" || ($_POST['cPassword'] == ""))
    {
        $passmsg = '<div class="alert alert-warning col-sm-8 mt-2 font-weight-bold" role="alert"> Please Fill Your password </div>';
    }
    else
    {
      $sql = "SELECT * FROM `adminlogin_tb` WHERE a_email='$aemail'";
      $result = $con->query($sql);
      if($result)
      {
          $fpassword = $_POST['fPassword'];
          $cpassword = $_POST['cPassword'];
          if($fpassword == $cpassword)
          {
              $sql = "UPDATE adminlogin_tb SET `a_password` = '$cpassword' WHERE a_email = '$aemail'";
              if($con->query($sql) == TRUE)
              {
              // below msg display on form submit success
              $passmsg = '<div class="alert alert-success col-sm-8 mt-2 font-weight-bold" role="alert"> Password Updated Successfully </div>';
              } 
              else 
              {
              // below msg display on form submit failed
              $passmsg = '<div class="alert alert-danger col-sm-8 mt-2 font-weight-bold" role="alert"> Unable to Update Password  </div>';
              }
          }
          else
          {
            $passmsg = '<div class="alert alert-danger col-sm-8 mt-2 font-weight-bold" role="alert">Password not Matching</div>';
          }
      }
    }
}
?>



<div class="col-sm-9 col-md-10">
  <div class="row">
    <div class="col-sm-6">
      <form class="mt-5 mx-5" method="POST">
        <div class="form-group">
          <label for="inputEmail">Email</label>
          <input type="email" class="form-control" id="inputEmail" value=" <?php echo $aemail ?>" readonly>
        </div>
        <div class="form-group">
          <label for="inputnewpassword">New Password</label>
          <input type="password" class="form-control" id="inputnewpassword" placeholder="New Password" name="fPassword">
        </div>
        <div class="form-group">
          <label for="inputnewpassword">Confirm Password</label>
          <input type="password" class="form-control" id="inputnewpassword" placeholder="Confirm Password" name="cPassword">
        </div>
        <button type="submit" class="btn btn-dark mr-4 mt-4" name="passupdate">Update</button>
        <button type="reset" class="btn btn-danger mt-4">Reset</button>
        <?php if(isset($passmsg)) {echo $passmsg; } ?>
      </form>
    </div>
  </div>
</div>





<?php
include('includes/footer.php'); 
?>