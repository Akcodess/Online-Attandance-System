<?php
session_start();
define('TITLE', 'All Students');
define('PAGE', 'Allstudent');
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

if (isset($_POST['stsnoedit'])) 
{
  // Update student
  $sno = mysqli_real_escape_string($con, $_POST['stsnoedit']);
  $sname = mysqli_real_escape_string($con, $_POST['sname']);
  $sroll = mysqli_real_escape_string($con, $_POST['sroll']);
  $sgender = mysqli_real_escape_string($con, $_POST['sgender']);
  $sparent = mysqli_real_escape_string($con, $_POST['sparent']);
  $smobile = mysqli_real_escape_string($con, $_POST['smobile']);
  $teacherid = mysqli_real_escape_string($con, $_POST['steacherid']);

  // Sql query to be executed
  $sql = "UPDATE `student_tb` SET `student_name` = '$sname', `student_roll` = '$sroll', `student_gender` = '$sgender', `student_parent` = '$sparent', `student_mobile` = '$smobile', `teacher_id` = '$teacherid' WHERE `student_tb`.`student_id` = $sno";
  $result = mysqli_query($con, $sql);

  if ($result) {
    $stupmsg = "<div class='alert alert-success fade show' role='alert'><strong>Success!</strong>Your student has been Updated Successfully</div>";
  } 
  else
  {
    $stupmsg = "<div class='alert alert-danger fade show' role='alert'><strong>Danger!</strong>Your student has could not Updated Successfully</div>";
  }
}

// Delete Student
if (isset($_POST['stsnodelete'])) 
{
  $dsno = mysqli_real_escape_string($con, $_POST['stsnodelete']);

  // Sql query to be executed
  $sql = "DELETE FROM student_tb WHERE student_id = '$dsno'";
  $result = mysqli_query($con, $sql);

  if ($result) {
    $stupmsg = "<div class='alert alert-success fade show' role='alert'><strong>Success!</strong>Your student has been Deleted Successfully</div>";
  } 
  else
  {
    $stupmsg = "<div class='alert alert-danger fade show' role='alert'><strong>Danger!</strong>Your student has could not Deleted Successfully</div>";
  }
}
?>

<!-- Edit Modal -->
<div class="modal fade" id="steditModal" tabindex="-1" aria-labelledby="steditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="steditModalLabel">Edit this Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="mx-2" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" name="stsnoedit" id="stsnoedit">
          <div class="form-group">
            <i class="fas fa-user-graduate"></i><label class="pl-2 font-weight-bold" for="inputname">Student Name</label>
            <input type="text" class="form-control" id="stnameedit" name="sname" onkeypress="isInputName(event)" placeholder="Full Name">
          </div>
          <div class="form-group">
            <i class="fas fa-id-card"></i><label class="pl-2 font-weight-bold" for="inputrollno">Roll Number</label>
            <input type="text" class="form-control" id="strolledit" name="sroll" placeholder="Roll Number" readonly>
          </div>
          <div class="form-group">
            <i class="fas fa-mars"></i><label class="pl-2 font-weight-bold">Gender:</label><br>
            <input type="radio" name="sgender" id="stgenderedit" value="MALE" required>Male &nbsp;
            <input type="radio" name="sgender" id="stgenderedit" value="FEMALE" required>Female
          </div>
          <div class="form-group">
            <i class="fas fa-user"></i><label class="pl-2 font-weight-bold" for="inputparent">Parent Name</label>
            <input type="text" class="form-control" id="stparentedit" name="sparent" onkeypress="isInputName(event)" placeholder="Full Name">
          </div>
          <div class="form-group">
            <i class="fas fa-phone"></i><label class="pl-2 font-weight-bold" for="inputmobile">Mobile</label>
            <input type="text" class="form-control" id="stmobileedit" name="smobile" onkeypress="isInputNumber(event)" placeholder="Mobile Number">
          </div>
          <div class="form-group">
            <i class="fas fa-user-tie"></i><label class="pl-2 font-weight-bold" for="inputmobile">Teacher ID</label>
            <input type="text" class="form-control" id="stteacheridedit" name="steacherid" onkeypress="isInputNumber(event)" placeholder="Teacher ID">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="stdeleteModal" tabindex="-1" aria-labelledby="stdeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="stdeleteModalLabel">Delete this Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
        <input type="hidden" name="stsnodelete" id="stsnodelete">
        <div class="modal-body">
          <h4>Do you want to Delete this student ?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"> No </button>
          <button type="submit" class="btn btn-primary"> Yes || Delee it. </button>
        </div>
      </form>
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


<div class="col-sm-8 col-md-9 mt-5 my-4">
  <?php if (isset($stupmsg)) { echo $stupmsg; } ?>
  <table class="mx-2 table table-striped" id="studentTable">
    <thead class = "bg-dark">
      <tr>
        <th scope="col" class = "text-white">S.No</th>
        <th scope="col" class = "text-white">Student Name</th>
        <th scope="col" class = "text-white">Roll Number</th>
        <th scope="col" class = "text-white">Gender</th>
        <th scope="col" class = "text-white">Parent Name</th>
        <th scope="col" class = "text-white">Mobile</th>
        <th scope="col" class = "text-white">Teacher ID</th>
        <th scope="col" class = "text-white">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php

      $sql = "SELECT * FROM `student_tb`";
      $result = mysqli_query($con, $sql);
      $sno = 0;
      while ($row = mysqli_fetch_assoc($result)) {
        $sno = $sno + 1;
        echo "<tr>
        <th scope='row'>" . $sno . "</th>
        <td>" . $row['student_name'] . "</td>
        <td>" . $row['student_roll'] . "</td>
        <td>" . $row['student_gender'] . "</td>
        <td>" . $row['student_parent'] . "</td>
        <td>" . $row['student_mobile'] . "</td>
        <td>" . $row['teacher_id'] . "</td>
        <td> <button class='astedit btn btn-sm btn-primary' id=" . $row['student_id'] . ">Edit</button> <button class='astdelete btn btn-sm btn-danger' id=" . $row['student_id'] . ">Delete</button> </td>
      </tr>";
      }
      ?>
    </tbody>
  </table>
</div> <!-- End Profile Area 2nd column -->
<hr>


<?php

include('includes/footer.php');

?>
