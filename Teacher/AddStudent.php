<?php
define('TITLE', 'Add Student');
define('PAGE', 'AddStudent');

include('includes/header.php');

// connect to the database
include('../dbcon.php');
session_start();

// Check for user login or not
if(isset($_SESSION['is_login']))
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

if(isset($_POST['addstudent']))
{
  // Checking for Empty Fields
  if(($_POST['sname'] == "") || ($_POST['sroll'] == ""))
  {
    $stmsg = '<div class="alert alert-warning mt-2 font-weight-bold" role="alert"> All Fields are Required </div>';
  }
  else
  {
    $sname = mysqli_real_escape_string($con,$_POST['sname']);
    $sroll = mysqli_real_escape_string($con,$_POST['sroll']);
    $sgender = mysqli_real_escape_string($con,$_POST['sgender']);
    $sparent = mysqli_real_escape_string($con,$_POST['sparent']);
    $smobile = mysqli_real_escape_string($con,$_POST['smobile']);

    // Query for Duplicate entry
    $dup = mysqli_query($con,"SELECT * FROM student_tb WHERE student_roll = '$sroll' AND teacher_id = '$teacherid'");

    if(mysqli_num_rows($dup)>0)
    {
      $stmsg = "<div class='alert alert-warning fade show' role='alert'><strong>Warning!</strong> This roll number already exists. Please enter a new roll.</div>";
    }
    else
    {
      // Sql query to be executed
      $sql = "INSERT INTO `student_tb` (`student_name`, `student_roll`, `student_gender`, `student_parent`, `student_mobile`, `teacher_id`) VALUES ('$sname', '$sroll', '$sgender', '$sparent', '$smobile', '$teacherid')";
      $result = mysqli_query($con, $sql);

      // Checking for Add Student
      if($result)
      {
        $stmsg = "<div class='alert alert-success fade show' role='alert'><strong>Success!</strong> Your Student has been added successfully.</div>";
      }
      else
      {
        $stmsg = "<div class='alert alert-danger fade show' role='alert'><strong>Danger!</strong>your student was not added successfully.</div>";
      }
    }
  }
}

?>

  <div class="col-sm-6 mt-5">  <!--ADD Student 2nd column-->
    <form class="mx-5" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
      <?php if(isset($stmsg)) {echo $stmsg; } ?>
      <div class="form-group">
        <i class="fas fa-user-graduate"></i><label class="pl-2 font-weight-bold" for="inputname">Student Name</label>
        <input type="text" class="form-control" id="inputEmail" name="sname" onkeypress="isInputName(event)" placeholder="Full Name" >
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

<?php

include('includes/footer.php');

?>