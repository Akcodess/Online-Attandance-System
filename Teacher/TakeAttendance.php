<?php
define('TITLE', 'Take Attendance');
define('PAGE', 'TakeAttendance');

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

// User wise Data fetching.... (Start)
$teacher = $_SESSION["lemail"];
$sql1 = "SELECT * FROM registration_tb WHERE email = '$teacher'";
$result = mysqli_query($con, $sql1);
$row = mysqli_fetch_array($result);
$teacherid = $row["id"];
// User wise Data fetching.... (End)

if (isset($_POST['save'])) {

  $date = date("Y-m-d");

  $csql = "SELECT * FROM `attendance_records_tb` WHERE `student_class` = '$_POST[claname]' AND `student_subject` = '$_POST[subname]' AND `date` = '$date'";
  $cresult = mysqli_query($con, $csql);
    
  $checkdate = mysqli_num_rows($cresult);
    
  if($checkdate)
  {
    $attmsg = '<div class="alert alert-warning mt-2 font-weight-bold" role="alert"> Today Allready Attendance Taken On This Class & Subject You Have Entered  </div>';
  }
  else
  {
    foreach ($_POST['attendance_status'] as $id => $attendance_status) 
    {
      $claname = mysqli_real_escape_string($con, $_POST['claname']);
      $subname = mysqli_real_escape_string($con, $_POST['subname']);
      $student_name = mysqli_real_escape_string($con, $_POST['student_name'][$id]);
      $student_roll = mysqli_real_escape_string($con, $_POST['student_roll'][$id]);
      $date = date("Y-m-d");

        // Sql query to be executed
        $asql = "INSERT INTO `attendance_records_tb` (`student_class`,`student_subject`,`student_name`, `student_roll`, `student_att_status`, `date`, `teacher_id`) VALUES ('$claname', '$subname', '$student_name', '$student_roll', '$attendance_status', '$date', '$teacherid')";
        $aresult = mysqli_query($con, $asql);

        // Checking for Add Student
        if ($aresult) 
        {
          $attmsg = "<div class='alert alert-success fade show' role='alert'><strong>Success!</strong> Attendance taken sucessfully</div>";
        } 
        else 
        {
          $attmsg = "<div class='alert alert-danger fade show' role='alert'><strong>Danger!</strong> Attendance unable to taken.</div>";
        }
    }
  }
}


?>
<div class="col-sm-8 col-md-9 mt-5 my-4">
  <h3>
    <div class="text-light well text-center shadow-lg p-2 bg-danger">DATE : <?php echo date("d-m-Y");  ?></div>
  </h3>
  <?php if(isset($attmsg)) {echo $attmsg; } ?>
  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="ml-5 form-group mt-5">
      <label for="name" class="font-weight-bold ml-5 ">Class Name: </label>
      <input type="text" name="claname" class="ml-3 pl-2 text-uppercase" placeholder="Eg: 10th/+2 1st year" required>
      <label for="name" class=" font-weight-bold ml-5">Subject Name: </label>
      <input type="text" name="subname" class="ml-3 pl-2 text-uppercase" placeholder="Eg: MATH/DBMS/SE" required>
    </div>
    <table class="mx-2 table table-striped">
      <thead class = "bg-dark">
        <tr>
          <th scope="col" class = "text-white">S.No</th>
          <th scope="col" class = "text-white">Student Name</th>
          <th scope="col" class = "text-white">Roll Number</th>
          <th scope="col" class = "text-white">Attendance Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // User wise Data fetching.... (Start)
        $teacher = $_SESSION["lemail"];
        $sql1 = "SELECT * FROM registration_tb WHERE email = '$teacher'";
        $result = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_array($result);
        $teacherid = $row1["id"];
        // User wise Data fetching.... (End)
        $sql = "SELECT * FROM `student_tb` WHERE teacher_id = '$teacherid'";
        $result = mysqli_query($con, $sql);
        $sno = 0;
        $statusradio = 0;
        while($row = mysqli_fetch_array($result))
        {
          $sno = $sno + 1;
        ?>
          <tr>
            <th scope='row'> <?php echo $sno ?></th>
            <td> <?php echo $row['student_name']; ?>
              <input type="hidden" value="<?php echo $row['student_name']; ?>" name="student_name[]">
            </td>

            <td> <?php echo $row['student_roll']; ?>
              <input type="hidden" value="<?php echo $row['student_roll']; ?>" name="student_roll[]">
            </td>
            <td>
              <input type='radio' name="attendance_status[<?php echo $statusradio; ?>]" value="Present" required>PRESENT
              <input type='radio' name="attendance_status[<?php echo $statusradio; ?>]" value="Absent" required>ABSENT
            </td>
          </tr>
        <?php
          $statusradio++;
        }
        ?>
      </tbody>
    </table>
    <button type="submit" class="btn btn-dark" name="save">Submit</button>
  </form>
</div> <!-- End Profile Area 2nd column -->




<?php

include('includes/footer.php');

?>