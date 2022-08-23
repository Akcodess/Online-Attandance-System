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

if(isset($_POST['attdelete']))
{
   $sql = "DELETE FROM attendance_records_tb WHERE `date` = '$_POST[date]' AND `student_class` = '$_POST[student_class]' AND `student_subject` = '$_POST[student_subject]'";
   $result = mysqli_query($con, $sql);
   if($result == TRUE)
   {
     echo '<meta http-equiv="refresh" content= "0;URL=?closed" />';
   }
   else
   {
    $attmsg = "<div class='alert alert-danger fade show' role='alert'><strong>Danger!</strong> Unable to Delete </div>";
   }
}


?>

<div class="col-sm-8 col-md-9 mt-5 my-4">
  <h3>
    <div class="text-light well text-center shadow-lg p-2 bg-danger">DATE : <?php echo date("d-m-Y");  ?></div>
  </h3>
  <?php if(isset($attmsg)) {echo $attmsg; } ?>
  <br>
    <table class="mx-2 table table-striped" id="AttendanceDate">
      <thead class = "bg-dark">
        <tr>
          <th scope="col" class = "text-white">S.No</th>
          <th scope="col" class = "text-white">Dates</th>
          <th scope="col" class = "text-white">Class Name</th>
          <th scope="col" class = "text-white">Subject Name</th>
          <th scope="col" class = "text-white">Delete Reports</th>
          <th scope="col" class = "text-white">View Reports</th>
        </tr>
      </thead>
      <tbody>
      <?php

      // User wise Data fetching.... (Start)
      $teacher = $_SESSION["lemail"];
      $sql1 = "SELECT * FROM registration_tb WHERE email = '$teacher'";
      $result1 = mysqli_query($con, $sql1);
      $row = mysqli_fetch_array($result1);
      $teacherid = $row["id"];
      // User wise Data fetching.... (End)

      $sql = "SELECT DISTINCT date, student_class, student_subject FROM `attendance_records_tb` WHERE teacher_id = '$teacherid'";
      $result = mysqli_query($con, $sql);
      $sno = 0;
      while ($row = mysqli_fetch_assoc($result)) {
        $sno = $sno + 1;
        echo "<tr>
        <th scope='row'>" . $sno . "</th>
        <td>" . $row['date'] . "</td>
        <td>" . strtoupper($row['student_class']) . "</td>
        <td>" . strtoupper($row['student_subject']) . "</td>
        <form action='' method='POST'>
        <td>
        <input type='hidden' value = " . $row['date'] . " name = 'date'>
        <input type='hidden' value = " . $row['student_class']. " name = 'student_class'>
        <input type='hidden' value = " . $row['student_subject']. " name = 'student_subject'>
        <button type='submit' class='btn btn btn-danger' name='attdelete' value='Delete' onClick ='attdelete()'> <i class='far fa-trash-alt'></i></button>
        </td>
        </form>
        <td>
        <form action='Attendancereports.php' method='POST'>
        <input type='hidden' value = " . $row['date'] . " name = 'date'>
        <input type='hidden' value = " . $row['student_class']. " name = 'student_class'>
        <input type='hidden' value = " . $row['student_subject']. " name = 'student_subject'>
        <button type='submit' class = 'btn btn btn-warning' value = 'View' ><i class='far fa-eye'></i></button>
        </td>
        </form>
      </tr>";
      }
      ?>
      </tbody>
    </table>
</div> <!-- End Profile Area 2nd column -->



<?php

include('includes/footer.php');

?>
