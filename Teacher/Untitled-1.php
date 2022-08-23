<?php
            // $sql = mysqli_query($con,"SELECT * FROM student_tb WHERE student_gender");
            //   if(mysqli_num_rows($sql) == "MALE")
            //   {
            //     echo "checked=checked";
            //   }
            ?>

<td> <input type='button' class = 'btn btn-sm btn-primary' value = 'View' id='inputName' onclick='view();'></td>


$date = date("Y-m-d");

$csql = "SELECT * FROM `attendance_records_tb` WHERE `student_class` = '$_POST[claname]' AND `student_subject` = '$_POST[subname]' AND `date` = '$date'";
$cresult = mysqli_query($con, $csql);

$checkdate = mysqli_num_rows($cresult);

if($checkdate)
{
  $attmsg = '<div class="alert alert-warning mt-2 font-weight-bold" role="alert"> Today Allready Attendance Taken On This Class & Subject You Have Entered  </div>';
}



<?php
define('TITLE', 'Attendance Reports');
define('PAGE', 'Attendancedate');

include('includes/header.php');

// connect to the database
include('../dbcon.php');
session_start();

// Check for user login or not
if (isset($_SESSION['is_login'])) 
{
  $lemail = $_SESSION['lemail'];
} 
else 
{
  header('location:TeacherLogin.php');
}

$ids = $_GET['id'];
$sql = "SELECT * FROM `attendance_records_tb` WHERE id = '$ids'";
$result = mysqli_query($con, $sql);
$sno = 0;
$row = mysqli_fetch_array($result);


?>

<div class="col-sm-6 mt-5">  <!--ADD Student 2nd column-->
    <form class="mx-5" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
      <?php if(isset($stmsg)) {echo $stmsg; } ?>
      <div class="form-group">
        <i class="fas fa-user-graduate"></i><label class="pl-2 font-weight-bold" for="inputname">Student Name</label>
        <input type="text" class="form-control" id="inputEmail" name="sname" placeholder="Full Name" value="<?php echo $row['student_name']; ?>" >
      </div>
      <div class="form-group">
        <i class="fas fa-id-card"></i><label class="pl-2 font-weight-bold" for="inputrollno">Roll Number</label>
        <input type="text" class="form-control" id="inputName" name="sroll" placeholder="Roll Number">
      </div>
      <div class="form-group">
        <i class="fas fa-mars"></i><label class="pl-2 font-weight-bold">Gender:</label><br>
        <input type="radio" name="sgender" value="MALE" required/>Male &nbsp;
        <input type="radio" name="sgender" value="FEMALE" required/>Female
      </div>
      <div class="form-group">
        <i class="fas fa-user"></i><label class="pl-2 font-weight-bold" for="inputparent">Parent Name</label>
        <input type="text" class="form-control" id="inputName" name="sparent" onkeypress="isInputName(event)" placeholder="Full Name">
      </div>
      <div class="form-group">
        <i class="fas fa-phone"></i><label class="pl-2 font-weight-bold" for="inputmobile">Mobile</label>
        <input type="text" class="form-control" id="inputName" name="smobile" onkeypress="isInputNumber(event)" placeholder="Mobile Number">
      </div>
        <button type="submit" class="btn btn-dark" name="addstudent">Add Student</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </form>
  </div> <!-- End ADD student 2nd column-->




<?php

include('includes/footer.php');

?>



$name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $to = "attendancesystem800@gmail.com";
        $headers = "from: ". $email;
        $txt = "You have recevied an email from ". $name. ".\n\n" .$message;

        if(mail($to,$subject,$txt,$headers))
        {
            $ctmsg = '<div class="alert">  </div>';
        }
        else
        {

        }