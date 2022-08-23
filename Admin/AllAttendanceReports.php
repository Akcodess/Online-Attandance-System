<?php
session_start();
define('TITLE', 'All Attendance Reports');
define('PAGE', 'AllAttendance');
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

?>


<div class="col-sm-8 col-md-9 mt-5 my-4">
  <h3>
    <div class="text-light well text-center shadow-lg p-2 bg-danger">Online Attendance System<?php if (isset($_POST['date'])) { echo "$_POST[date]"; }  ?> </div>
  </h3>
  <form action="" method="POST">
    <div class="ml-5 form-group mt-5">
      <h2 class="text-center"> Attendance Reports</h2><br>
      <label for="name" class=" font-weight-bold ml-2 ">Date From: </label>
      <input type="date" name="date_from" value="<?php if(isset($_POST['date_from'])){ echo $_POST['date_from'];}else{}  ?>" class="pl-2 ml-3"  required>
      <label for="name" class="font-weight-bold ml-3">Date To: </label>
      <input type="date" name="date_to" value="<?php if(isset($_POST['date_to'])){ echo $_POST['date_to'];}else{}  ?>" class="pl-2 ml-3"  required>
      <label for="name" class=" font-weight-bold ml-3 ">Teacher ID: </label>
      <input type="text" name="teacherid" value="<?php if(isset($_POST['teacherid'])){ echo $_POST['teacherid'];}else{}  ?>" class="ml-3 pl-2" onkeypress="isInputNumber(event)" required><br><br>
      <div class="col text-center">
      <button type="submit" name="viewreports" class="btn btn-outline-dark mt-3 shadow-sm mr-5 font-weight-bold">View Reports</button>
    </div>
    </div>
  </form>
  <?php if (isset($_POST['viewreports'])) { echo "
    <table class='table table-striped'>
      <thead class='bg-dark'>
      <tr>
      <th scope='col' class = 'text-white'class = 'text-white'>S.No</th>
      <th scope='col' class = 'text-white'>Student Name</th>
      <th scope='col' class = 'text-white'>Roll Number</th>
      <th scope='col' class = 'text-white'>Class Name</th>
      <th scope='col' class = 'text-white'>Subject Name</th>
      <th scope='col' class = 'text-white'>Attendance Status</th>
      <th scope='col' class = 'text-white'>Date</th>
      </tr>
      </thead>
      ";}
      ?>
      <tbody>
      <?php
      if(isset($_POST['viewreports']))
      {
        if(strtotime($_POST['date_from']) < strtotime($_POST['date_to']))
        {

          $datefrom = $_POST['date_from'];
          $dateto = $_POST['date_to'];

          $teacherid = $_POST['teacherid'];
          
          $query = "SELECT * FROM `attendance_records_tb` WHERE `date` BETWEEN '$datefrom' AND '$dateto' AND `teacher_id` = '$teacherid'";
          $query_run = mysqli_query($con, $query);
          
          if(mysqli_num_rows($query_run) > 0)
          {
            $sno = 0;
            foreach($query_run as $row)
            {
              $sno = $sno + 1;
              ?>
                <tr>
                <th scope='row'><?php echo $sno ?></th>
                  <td><?php echo $row['student_name']; ?></td>
                  <td><?php echo $row['student_roll']; ?></td>
                  <td><?php echo strtoupper ($row['student_class']); ?></td>
                  <td><?php echo strtoupper ($row['student_subject']); ?></td>
                  <td>
                  <small class ="text-success font-weight-bold"><?php if($row['student_att_status'] == "Present"){ echo "PRESENT"; }?></small>
                  <small class ="text-danger font-weight-bold"><?php if($row['student_att_status'] == "Absent"){ echo "ABSENT"; }?></small>
                  </td>
                  <td><?php echo $row['date']; ?></td>
                </tr>
              <?php
            }
          }
          else
          {
            $allattmsg = "<div class='alert alert-danger fade show text-center' role='alert'><strong>Danger!</strong>No Records Found !</div>";
          }
        }
        else
        {
          $allattmsg = "<div class='alert alert-warning fade show text-center' role='alert'><strong>Warning!</strong>From Date Is Greater Than To Date Please Change !</div>";
        }
      }
        ?>
      </tbody>
    </table>
    <?php if(isset($allattmsg)) {echo $allattmsg; } ?>
    <?php if (isset($_POST['viewreports'])) { echo "<form class='d-print-none text-center'><input class='btn btn-danger' type='submit' value='Print' onClick='window.print()'></form>"; }  ?>
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





<?php
include('includes/footer.php'); 
?>