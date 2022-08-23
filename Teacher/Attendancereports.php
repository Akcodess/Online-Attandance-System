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



?>
<div class="col-sm-8 col-md-9 mt-5 my-4">
  <h3>
    <div class="text-light well text-center shadow-lg p-2 bg-danger">DATE : <?php if (isset($_POST['date'])) { echo "$_POST[date]"; }  ?></div>
  </h3>
  <br>
  <div>
  <a class="btn btn-info pull-right d-print-none" href="Attendancedate.php">Back</a><h2 class ="text-center" style="font-family: serif;">Attendance Report</h2>
  </div>
  <hr>
  <?php if(isset($attmsg)) {echo $attmsg; } ?>
    <table class="mx-2 table table-striped">
      <thead class = "bg-dark">
        <tr>
          <th scope="col" class = "text-white"class = "text-white">S.No</th>
          <th scope="col" class = "text-white">Student Name</th>
          <th scope="col" class = "text-white">Roll Number</th>
          <th scope="col" class = "text-white">Class Name</th>
          <th scope="col" class = "text-white">Subject Name</th>
          <th scope="col" class = "text-white">Attendance Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (isset($_POST['date'])) 
        {
          $sql = "SELECT * FROM `attendance_records_tb` WHERE `date` = '$_POST[date]' AND `student_class` = '$_POST[student_class]' AND `student_subject` = '$_POST[student_subject]'";
          $result = mysqli_query($con, $sql);
          $sno = 0;
          $statusradio = 0;
          while ($row = mysqli_fetch_array($result)) 
          {
            $sno = $sno + 1;
          ?>
            <tr>
              <th scope='row'> <?php echo $sno ?></th>
              <td> <?php echo $row['student_name']; ?></td>

              <td> <?php echo $row['student_roll']; ?></td>
              <td> <?php echo strtoupper($row['student_class']); ?></td>
              <td> <?php echo strtoupper($row['student_subject']); ?></td>
              <td>
              <input type='hidden' value = " . $row['date'] . " name = "date">
              <input type='hidden' value = " . $row['student_class']. " name = "student_class">
              <input type='hidden' value = " . $row['student_subject']. " name = "student_subject">
              <small class ="text-success font-weight-bold"><?php if($row['student_att_status'] == "Present"){ echo "PRESENT"; }?></small>
              <small class ="text-danger font-weight-bold"><?php if($row['student_att_status'] == "Absent"){ echo "ABSENT"; }?></small>
              </td>
            </tr>
          <?php
            $statusradio++;
          }
        }
        else
        {
          header('location:Attendancedate.php');
        }
        ?>
      </tbody>
    </table>
    <form class='d-print-none text-center'><input class='btn btn-danger' type='submit' value='Print' onClick='window.print()'></form>
</div> <!-- End Profile Area 2nd column -->




<?php

include('includes/footer.php');

?>