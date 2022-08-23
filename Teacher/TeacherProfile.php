<?php
define('TITLE', 'Teacher Profile');
define('PAGE', 'TeacherProfile');

include('includes/header.php');

// connect to the database
include('../dbcon.php');
session_start();

if(isset($_SESSION['username']))
{
    $lemail = $_SESSION['lemail'];
}
else
{
    header('location:TeacherLogin.php');
}

$sql = "SELECT username, email, mobile FROM registration_tb WHERE email = '$lemail'";

$result = mysqli_query($con, $sql);
if($result->num_rows == 1)
{
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $mobile = $row['mobile'];
}

if(isset($_POST['nameupdate']))
{
    if($_POST['lname'] == "")
    {
        $passmsg = '<div class="alert alert-warning col-sm-6 mt-2" role="alert"> Please Fill Your Name </div>';
    }
    else
    {
        $lname = $_POST['lname'];
        $sql = "UPDATE registration_tb SET username = '$lname' WHERE email = '$lemail'";
        if($con->query($sql) == TRUE)
        {
            echo '<meta http-equiv="refresh" content= "0;URL=?Updated" />';
            // $passmsg = '<div class="alert alert-success col-sm-6 mt-2" role="alert"> Name Updated Successfully </div>';
        }
        else
        {
            $passmsg = '<div class="alert alert-danger col-sm-6 mt-2" role="alert"> Unable to Update Your Name </div>';
        }
    }

}

?>

<div class="col-sm-6 mt-5">  <!-- Start Profile Area 2nd column-->
     <form class="mx-5" method="POST">
      <div class="form-group">
        <i class="fas fa-envelope"></i><label class="pl-2 font-weight-bold" for="inputEmail">Email</label>
        <input type="email" class="form-control" id="inputEmail" value="<?php echo $lemail ?>" readonly>
      </div>
      <div class="form-group">
        <i class="fas fa-phone"></i><label class="pl-2 font-weight-bold" for="inputEmail">Mobile</label>
        <input type="text" class="form-control" id="inputEmail" value="<?php echo $mobile ?>" readonly>
      </div>
      <div class="form-group">
        <i class="fas fa-user"></i><label class="pl-2 font-weight-bold" for="inputName">Name</label>
        <input type="text" class="form-control" id="inputName" name="lname" onkeypress="isInputName(event)" value="<?php echo $username ?>">
      </div>
        <button type="submit" class="btn btn-dark" name="nameupdate">Update</button>
        <?php if(isset($passmsg)) {echo $passmsg; } ?>
     </form>
</div> <!-- End Profile Area 2nd column-->      

<!-- Only Alphabets for input fields -->
<script>
  function isInputName(evt) {
    var nm = String.fromCharCode(evt.which);
    if (!(/^[a-zA-Z\s]+$/.test(nm))) {
      evt.preventDefault();
    }
  }
</script>

<?php

include('includes/footer.php');

?>